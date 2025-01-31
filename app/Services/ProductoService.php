<?php
namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class ProductoService
{
    /**
     * Obtener clientes filtrados.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredProductos(array $filters)
    {
        $query = Producto::from("productos as p")->select("p.id_producto","p.nombre","p.descripcion","tp.nombre as nombre_tipo_producto","p.fecha_creacion")
        ->join("tipo_producto as tp","tp.id","=","p.id_tipo_producto");

        if (isset($filters['nombre'])) {
            $query->where('p.nombre', 'LIKE', "%{$filters['nombre']}%");
        }

        if (isset($filters['descripcion'])) {
            $query->where('p.descripcion', $filters['descripcion']);
        }
        return $query->get();
    }
}