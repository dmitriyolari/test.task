<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserRegisterService;

class UserController extends Controller
{
    public function register(CreateUserRequest $request, UserRegisterService $service): UserResource
    {
        $validatedUser = $request->validated();
        $user = $service->create($validatedUser);

        return UserResource::make($user)->withStatusCode(202);
    }
}
