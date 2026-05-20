<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Задача #{{ $task->id }}</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; background: #f8fafc; }
        .card { max-width: 600px; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .field { margin-bottom: 1rem; }
        .field label { display: block; font-size: 0.8rem; text-transform: uppercase; color: #64748b; margin-bottom: 2px; }
        .status { display: inline-block; padding: 2px 10px; border-radius: 999px; font-size: 0.85rem; font-weight: bold; }
        .status-to_do       { background: #e2e8f0; color: #475569; }
        .status-in_progress { background: #fef3c7; color: #92400e; }
        .status-done        { background: #dcfce7; color: #166534; }
        .actions { display: flex; gap: 1rem; align-items: center; margin-top: 1.5rem; flex-wrap: wrap; }
        .btn { padding: 6px 16px; border-radius: 4px; font-size: 0.9rem; text-decoration: none; border: none; cursor: pointer; }
        .btn-edit   { background: #2563eb; color: #fff; }
        .btn-edit:hover { background: #1d4ed8; }
        .btn-delete { background: #ef4444; color: #fff; }
        .btn-delete:hover { background: #dc2626; }
        .btn-ai     { background: #7c3aed; color: #fff; }
        .btn-ai:hover { background: #6d28d9; }
        a.back { color: #2563eb; font-size: 0.9rem; }

        /* AI result block */
        .ai-block { max-width: 600px; background: #fff; border: 1px solid #c4b5fd; border-radius: 8px; padding: 1.5rem; }
        .ai-block h2 { margin: 0 0 1rem; font-size: 1rem; color: #7c3aed; text-transform: uppercase; letter-spacing: 0.05em; }
        .subtask-item {
            background: #f5f3ff;
            border-left: 3px solid #7c3aed;
            padding: 8px 12px;
            margin-bottom: 8px;
            border-radius: 0 4px 4px 0;
            font-size: 0.95rem;
        }
        .no-subtasks { color: #94a3b8; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="card">
    <h1 style="margin-top:0">Задача #{{ $task->id }}</h1>

    <div class="field">
        <label>Назва</label>
        <span>{{ $task->title }}</span>
    </div>

    <div class="field">
        <label>Опис</label>
        <span>{{ $task->description ?? '—' }}</span>
    </div>

    <div class="field">
        <label>Статус</label>
        <span class="status status-{{ $task->status }}">
            {{ \App\Enums\TaskStatusEnum::tryFrom($task->status)?->label() ?? $task->status }}
        </span>
    </div>

    <div class="field">
        <label>Дата виконання</label>
        <span>{{ $task->due_date ?? '—' }}</span>
    </div>

    <div class="field">
        <label>Створено</label>
        <span>{{ $task->created_at->format('d.m.Y H:i') }}</span>
    </div>

    <div class="actions">
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-edit">Редагувати</a>

        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
              onsubmit="return confirm('Видалити задачу?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">Видалити</button>
        </form>

        <form action="{{ route('tasks.generateSubtasks', $task) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-ai">Згенерувати підзадачі</button>
        </form>

        <a href="{{ route('tasks.index') }}" class="back">← Назад до списку</a>
    </div>
</div>

@isset($generatedSubtasks)
    <div class="ai-block">
        <h2>Згенеровані підзадачі</h2>

        @if (count($generatedSubtasks) > 0)
            @foreach ($generatedSubtasks as $subtask)
                <div class="subtask-item">{{ $subtask }}</div>
            @endforeach
        @else
            <p class="no-subtasks">Підзадачі не були згенеровані.</p>
        @endif
    </div>
@endisset

</body>
</html>
