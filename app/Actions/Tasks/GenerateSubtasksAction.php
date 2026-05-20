<?php

namespace App\Actions\Tasks;

use App\AI\Contracts\AiGatewayInterface;
use App\AI\DTO\GeneratedSubtasksResultDto;
use App\Models\Task;

class GenerateSubtasksAction
{
    public function __construct(
        private readonly AiGatewayInterface $aiGateway,
    ) {
    }

    public function handle(Task $task): GeneratedSubtasksResultDto
    {
        if (trim($task->title) === '') {
            return new GeneratedSubtasksResultDto(subtasks: [], rawResponse: '');
        }

        return $this->aiGateway->generateSubtasks($task);
    }
}
