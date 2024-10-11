<?php

namespace App\Enums;

enum VaccinatedStatus: int
{
    case NOT_REGISTERED = 1;
    case NOT_SCHEDULED = 20;
    case SCHEDULED = 30;
    case VACCINATED = 40;
}
