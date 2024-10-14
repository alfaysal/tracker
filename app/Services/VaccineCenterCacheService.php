<?php

namespace App\Services;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

class VaccineCenterCacheService extends CacheService
{
    protected string $vaccineCenterDailyLimitCacheKey = "vaccine_center_%s_schedule_date_%s";

    public function keyBuilder(string $specifier,...$args)
    {
        return sprintf($specifier, ...$args);
    }

    public function getVaccineCenterMaxUserLimitCount(int $vaccineCenterId, string $date)
    {
        $cacheKey = $this->keyBuilder($this->vaccineCenterDailyLimitCacheKey, $vaccineCenterId, $date);
        return Cache::get($cacheKey);
    }

    public function decrementVaccineUserLimitCount(int $vaccineCenterId, string $date)
    {
        $cacheKey = $this->keyBuilder($this->vaccineCenterDailyLimitCacheKey, $vaccineCenterId, $date);
        Cache::decrement($cacheKey);
    }

    public function setVaccineCenterMaxUserLimitCount(int $vaccineCenterId, string $date,int $value, int $ttl = 60)
    {
        $cacheKey = $this->keyBuilder($this->vaccineCenterDailyLimitCacheKey, $vaccineCenterId, $date);
        return Cache::set($cacheKey, $value, $ttl);
    }

    public function forgetVaccineCenterMaxUserLimitCount(int $vaccineCenterId, string $date)
    {
        $cacheKey = $this->keyBuilder($vaccineCenterId, $date);
        return Cache::forget($cacheKey);
    }


}
