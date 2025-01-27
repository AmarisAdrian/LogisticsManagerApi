<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $id_producto
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $id_tipo_producto
 * @property Carbon $fecha_creacion
 * 
 * @property TipoProducto $tipo_producto
 * @property Collection|LogisticaMaritima[] $logistica_maritimas
 * @property Collection|LogisticaTerrestre[] $logistica_terrestres
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'productos';
	protected $primaryKey = 'id_producto';
	public $timestamps = false;

	protected $casts = [
		'id_tipo_producto' => 'int',
		'fecha_creacion' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'id_tipo_producto',
		'fecha_creacion'
	];

	public function tipo_producto()
	{
		return $this->belongsTo(TipoProducto::class, 'id_tipo_producto');
	}

	public function logistica_maritimas()
	{
		return $this->hasMany(LogisticaMaritima::class, 'id_producto');
	}

	public function logistica_terrestres()
	{
		return $this->hasMany(LogisticaTerrestre::class, 'id_producto');
	}
}
