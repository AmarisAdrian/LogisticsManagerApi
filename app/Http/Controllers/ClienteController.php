<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente as Cliente;
use Illuminate\Support\Facades\Validator;
use App\Services\ClienteService;
use App\Traits\ApiResponse;
Use App\Models\TipoCliente;

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

            $filters = $request->only(['nombre', 'email',]);
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
        $data = $request->only(['nombre_completo','direccion','telefono','email','id_tipo_cliente']);
        return $this->sendAddCliente($data);
    }
    public function update(request $request){
        $data = $request->only(['id_cliente','nombre_completo','direccion','telefono','email','id_tipo_cliente']);
        return $this->sendUpdateCliente($data);
    }
    public function sendUpdateCliente($data){
        $validator = Validator::make($data,Cliente::$validate);
        if($validator->fails()){
            return $this->errorResponse('Ha ocurrido el siguiente error: '.$validator->errors(),500);
        }
        $cliente = Cliente::find($data['id_cliente']);   
        if (!$cliente) {
            return $this->errorResponse('El cliente no existe',500);
        }
        $cliente->fill($data);
        $cliente->save();
        return $this->successResponse($cliente, 'Cliente actualizado exitosamente',201);
    }
    private function sendAddCliente($data){
        $validator = Validator::make($data,Cliente::$validate);
        if($validator->fails()){
            return $this->errorResponse('Ha ocurrido el siguiente error: '.$validator->errors(),500);
        }
        $exists = Cliente::where("email",$data["email"])->exists();
        if($exists){
            return $this->errorResponse('El email insertado se encuentra registrado',500);
        }
        $cliente = new Cliente($data);
        $cliente->save();
        return $this->successResponse($cliente, 'Cliente registrado exitosamente',201);
    }
    private function validateData($data,$validacion){
        $validator = Validator::make($data,Cliente::${$validacion});
        if($validator->fails()){
            return [
                'success'=>false,
                'errors'=> $validator->errors(),
            ];
        }
    }
    public function getListTipoUsuario(){
        return TipoCliente::get();
    }
    public function getClienteById($id){
        $cliente = Cliente::where("id_cliente",$id)->first();
        return $this->successResponse($cliente, 'Clientes listado correctamente');
    }
}
