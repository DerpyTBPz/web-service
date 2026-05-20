<?php

namespace App\AI\Parsers;

class SubtaskAiResponseParser
{
    private const MAX_SUBTASKS = 7;
    private const MIN_LENGTH   = 3;
    private const MAX_LENGTH   = 200;

    public function parse(string $rawResponse): array
    {
        $lines = preg_split('/\r\n|\r|\n/', trim($rawResponse));

        if ($lines === false) {
            return [];
        }

        $subtasks = [];

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            // Remove bullet markers: -, *, •
            $line = preg_replace('/^[-*•]\s*/u', '', $line);
            // Remove numbered prefixes: 1. 1) 1-
            $line = preg_replace('/^\d+[\).\s-]+/u', '', $line);

            $line = trim((string) $line);

            if ($line === '') {
                continue;
            }

            // Skip lines that are too short or too long to be useful subtasks
            if (mb_strlen($line) < self::MIN_LENGTH || mb_strlen($line) > self::MAX_LENGTH) {
                continue;
            }

            $subtasks[] = $line;
        }

        $subtasks = array_values(array_unique($subtasks));

        // Limit to MAX_SUBTASKS
        return array_slice($subtasks, 0, self::MAX_SUBTASKS);
    }
}
