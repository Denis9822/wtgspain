<?php

namespace App\Http\Services;

use App\Models\Team;

class TeamsService
{
    public static ?Team $team;

    public static function find($team_id): ?Team
    {
        return self::$team = Team::query()->find($team_id) ?? null;
    }

    public static function addUser(): bool
    {
        $attach = self::$team->users()->sync([auth()->id()], false);

        return (bool) $attach['attached'];
    }

    public static function deleteUser($user_id): bool
    {
        return self::$team->users()->detach($user_id);
    }
}
