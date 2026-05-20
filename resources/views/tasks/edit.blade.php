<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагувати задачу</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        form { max-width: 480px; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 6px 8px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #ef4444; font-size: 0.875rem; margin-top: 2px; }
        .actions { margin-top: 1.5rem; display: flex; gap: 1rem; align-items: center; }
        button { padding: 6px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        a { color: #2563eb; }
    </style>
</head>
<body>

<h1>Редагувати задачу #{{ $task->id }}</h1>

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Назва *</label>
    <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required>
    @error('title')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="description">Опис</label>
    <textarea id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
    @error('description')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="status">Статус</label>
    <select id="status" name="status">
        @foreach ($statuses as $status)
            <option value="{{ $status->value }}" {{ old('status', $task->status) === $status->value ? 'selected' : '' }}>
                {{ $status->label() }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="due_date">Дата виконання</label>
    <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}">
    @error('due_date')
        <div class="error">{{ $message }}</div>
    @enderror

    <div class="actions">
        <button type="submit">Зберегти</button>
        <a href="{{ route('tasks.index') }}">← Назад до списку</a>
    </div>
</form>

</body>
</html>
