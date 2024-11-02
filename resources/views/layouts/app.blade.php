<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskTrack - Gestión de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex flex-col min-h-screen">
    <!-- Encabezado Estático -->
    <header class="bg-blue-600 text-white py-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">TaskTrack</h1>
            <nav class="space-x-4">
    <a href="{{ route('tasks.read') }}" class="hover:text-gray-300 transition duration-200">Leer Tareas</a>
    <a href="{{ route('tasks.create') }}" class="hover:text-gray-300 transition duration-200">Crear Tareas</a>
    <a href="{{ route('tasks.update') }}" class="hover:text-gray-300 transition duration-200">Actualizar Tareas</a>
    <a href="{{ route('tasks.delete') }}" class="hover:text-gray-300 transition duration-200">Eliminar Tareas</a>
</nav>

        </div>
    </header>

    <!-- Contenido Principal con Animaciones -->
    <main class="container mx-auto flex-grow py-10" data-aos="fade-up" data-aos-duration="1000">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} TaskTrack Inc. Todos los derechos reservados.</p>
        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
