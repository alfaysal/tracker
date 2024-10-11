<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $user){}
    public function store(array $data): User
    {
        return $this->user->create($data);
    }

    public function find(int $id): User
    {
        return $this->user->find($id);
    }
}
