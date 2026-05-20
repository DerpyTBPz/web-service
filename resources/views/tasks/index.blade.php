<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список задач</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #f4f4f4; }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .actions { display: flex; gap: 8px; align-items: center; }
        select { padding: 4px; }
        button { padding: 4px 10px; cursor: pointer; }
        .btn-delete { background: #ef4444; color: #fff; border: none; border-radius: 4px; }
        .btn-delete:hover { background: #dc2626; }
        .top-links { margin-bottom: 1rem; display: flex; gap: 1rem; }
    </style>
</head>
<body>

<h1>Список задач</h1>

<div class="top-links">
    <a href="{{ route('tasks.create') }}">+ Створити задачу</a>
    <a href="{{ route('tasks.kanban') }}">Kanban дошка</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Статус</th>
            <th>Дата виконання</th>
            <th>Дії</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></td>
                <td>
                    <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}" {{ $task->status === $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </td>
                <td>{{ $task->due_date ?? '—' }}</td>
                <td class="actions">
                    <a href="{{ route('tasks.edit', $task) }}">Редагувати</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Видалити задачу?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Задач ще немає. <a href="{{ route('tasks.create') }}">Створити першу</a></td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
