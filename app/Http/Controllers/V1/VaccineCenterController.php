<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Resources\VaccineCenterCollection;
use App\Http\Resources\VaccineCenterResource;
use App\Services\VaccineCenterService;

class VaccineCenterController extends ApiController
{
    public function __construct(
        protected VaccineCenterService $vaccineCenterService
    ) {}
    public function getVaccineCenters()
    {
        return new VaccineCenterCollection($this->vaccineCenterService->getVaccineCenters());
    }
}
