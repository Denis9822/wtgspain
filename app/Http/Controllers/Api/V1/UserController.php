<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()
            ->create($request->validated());

        Auth::login($user);

        return $this->sendResponse(new UserResource($user), 'User register successfully.');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->sendResponse(
                new UserResource(auth()->user()),
                'User login successfully.'
            );
        } else {
            return $this->sendError('Error.', ['error' => 'User not found.']);
        }
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        auth()->logout();

        return $this->sendResponse('success', 'User logged out.');
    }

    public function unauthorised(): JsonResponse
    {
        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
}
