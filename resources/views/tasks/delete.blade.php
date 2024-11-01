@extends('layouts.app')

@section('content')
    <h2>Eliminar Tarea</h2>
    <form action="{{ route('tasks.delete', ['id' => $task->id ?? '']) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="form-group mb-3">
            <label for="task_id">ID de la tarea a eliminar:</label>
            <input type="text" id="task_id" name="task_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar Tarea</button>
    </form>
@endsection
