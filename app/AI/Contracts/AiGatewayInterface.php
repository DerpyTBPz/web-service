<?php

namespace App\AI\Contracts;

use App\AI\DTO\GeneratedSubtasksResultDto;
use App\Models\Task;

interface AiGatewayInterface
{
    public function generateSubtasks(Task $task): GeneratedSubtasksResultDto;
}
