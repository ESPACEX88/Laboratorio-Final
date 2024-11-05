<?php

namespace App\Http\Controllers;

use Aws\DynamoDb\DynamoDbClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected $dynamoDb;
    protected $tableName = 'Tasks';

    public function __construct()
    {
        $this->dynamoDb = new DynamoDbClient([
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'version' => 'latest',
        ]);
    }

    // Crear tarea (POST)
    public function createTask(Request $request)
    {
        $taskData = [
            'task_id' => ['S' => (string) Str::uuid()],
            'title' => ['S' => $request->title],
            'description' => ['S' => $request->description],
            'status' => ['S' => 'pendiente'],
            'created_at' => ['S' => now()->toDateTimeString()],
        ];

        $this->dynamoDb->putItem([
            'TableName' => $this->tableName,
            'Item' => $taskData,
        ]);

        return response()->json(['message' => 'Tarea creada'], 201);
    }

    // Leer todas las tareas (GET)
    // TaskController.php
    public function getTasks()
{
    $client = new DynamoDbClient([
        'version' => 'latest',
        'region'  => env('AWS_DEFAULT_REGION', 'us-east-1')
    ]);

    try {
        $result = $client->scan([
            'TableName' => $this->tableName,
        ]);

        $tasks = [];
        foreach ($result['Items'] as $item) {
            $tasks[] = [
                'task_id' => $item['task_id']['S'],
                'title' => $item['title']['S'],
                'description' => $item['description']['S'],
                'status' => $item['status']['S'],
                'created_at' => $item['created_at']['S'],
            ];
        }

        return response()->json($tasks, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener las tareas: ' . $e->getMessage()], 500);
    }
}


    // Actualizar estado de una tarea (PUT)

    public function updateTaskStatus(Request $request, $taskId)
    {
        $this->dynamoDb->updateItem([
            'TableName' => $this->tableName,
            'Key' => [
                'task_id' => ['S' => $taskId],
            ],
            'UpdateExpression' => 'set #status = :status',
            'ExpressionAttributeNames' => ['#status' => 'status'],
            'ExpressionAttributeValues' => [
                ':status' => ['S' => $request->status],
            ],
        ]);
    
        return response()->json(['message' => 'Estado de la tarea actualizado correctamente'], 200);
    }



    //FUNCION QUE GESTIONA UPDATE INTERFAZ
    public function updateTaskStatusFromView(Request $request, $taskId)
{
    try {
        // Envía la solicitud PUT a la API
        $response = Http::put("http://api.uvgaimingshop.me/api/tasks/{$taskId}", [
            'status' => $request->status,
        ]);

        // Verifica la respuesta de la API
        if ($response->successful()) {
            // Mensaje de éxito desde la API
            return redirect()->back()->with('success', 'Estado de la tarea actualizado correctamente');
        } else {
            // Mensaje de error si algo falla en la API
            return redirect()->back()->with('error', 'No se pudo actualizar el estado de la tarea');
        }
    } catch (\Exception $e) {
        // Maneja errores de conexión o excepciones
        return redirect()->back()->with('error', 'Error de conexión con la API');
    }
}
    

    // Eliminar tarea (DELETE)
    public function deleteTask($taskId)
    {
        $this->dynamoDb->deleteItem([
            'TableName' => $this->tableName,
            'Key' => [
                'task_id' => ['S' => $taskId],
            ],
        ]);

        return response()->json(['message' => 'Tarea eliminada']);
    }

    public function showTasks()
    {
        try {
            // Realiza la petición GET a tu API
            $response = Http::get('http://api.uvgaimingshop.me/api/tasks');
            
            // Verifica que la respuesta sea exitosa
            if ($response->successful()) {
                $tasks = $response->json(); // Obtiene el contenido de la respuesta en formato JSON
            } else {
                $tasks = [];
                session()->flash('error', 'Error al obtener las tareas.');
            }
        } catch (\Exception $e) {
            $tasks = [];
            session()->flash('error', 'Error de conexión con la API: ' . $e->getMessage());
        }

        // Pasamos los datos a la vista
        return view('tasks.read', compact('tasks'));
    }

    public function showTasksUpdate()
    {
        try {
            // Realiza la petición GET a tu API
            $response = Http::get('http://api.uvgaimingshop.me/api/tasks');
            
            // Verifica que la respuesta sea exitosa
            if ($response->successful()) {
                $tasks = $response->json(); // Obtiene el contenido de la respuesta en formato JSON
            } else {
                $tasks = [];
                session()->flash('error', 'Error al obtener las tareas.');
            }
        } catch (\Exception $e) {
            $tasks = [];
            session()->flash('error', 'Error de conexión con la API: ' . $e->getMessage());
        }

        // Pasamos los datos a la vista
        return view('tasks.update', compact('tasks'));
    }

    public function showTasksDelete()
    {
        try {
            // Realiza la petición GET a tu API
            $response = Http::get('http://api.uvgaimingshop.me/api/tasks');
            
            // Verifica que la respuesta sea exitosa
            if ($response->successful()) {
                $tasks = $response->json(); // Obtiene el contenido de la respuesta en formato JSON
            } else {
                $tasks = [];
                session()->flash('error', 'Error al obtener las tareas.');
            }
        } catch (\Exception $e) {
            $tasks = [];
            session()->flash('error', 'Error de conexión con la API: ' . $e->getMessage());
        }

        // Pasamos los datos a la vista
        return view('tasks.delete', compact('tasks'));
    }

    public function deleteTaskFromView($task_id)
    {
        try {
            // Envía la solicitud DELETE a la API
            $response = Http::delete("http://api.uvgaimingshop.me/api/tasks/{$task_id}");

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Tarea eliminada correctamente');
            } else {
                return redirect()->back()->with('error', 'No se pudo eliminar la tarea');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de conexión con la API');
        }
    }

    public function createTaskFromView(Request $request)
{
    // Valida los datos del formulario
    $request->validate([
        'task_id' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
        'status' => 'required|string',
        'created_at' => 'required|date',
    ]);

    // Organiza los datos en un array
    $taskData = [
        'task_id' => $request->task_id,
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'created_at' => $request->created_at,
    ];

    try {
        // Envía la solicitud POST a la API
        $response = Http::post('http://api.uvgaimingshop.me/api/tasks', $taskData);

        // Log de la respuesta de la API
        Log::info('Respuesta de la API:', ['status' => $response->status(), 'body' => $response->body()]);

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Tarea creada exitosamente');
        } else {
            // Log para errores de respuesta de la API
            Log::error('Error al crear la tarea en la API', ['response' => $response->json()]);
            return redirect()->back()->with('error', 'No se pudo crear la tarea');
        }
    } catch (\Exception $e) {
        // Manejo de errores de conexión o excepción general
        Log::error('Error de conexión con la API', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error de conexión con la API');
    }
}
    
}
