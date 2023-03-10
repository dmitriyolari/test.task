<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\StatusResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserCreateService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(UserCreateRequest $request, UserCreateService $service): UserResource
    {
        $validatedUser = $request->validated();
        $user = $service->create($validatedUser);
        Auth::login($user);

        return UserResource::make($user)->withStatusCode(201);
    }

    public function login(UserLoginRequest $request): UserResource|StatusResource|Response
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return UserResource::make(Auth::user());
        }

        return response(StatusResource::make(false), 422);
    }

    public function info(): User|Authenticatable|null
    {
        return Auth::user();
    }

    public function logout(): UserResource|StatusResource|Response
    {
        if (Auth::user()) {
            Auth::logout();
            return StatusResource::make(true);
        }

        return response(StatusResource::make(false), 401);
    }
}
