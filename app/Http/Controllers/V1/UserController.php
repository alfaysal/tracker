<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRegistrationRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends ApiController
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function registration(UserRegistrationRequest $request): JsonResponse
    {
        $user = $this->userService->registerUser($request->validated());
        return $this->success(message: 'Registration successful.', data: $user->toArray());
    }
}
