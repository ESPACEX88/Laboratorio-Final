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
        <h2 class="text-2xl font-bold mb-4">Eliminar Tarea</h2>
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
                        <form action="{{ route('tasks.deleteFromView', ['task_id' => $task['task_id']]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white rounded px-3 py-1 font-semibold">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
