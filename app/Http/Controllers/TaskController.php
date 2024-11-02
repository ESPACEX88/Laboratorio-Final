<?php

namespace App\Http\Controllers;

use Aws\DynamoDb\DynamoDbClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

    
    
}
