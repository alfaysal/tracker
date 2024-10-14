<?php

namespace App\Services;
use Illuminate\Contracts\Cache\Repository;

class VaccineCenterCacheService extends CacheService
{
    protected string $vaccineCenterdailyLimitKey = 'center_%s_date_';

    public function keyBuilder(string $specifier,...$args)
    {
        return sprintf($specifier, ...$args);
    }


}
