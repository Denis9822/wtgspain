<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class CommentsController extends BaseController
{
    public function index(int $taskId): JsonResponse
    {
        $task = Task::query()->find($taskId);

        if ($task) {
            $taskWith = $task->with('comments')->first();

            return $this->sendResponse(CommentResource::collection($taskWith->comments), 'Comments retrieved successfully.');
        } else {
            return $this->sendError('Task not found.');
        }
    }

    public function store(CommentRequest $request, int $taskId): JsonResponse
    {
        $comment = Task::query()->find($taskId)->comments()->create($request->validated());

        return $this->sendResponse(new CommentResource($comment), 'Comment created successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        $comment = Comment::query()->find($id);

        if ($comment) {
            $comment->delete();

            return $this->sendResponse('success', 'Comment deleted successfully.');
        } else {
            return $this->sendError('Comment not found.');
        }
    }
}
