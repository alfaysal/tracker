<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\VaccineCenterRepository;
use Illuminate\Database\Eloquent\Collection;

class VaccineCenterService
{
    public function __construct(protected VaccineCenterRepository $repository) {}
    public function getVaccineCenters(): Collection
    {
        return $this->repository->getVaccineCenters();
    }
}
