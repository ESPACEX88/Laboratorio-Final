<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskTrack - Gestión de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="container">
    <h1 class="text-primary my-4">TaskTrack</h1>

    <nav class="mb-4">
        <a class="btn btn-outline-primary" href="{{ route('tasks.read') }}">Leer Tareas</a>
        <a class="btn btn-outline-success" href="{{ route('tasks.create') }}">Crear Tareas</a>
        <a class="btn btn-outline-warning" href="{{ route('tasks.update') }}">Actualizar Tareas</a>
        <a class="btn btn-outline-danger" href="{{ route('tasks.delete') }}">Eliminar Tareas</a>
    </nav>

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
