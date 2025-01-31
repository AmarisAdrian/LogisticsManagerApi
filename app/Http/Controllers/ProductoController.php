<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductoService;
use App\Traits\ApiResponse;
use App\Models\TipoProducto;

class ProductoController extends Controller
{
    use ApiResponse; 
    private $productoService;
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }
    public function productoList(request $request){
        try{

          $filters = $request->only(['nombre', 'descripcion']);
          $validator = $this->validateData($filters,'validateDataList');
          if($validator["errors"]){
              return response()->json(['status' => 'error','message' => $validator["errors"]], 500);
          }
          $producto = $this->productoService->getFilteredProductos($filters);
          return $this->successResponse($producto, 'Productos listados correctamente');

      return response()->json($producto);
        } catch (\Exception $e) {
          return $this->errorResponse('Ha ocurrido el siguiente error: '. $e->getMessage(),500);
      }
    }
    public function addCreate(request $request){
        $data = $request->only(['nombre','descripcion','id_tipo_producto','fecha_creacion']);
        return $this->sendAddProducto($data);
    }
    private function sendAddProducto($data){
        $validator = Validator::make($data,Producto::$validate);
        if($validator->fails()){
            return $this->errorResponse('Ha ocurrido el siguiente error: '.$validator->errors(),500);
        }
        $producto = new Producto($data);
        $producto->save();
        return $this->successResponse($producto, 'Producto registrado exitosamente',201);
    }
    private function validateData($data,$validacion){
        $validator = Validator::make($data,Producto::${$validacion});
        if($validator->fails()){
            return [
                'success'=>false,
                'errors'=> $validator->errors(),
            ];
        }
    }
    public function getListTipoProducto(){
        return TipoProducto::get();
    }
    public function getProductoById($id){
        $producto = Producto::where("id_producto",$id)->first();
        return $this->successResponse($producto, 'Producto listado correctamente#');
    }
    public function getProductoByNombre($nombre){
        if(empty($nombre)) {
            return $this->errorResponse('El nombre del producto no puede estar vacío.', 400);
        }
        $producto = $this->productoService->getFilteredProductos(['nombre' => $nombre]);
        if (empty($producto)) {
            return $this->errorResponse('No se encontró el producto.', 404);
        }
        return $this->successResponse($producto, 'Productos listados correctamente');
    }
    public function update(request $request){
        $data = $request->only(['id_producto','nombre','descripcion','id_tipo_producto','fecha_creacion']);
        return $this->sendUpdateProducto($data);
    }
    public function sendUpdateProducto($data){
        $validator = Validator::make($data,Producto::$validate);
        if($validator->fails()){
            return $this->errorResponse('Ha ocurrido el siguiente error: '.$validator->errors(),500);
        }
        $producto = Producto::find($data['id_producto']);   
        if (!$producto) {
            return $this->errorResponse('El producto no existe',500);
        }
        $producto->fill($data);
        $producto->save();
        return $this->successResponse($producto,'Productos actualizado exitosamente',201);
    }


}