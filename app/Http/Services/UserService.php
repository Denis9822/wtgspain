<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public static ?User $user;

    public static function find($user_id): ?User
    {
        return self::$user = User::query()->find($user_id);
    }
}
