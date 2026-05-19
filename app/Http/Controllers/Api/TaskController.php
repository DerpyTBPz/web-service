<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->taskService->getAll(), 'Tasks retrieved successfully');
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create($request->validated());

        return $this->successResponse($task, 'Task created successfully', 201);
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->find($id);

        if (!$task) {
            return $this->errorResponse('Task not found', 404);
        }

        return $this->successResponse($task, 'Task retrieved successfully');
    }

    public function update(TaskRequest $request, int $id): JsonResponse
    {
        $task = $this->taskService->find($id);

        if (!$task) {
            return $this->errorResponse('Task not found', 404);
        }

        $task = $this->taskService->update($task, $request->validated());

        return $this->successResponse($task, 'Task updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $task = $this->taskService->find($id);

        if (!$task) {
            return $this->errorResponse('Task not found', 404);
        }

        $this->taskService->delete($task);

        return $this->successResponse(null, 'Task deleted successfully');
    }
}
