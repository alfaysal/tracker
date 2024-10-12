<?php

namespace App\Enums;

enum VaccinatedStatus: int
{
    case NOT_REGISTERED = 1;
    case NOT_SCHEDULED = 20;
    case SCHEDULED = 30;
    case VACCINATED = 40;

    public static function getVaccinatedStatus(int $id): string
    {
        $statusId = collect(VaccinatedStatus::cases())->first(function ($case) use ($id) {
            return $case->value === $id;
        });

        return $statusId->getValue() ?? '';
    }

    public function getValue(): string
    {
        return match($this)
        {
            VaccinatedStatus::NOT_REGISTERED => 'not registered',
            VaccinatedStatus::NOT_SCHEDULED => 'not scheduled',
            VaccinatedStatus::SCHEDULED => 'scheduled',
            VaccinatedStatus::VACCINATED => 'vaccinated',
        };
    }
}
