<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tasks\GenerateSubtasksAction;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskAiController extends Controller
{
    public function generateSubtasks(
        Task $task,
        GenerateSubtasksAction $generateSubtasksAction
    ): JsonResponse {
        $result = $generateSubtasksAction->handle($task);

        return response()->json([
            'success' => true,
            'data'    => [
                'task_id'        => $task->id,
                'task_title'     => $task->title,
                'subtasks_count' => count($result->subtasks),
                'subtasks'       => $result->subtasks,
                'raw_response'   => $result->rawResponse,
            ],
        ]);
    }
}
