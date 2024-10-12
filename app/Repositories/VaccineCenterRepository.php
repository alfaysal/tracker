<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VaccineCenterRepositoryInterface;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Collection;

class VaccineCenterRepository implements VaccineCenterRepositoryInterface
{
    public function __construct(protected VaccineCenter $vaccineCenter){}

    public function getVaccineCenters(): Collection
    {
        return $this->vaccineCenter->all();
    }
}
