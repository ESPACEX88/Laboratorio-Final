@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Tareas</h1>

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(!empty($tasks))
            <table class="w-full border-collapse bg-white shadow-lg rounded-lg">
                <thead>
                    <tr>
                        <th class="border p-4 text-left">ID</th>
                        <th class="border p-4 text-left">Título</th>
                        <th class="border p-4 text-left">Descripción</th>
                        <th class="border p-4 text-left">Estado</th>
                        <th class="border p-4 text-left">Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class="border p-4">{{ $task['task_id'] }}</td>
                            <td class="border p-4">{{ $task['title'] }}</td>
                            <td class="border p-4">{{ $task['description'] }}</td>
                            <td class="border p-4">{{ $task['status'] }}</td>
                            <td class="border p-4">{{ $task['created_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay tareas para mostrar.</p>
        @endif
    </div>

    <!-- Agregar los mensajes a la consola del navegador -->
    @if (session('message'))
        <script>
            console.log("{{ session('message') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            console.error("{{ $errors->first('error') }}");
        </script>
    @endif
@endsection

