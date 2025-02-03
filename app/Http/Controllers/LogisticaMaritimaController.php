<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogisticaMaritima;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;
use App\Services\LogisticaMaritimaService;

class LogisticaMaritimaController extends Controller
{
    private $logisticaMaritima;
    use ApiResponse; 

    public function __construct(LogisticaMaritimaService $logistica)
    {
        $this->logisticaMaritima = $logistica;
    }
    public function addCreate(request $request){
        $data = $request->only(['id_producto','cantidad_producto','fecha_registro','fecha_entrega','id_puerto','precio_envio','precio_con_descuento','numero_flota','numero_guia','id_cliente']);
        return $this->sendAddEnvio($data);
    }
    private function sendAddEnvio($data){
        $validator = Validator::make($data,LogisticaMaritima::$validate);
        if($validator->fails()){
            return $this->errorResponse('Ha ocurrido el siguiente error: '.$validator->errors(),500);
        }
        $logistica = new LogisticaMaritima($data);
        $logistica->save();
        return $this->successResponse($logistica, 'Evento logistico registrado correctamente',201);
    }
}