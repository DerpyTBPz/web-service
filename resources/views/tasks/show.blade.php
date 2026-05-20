<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Задача #{{ $task->id }}</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        .card { max-width: 560px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.5rem; }
        .field { margin-bottom: 1rem; }
        .field label { display: block; font-size: 0.8rem; text-transform: uppercase; color: #64748b; margin-bottom: 2px; }
        .field span { font-size: 1rem; }
        .status {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .status-to_do       { background: #e2e8f0; color: #475569; }
        .status-in_progress { background: #fef3c7; color: #92400e; }
        .status-done        { background: #dcfce7; color: #166534; }
        .actions { margin-top: 1.5rem; display: flex; gap: 1rem; align-items: center; }
        .btn-edit { padding: 6px 16px; background: #2563eb; color: #fff; border-radius: 4px; text-decoration: none; font-size: 0.9rem; }
        .btn-edit:hover { background: #1d4ed8; }
        .btn-delete { padding: 6px 16px; background: #ef4444; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 0.9rem; }
        .btn-delete:hover { background: #dc2626; }
        a.back { color: #2563eb; text-decoration: none; font-size: 0.9rem; }
        a.back:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>Задача #{{ $task->id }}</h1>

<div class="card">
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
            @php
                $label = match($task->status) {
                    'to_do'       => 'To Do',
                    'in_progress' => 'In Progress',
                    'done'        => 'Done',
                    default       => $task->status,
                };
            @endphp
            {{ $label }}
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

    <div class="field">
        <label>Оновлено</label>
        <span>{{ $task->updated_at->format('d.m.Y H:i') }}</span>
    </div>

    <div class="actions">
        <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Редагувати</a>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
              onsubmit="return confirm('Видалити задачу?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Видалити</button>
        </form>
        <a href="{{ route('tasks.index') }}" class="back">← Назад до списку</a>
    </div>
</div>

</body>
</html>
