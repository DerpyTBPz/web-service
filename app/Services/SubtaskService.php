<?php

namespace App\Services;

use App\Models\Subtask;

class SubtaskService
{
    public function getAll()
    {
        return Subtask::all();
    }

    public function find(int $id): ?Subtask
    {
        return Subtask::find($id);
    }

    public function create(array $data): Subtask
    {
        return Subtask::create($data);
    }

    public function update(Subtask $subtask, array $data): Subtask
    {
        $subtask->update($data);

        return $subtask;
    }

    public function delete(Subtask $subtask): void
    {
        $subtask->delete();
    }
}
