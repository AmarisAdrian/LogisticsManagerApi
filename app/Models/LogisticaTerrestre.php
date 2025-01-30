<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogisticaTerrestre
 * 
 * @property int $id_logistica_terrestre
 * @property int $id_producto
 * @property int $cantidad_producto
 * @property Carbon $fecha_registro
 * @property Carbon $fecha_entrega
 * @property int $id_bodega
 * @property float $precio_envio
 * @property float $precio_con_descuento
 * @property string $placa_vehiculo
 * @property string $numero_guia
 * 
 * @property Producto $producto
 * @property Bodega $bodega
 *
 * @package App\Models
 */
class LogisticaTerrestre extends Model
{
	protected $table = 'logistica_terrestre';
	protected $primaryKey = 'id_logistica_terrestre';
	public $timestamps = false;

	protected $casts = [
		'id_producto' => 'int',
		'cantidad_producto' => 'int',
		'fecha_registro' => 'datetime',
		'fecha_entrega' => 'datetime',
		'id_bodega' => 'int',
		'precio_envio' => 'float',
		'precio_con_descuento' => 'float'
	];

	protected $fillable = [
		'id_producto',
		'cantidad_producto',
		'fecha_registro',
		'fecha_entrega',
		'id_bodega',
		'precio_envio',
		'precio_con_descuento',
		'placa_vehiculo',
		'numero_guia'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'id_producto');
	}

	public function bodega()
	{
		return $this->belongsTo(Bodega::class, 'id_bodega');
	}
}
