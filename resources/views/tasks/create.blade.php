@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Crear Nueva Tarea</h2>
    <form id="createTaskForm">
        <input type="text" id="newTaskName" placeholder="Nombre de la tarea" required>
        <textarea id="newTaskDescription" placeholder="Descripción de la tarea" required></textarea>
        <button type="button" onclick="createTask()">Crear Tarea</button>


    </form>
    <script src="js/script.js"></script>
</body>
</html>
@endsection