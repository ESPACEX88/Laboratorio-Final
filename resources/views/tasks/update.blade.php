@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
    @if(session('success'))
    <div class="bg-green-500 text-white p-2 mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-2 mb-4">
        {{ session('error') }}
    </div>
@endif
        <h2 class="text-2xl font-bold mb-4">Actualizar Estado de Tareas</h2>
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="border px-4 py-2">{{ $task['task_id'] }}</td>
                        <td class="border px-4 py-2">{{ $task['title'] }}</td>
                        <td class="border px-4 py-2">{{ $task['description'] }}</td>
                        <td class="border px-4 py-2">{{ $task['status'] }}</td>
                        <td class="border px-4 py-2">
                        <form action="{{ route('tasks.updateFromView', ['taskId' => $task['task_id']]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="border border-blue-600 rounded px-3 py-1">
                                    <option value="pendiente" {{ $task['status'] === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en progreso" {{ $task['status'] === 'en progreso' ? 'selected' : '' }}>En Progreso</option>
                                    <option value="completada" {{ $task['status'] === 'completada' ? 'selected' : '' }}>Completada</option>
                                </select>
                                <button type="submit" class="bg-blue-600 text-white rounded px-3 py-1 font-semibold">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
