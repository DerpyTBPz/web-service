<?php

namespace App\AI\DTO;

class GeneratedSubtasksResultDto
{
    public function __construct(
        public array $subtasks,
        public string $rawResponse,
    ) {
    }
}
