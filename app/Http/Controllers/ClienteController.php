<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente as Cliente;
use Illuminate\Support\Facades\Validator;
use App\Services\ClienteService;
use App\Traits\ApiResponse;

class ClienteController extends Controller
{
    private $clienteService;
    use ApiResponse; 

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function userList(request $request){
          try{

            //SOlo va a filtrar por estos 2 elementos
            $filters = $request->only(['nombre', 'email',]);
            // Delegar la lógica al servicio
            $validator = $this->validateData($filters,'validateDataList');
            if($validator["errors"]){
                return response()->json(['status' => 'error','message' => $validator["errors"]], 500);
            }
            $clientes = $this->clienteService->getFilteredClients($filters);
            return $this->successResponse($clientes, 'Clientes listados correctamente');

        return response()->json($clientes);
          } catch (\Exception $e) {
            return $this->errorResponse('Ha ocurrido el siguiente error: '. $e->getMessage(),500);
        }
    }
    public function addCreate(request $request){
        $filters = $request->only(['nombre_completo','direccion','telefono','email']);
    }
    private static function validateData($data,$validacion){
        $validator = Validator::make($data,Cliente::${$validacion});
        if($validator->fails()){
            return [
                'success'=>false,
                'errors'=> $validator->errors(),
            ];
        }

    }
}
