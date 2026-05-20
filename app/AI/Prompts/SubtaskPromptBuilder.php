<?php

namespace App\AI\Prompts;

use App\Models\Task;

class SubtaskPromptBuilder
{
    public function build(Task $task): string
    {
        $title       = $task->title;
        $description = $task->description ?? '';

        return <<<PROMPT
You are an assistant that helps to break down tasks into smaller actionable subtasks.

Task title: {$title}
Task description: {$description}

Instructions:
- Break this task into 5-7 clear subtasks
- Each subtask must be short and actionable
- Do not include explanations
- Return the result as a plain list, each subtask on a new line
- Respond in Ukrainian language
PROMPT;
    }
}
