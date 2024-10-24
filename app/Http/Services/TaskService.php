<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService
{
    public static ?Task $tasks;

    public static function get($request)
    {
        $tasks = auth()->user()->tasks();
        if ($request->has('status')) {
            $tasks->filterByStatus($request->status);
        }

        if ($request->has('sort')) {
            $direction = $request->has('direction') && $request->direction === 'asc' ? 'asc' : 'desc';

            switch ($request->sort) {
                case 'created_at':
                    $tasks->orderByCreatedAt($direction);
                    break;
                case 'updated_at':
                    $tasks->orderByUpdatedAt($direction);
                    break;
            }
        }

        return $tasks->get() ?? null;
    }
}
