<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubtaskRequest;
use App\Services\SubtaskService;
use Illuminate\Http\JsonResponse;

class SubtaskController extends Controller
{
    public function __construct(
        private readonly SubtaskService $subtaskService
    ) {}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->subtaskService->getAll(), 'Subtasks retrieved successfully');
    }

    public function store(SubtaskRequest $request): JsonResponse
    {
        $subtask = $this->subtaskService->create($request->validated());

        return $this->successResponse($subtask, 'Subtask created successfully', 201);
    }

    public function show(int $id): JsonResponse
    {
        $subtask = $this->subtaskService->find($id);

        if (!$subtask) {
            return $this->errorResponse('Subtask not found', 404);
        }

        return $this->successResponse($subtask, 'Subtask retrieved successfully');
    }

    public function update(SubtaskRequest $request, int $id): JsonResponse
    {
        $subtask = $this->subtaskService->find($id);

        if (!$subtask) {
            return $this->errorResponse('Subtask not found', 404);
        }

        $subtask = $this->subtaskService->update($subtask, $request->validated());

        return $this->successResponse($subtask, 'Subtask updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $subtask = $this->subtaskService->find($id);

        if (!$subtask) {
            return $this->errorResponse('Subtask not found', 404);
        }

        $this->subtaskService->delete($subtask);

        return $this->successResponse(null, 'Subtask deleted successfully');
    }
}
