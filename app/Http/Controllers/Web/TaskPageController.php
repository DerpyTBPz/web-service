<?php

namespace App\Http\Controllers\Web;

use App\Enums\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskPageController extends Controller
{
    public function index(): View
    {
        $tasks    = Task::all();
        $statuses = TaskStatusEnum::cases();
        return view('tasks.index', compact('tasks', 'statuses'));
    }

    public function create(): View
    {
        $statuses = TaskStatusEnum::cases();
        return view('tasks.create', compact('statuses'));
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $statuses = TaskStatusEnum::cases();
        return view('tasks.edit', compact('task', 'statuses'));
    }

    public function store(TaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index');
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $task->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function kanban(): View
    {
        $tasks = Task::all();

        $todoTasks = $tasks->where('status', 'to_do');
        $inProgressTasks = $tasks->where('status', 'in_progress');
        $doneTasks = $tasks->where('status', 'done');

        return view('tasks.kanban', compact('todoTasks', 'inProgressTasks', 'doneTasks'));
    }
}
