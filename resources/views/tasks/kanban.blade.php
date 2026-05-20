<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Kanban дошка</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: sans-serif; margin: 2rem; background: #f1f5f9; }
        h1 { margin-bottom: 0.5rem; }
        .top-links { margin-bottom: 1.5rem; }
        .top-links a { color: #2563eb; text-decoration: none; }
        .top-links a:hover { text-decoration: underline; }

        .board { display: flex; gap: 1.5rem; align-items: flex-start; }

        .column {
            flex: 1;
            background: #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            min-height: 200px;
        }
        .column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .column-header h2 { margin: 0; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .count {
            background: #94a3b8;
            color: #fff;
            border-radius: 999px;
            padding: 1px 8px;
            font-size: 0.8rem;
        }
        .column-todo       .count { background: #64748b; }
        .column-inprogress .count { background: #f59e0b; }
        .column-done       .count { background: #22c55e; }

        .card {
            background: #fff;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        .card-title { font-weight: bold; margin-bottom: 0.25rem; }
        .card-due { font-size: 0.8rem; color: #64748b; margin-bottom: 0.5rem; }
        .card-actions { display: flex; gap: 0.75rem; font-size: 0.85rem; }
        .card-actions a { color: #2563eb; text-decoration: none; }
        .card-actions a:hover { text-decoration: underline; }
        .btn-delete {
            background: none; border: none; color: #ef4444;
            cursor: pointer; padding: 0; font-size: 0.85rem;
        }
        .btn-delete:hover { text-decoration: underline; }

        .empty { color: #94a3b8; font-size: 0.875rem; text-align: center; padding: 1rem 0; }
    </style>
</head>
<body>

<h1>Kanban дошка</h1>
<div class="top-links">
    <a href="{{ route('tasks.index') }}">← Список задач</a>
</div>

<div class="board">

    {{-- To Do --}}
    <div class="column column-todo">
        <div class="column-header">
            <h2>To Do</h2>
            <span class="count">{{ $todoTasks->count() }}</span>
        </div>
        @forelse ($todoTasks as $task)
            <div class="card">
                <div class="card-title">{{ $task->title }}</div>
                @if ($task->due_date)
                    <div class="card-due">До: {{ $task->due_date }}</div>
                @endif
                <div class="card-actions">
                    <a href="{{ route('tasks.edit', $task) }}">Редагувати</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Видалити задачу?')" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Видалити</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty">Немає задач</div>
        @endforelse
    </div>

    {{-- In Progress --}}
    <div class="column column-inprogress">
        <div class="column-header">
            <h2>In Progress</h2>
            <span class="count">{{ $inProgressTasks->count() }}</span>
        </div>
        @forelse ($inProgressTasks as $task)
            <div class="card">
                <div class="card-title">{{ $task->title }}</div>
                @if ($task->due_date)
                    <div class="card-due">До: {{ $task->due_date }}</div>
                @endif
                <div class="card-actions">
                    <a href="{{ route('tasks.edit', $task) }}">Редагувати</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Видалити задачу?')" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Видалити</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty">Немає задач</div>
        @endforelse
    </div>

    {{-- Done --}}
    <div class="column column-done">
        <div class="column-header">
            <h2>Done</h2>
            <span class="count">{{ $doneTasks->count() }}</span>
        </div>
        @forelse ($doneTasks as $task)
            <div class="card">
                <div class="card-title">{{ $task->title }}</div>
                @if ($task->due_date)
                    <div class="card-due">До: {{ $task->due_date }}</div>
                @endif
                <div class="card-actions">
                    <a href="{{ route('tasks.edit', $task) }}">Редагувати</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Видалити задачу?')" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Видалити</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty">Немає задач</div>
        @endforelse
    </div>

</div>
</body>
</html>
