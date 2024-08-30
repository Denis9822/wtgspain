<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TasksController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = auth()->user()->tasks()->get();

        if (count($tasks)) {
            return $this->sendResponse(TaskResource::collection($tasks), 'Tasks retrieved successfully.');
        } else {
            return $this->sendError('Tasks not found.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::query()->create($request->validated());

        return $this->sendResponse(new TaskResource($task), 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $task = Task::query()->find($id);

        if ($task) {
            return $this->sendResponse(new TaskResource($task), 'Task retrieved successfully.');
        } else {
            return $this->sendError('Task not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id): JsonResponse
    {
        $task = Task::query()->find($id);

        if ($task) {
            $task->update($request->validated());

            return $this->sendResponse(new TaskResource($task), 'Task retrieved successfully.');
        } else {
            return $this->sendError('Task not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $task = Task::query()->find($id);

        if ($task) {
            $task->delete();

            return $this->sendResponse('success', 'Task deleted successfully.');
        } else {
            return $this->sendError('Task not found.');
        }
    }
}
