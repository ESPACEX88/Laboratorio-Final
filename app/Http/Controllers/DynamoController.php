<?php

namespace App\Http\Controllers;

use Aws\DynamoDb\DynamoDbClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DynamoController extends Controller
{
    public function testDynamoDbConnection()
    {
        $client = new DynamoDbClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1')
        ]);

        try {
            // Obtener la lista de tablas para verificar la conexión
            $result = $client->listTables();
            Log::info('Conexión exitosa a DynamoDB. Tablas: ' . implode(', ', $result['TableNames']));
            return response()->json(['status' => 'success', 'tables' => $result['TableNames']]);
        } catch (\Exception $e) {
            Log::error('Error de conexión a DynamoDB: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
