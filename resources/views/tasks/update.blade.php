@extends('layouts.app')

@section('content')
    <h2>Actualizar Tarea</h2>
    <form action="{{ route('tasks.update', ['id' => $task->id ?? '']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Título de la tarea:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $task->title ?? '' }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" class="form-control" required>{{ $task->description ?? '' }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="status">Estado:</label>
            <select id="status" name="status" class="form-control">
                <option value="pendiente" {{ ($task->status ?? '') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en progreso" {{ ($task->status ?? '') === 'en progreso' ? 'selected' : '' }}>En Progreso</option>
                <option value="completada" {{ ($task->status ?? '') === 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar Tarea</button>
    </form>
@endsection
