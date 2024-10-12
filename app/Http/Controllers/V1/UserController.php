<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function searches(Request $request)
    {
        $request->validate([
            'nid' => 'required|string|size:10',
        ]);

        return new UserResource($this->userService->getUserByNid($request->input('nid')));
    }
}
