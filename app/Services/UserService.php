<?php

namespace App\Services;

use App\Enums\VaccinatedStatus;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\VaccineCenterRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserService
{
    protected VaccineCenterCacheService $vaccineCenterCacheService;

    public function __construct(
        VaccineCenterCacheService $vaccineCenterCacheService,
        protected UserRepository $repository,
        protected VaccineCenterRepository $vaccineCenterRepository,
    ) {
        $this->vaccineCenterCacheService = $vaccineCenterCacheService;
    }
    public function registerUser(array $data)
    {
        $data['scheduled_at'] = $this->getScheduledDate($data['vaccine_center_id']);
        $data['vaccination_status'] = VaccinatedStatus::SCHEDULED;
        return $this->repository->store($data);
    }

    public function getUserByNid(string $nid): User
    {
        return $this->repository->getSingleUserBy(condition: ['nid' => $nid]);
    }

    private function getScheduledDate(int $vaccineCenterId): string
    {
        $lastInstanceOfVaccineUser = $this->repository->getLastInstanceOfVaccineCenterFromUserTable($vaccineCenterId);

        if (!$lastInstanceOfVaccineUser) {
            $vaccineCenter = $this->vaccineCenterRepository->getVaccineCenterById($vaccineCenterId);

            if (!$vaccineCenter) {
                throw ValidationException::withMessages(['vaccine_center_id' => 'Center Id must not empty.']);
            }

            $this->vaccineCenterCacheService->setVaccineCenterMaxUserLimitCount(
                $vaccineCenterId,
                now()->format("Y-m-d"),
                $vaccineCenter->user_limit_per_day  - 1,
                60
            );

            return Carbon::now()->toDateString();
        }

        $scheduledDateInString = $lastInstanceOfVaccineUser->scheduled_at ?
            Carbon::parse($lastInstanceOfVaccineUser->scheduled_at)->toDateString() :
            Carbon::now()->toDateString();

        $vaccineCenterMaxUserLimitCount = $this->vaccineCenterCacheService->getVaccineCenterMaxUserLimitCount(
            $vaccineCenterId,
            $scheduledDateInString
        );

        if (is_null($vaccineCenterMaxUserLimitCount)) {
            return $this->getScheduledDateByQuery($vaccineCenterId);
        }

        if ((int)$vaccineCenterMaxUserLimitCount > 0) {
            $this->vaccineCenterCacheService->decrementVaccineUserLimitCount(
                $vaccineCenterId,
                $scheduledDateInString
            );
            return Carbon::parse($lastInstanceOfVaccineUser->scheduled_at)->toDateString();
        }

        if ((int)$vaccineCenterMaxUserLimitCount == 0) {
            $this->vaccineCenterCacheService->forgetVaccineCenterMaxUserLimitCount($vaccineCenterId, $scheduledDateInString);
        }

        return $this->getScheduledDateByQuery($vaccineCenterId);
    }

    private function getScheduledDateByQuery(int $vaccineCenterId): string
    {
        $lastInstance = $this->vaccineCenterRepository->getLastDateInstanceFor($vaccineCenterId);

        // normally use ttl 1 day & assume user_limit_per_day is required
        $this->vaccineCenterCacheService->setVaccineCenterMaxUserLimitCount(
            $vaccineCenterId,
            Carbon::parse($lastInstance->scheduled_at)->format("Y-m-d"),
            $lastInstance->user_limit_per_day - 1,
            60
        );

        if (is_null($lastInstance->vaccine_center_id)) {
            return now()->toDateString();
        };

        if ($lastInstance->user_count == $lastInstance->user_limit_per_day) {
            return Carbon::parse($lastInstance->scheduled_at)->addDays()->toDateString();
        } else {
            return Carbon::parse($lastInstance->scheduled_at)->toDateString();
        }
    }
}
