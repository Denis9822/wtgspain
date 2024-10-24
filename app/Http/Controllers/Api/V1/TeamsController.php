<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Http\Services\TeamsService;
use App\Http\Services\UserService;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class TeamsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = auth()->user()->teams()->get();
        if (count($teams)) {
            return $this->sendResponse(TeamResource::collection($teams), 'Teams retrieved successfully.');
        } else {
            return $this->sendError('Teams not found.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request): JsonResponse
    {
        $team = Team::query()->create($request->validated());

        return $this->sendResponse(new TeamResource($team), 'Team created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $team_id): JsonResponse
    {
        $team = TeamsService::find($team_id);

        if (isset($team) !== false) {
            if (TeamsService::addUser()) {
                return $this->sendResponse('success', 'Team updated successfully.');
            } else {
                return $this->sendError('User already exists.');
            }
        } else {
            return $this->sendError('Team not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $team_id, string $user_id): JsonResponse
    {
        $team = TeamsService::find($team_id);
        $user = UserService::find($user_id);
        if (isset($team) !== false && isset($user) !== false) {
            if (TeamsService::deleteUser($user_id)) {
                return $this->sendResponse('success', 'User deleted successfully.');
            } else {
                return $this->sendError('User not in this team.');
            }
        } else {
            return $this->sendError('Team or User not found.');
        }
    }
}
