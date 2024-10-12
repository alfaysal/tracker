<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Throwable;

class UserService
{
    public function __construct(protected UserRepository $repository) {}
    public function registerUser(array $data): User
    {
        return $this->repository->store($data);
    }

    public function getUserByNid(string $nid): User
    {
        return $this->repository->getSingleUserBy(condition: ['nid' => $nid]);
    }
}
