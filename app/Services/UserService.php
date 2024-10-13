<?php

namespace App\Services;

use App\Enums\VaccinatedStatus;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\VaccineCenterRepository;
use Carbon\Carbon;
use Throwable;

class UserService
{
    public function __construct(
        protected UserRepository $repository,
        protected VaccineCenterRepository $vaccineCenterRepository
    ) {}
    public function registerUser(array $data): User
    {
        return User::first();
        $data['scheduled_at'] = $this->getScheduledDate($data['vaccine_center']);
        $data['vaccination_status'] = VaccinatedStatus::SCHEDULED;
        return $this->repository->store($data);
    }

    public function getUserByNid(string $nid): User
    {
        return $this->repository->getSingleUserBy(condition: ['nid' => $nid]);
    }

    private function getScheduledDate(int $vaccineCenterId): Carbon
    {
        $lastInstance = $this->vaccineCenterRepository->getLastDateInstanceFor($vaccineCenterId);

        if (is_null($lastInstance)) {
            return now();
        };

        if ($lastInstance->user_count == $lastInstance->user_limit_per_day) {
            return Carbon::parse($lastInstance->vaccinated_at)->addDays();
        } else {
            return Carbon::parse($lastInstance->vaccinated_at);
        }
    }
}
