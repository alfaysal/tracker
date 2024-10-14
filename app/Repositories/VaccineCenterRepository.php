<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VaccineCenterRepositoryInterface;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class VaccineCenterRepository implements VaccineCenterRepositoryInterface
{
    public function __construct(protected VaccineCenter $vaccineCenter)
    {
    }

    public function getVaccineCenters(): Collection
    {
        return $this->vaccineCenter->all();
    }

    public function getVaccineCenterById(int $vaccineCenterId): VaccineCenter
    {
        return $this->vaccineCenter->find($vaccineCenterId);
    }

    public function getLastDateInstanceFor(int $vaccineCenterId)
    {
        return $this->vaccineCenter
            ->select(
                'users.scheduled_at',
                'vaccine_centers.id as vaccine_center_id',
                'vaccine_centers.user_limit_per_day',
                DB::raw('COUNT(users.id) as user_count')
            )
            ->leftjoin('users', 'users.vaccine_center_id', '=', 'vaccine_centers.id')
            ->whereNotNull('users.scheduled_at')
            ->where('vaccine_centers.id', $vaccineCenterId)
            ->groupBy('users.scheduled_at', 'vaccine_centers.id')
            ->orderBy('users.scheduled_at', 'desc')
            ->first();
    }
}
