<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogisticaMaritima
 * 
 * @property int $id_logistica_maritima
 * @property int $id_producto
 * @property int $cantidad_producto
 * @property Carbon $fecha_registro
 * @property Carbon $fecha_entrega
 * @property int $id_puerto
 * @property float $precio_envio
 * @property float $precio_con_descuento
 * @property string $numero_flota
 * @property string $numero_guia
 * 
 * @property Producto $producto
 * @property Puerto $puerto
 *
 * @package App\Models
 */
class LogisticaMaritima extends Model
{
	protected $table = 'logistica_maritima';
	protected $primaryKey = 'id_logistica_maritima';
	public $timestamps = false;

	protected $casts = [
		'id_producto' => 'int',
		'cantidad_producto' => 'int',
		'fecha_registro' => 'datetime',
		'fecha_entrega' => 'datetime',
		'id_puerto' => 'int',
		'precio_envio' => 'float',
		'precio_con_descuento' => 'float',
		'id_cliente'=> 'int',
	];

	protected $fillable = [
		'id_producto',
		'cantidad_producto',
		'fecha_registro',
		'fecha_entrega',
		'id_puerto',
		'precio_envio',
		'precio_con_descuento',
		'numero_flota',
		'numero_guia',
		'id_cliente'
	];
	public  static $validate = [
		'id_producto' => 'integer|required',
        'cantidad_producto' => 'integer|required|max:255',
		'fecha_registro'  => 'string|required',
		'fecha_entrega'  =>  'string|required',
		'id_puerto'  =>  'integer|required',
		'precio_envio'  =>  'integer|required',
		'precio_con_descuento'  =>  'integer|required',
		'numero_flota'  =>  'string|required',
		'numero_guia'  =>  'string|required',
		'id_cliente'  =>  'integer|required',

	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'id_producto');
	}

	public function puerto()
	{
		return $this->belongsTo(Puerto::class, 'id_puerto');
	}
}
