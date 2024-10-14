<?php

namespace App\Services;
use Illuminate\Contracts\Cache\Repository;

class CacheService
{
    public function __construct(Repository $cache)
    {
    }

}
