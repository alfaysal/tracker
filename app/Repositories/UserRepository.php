<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

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

    public function getSingleUserBy(array $selectedField = ['*'], array $condition = []): User
    {
        return $this->user::select($selectedField)
            ->where($condition)
            ->firstOrFail();
    }
}
