@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
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
    <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Crear Nueva Tarea</h1>
        
        <form id="createTaskForm" action="{{ route('tasks.createFromView') }}" method="POST" class="space-y-4">
            @csrf
            @method('POST')
            <div>
                <label for="task_id" class="block text-gray-700">ID de la Tarea</label>
                <input type="text" name="task_id" id="task_id" class="w-full border border-blue-600 rounded px-3 py-2" placeholder="ID de la tarea">
            </div>
            
            <div>
                <label for="title" class="block text-gray-700">Título</label>
                <input type="text" name="title" id="title" class="w-full border border-blue-600 rounded px-3 py-2" placeholder="Nombre de la tarea">
            </div>
            
            <div>
                <label for="description" class="block text-gray-700">Descripción</label>
                <input type="text" name="description" id="description" class="w-full border border-blue-600 rounded px-3 py-2" placeholder="Descripción de la tarea">
            </div>
            
            <div>
                <label for="status" class="block text-gray-700">Estado</label>
                <select id="status" name="status" class="w-full border border-blue-600 rounded px-3 py-2">
                    <option value="pendiente">Pendiente</option>
                    <option value="en progreso">En Progreso</option>
                    <option value="completada">Completada</option>
                </select>
            </div>
            
            <div>
                <label for="created_at" class="block text-gray-700">Fecha de Creación</label>
                <input type="datetime-local" name="created_at" id="created_at" class="w-full border border-blue-600 rounded px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded py-2 font-semibold">Crear Tarea</button>
        </form>
    </div>

    <link rel="stylesheet" href="{{ ('css/styles.css') }}">
<script src="{{ ('js/scripts.js') }}"></script>

</body>
</html>

@endsection