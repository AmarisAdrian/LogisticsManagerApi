<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bodega
 * 
 * @property int $id_bodega
 * @property string $nombre
 * @property int $id_ubicacion
 * @property int $capacidad_almacenamiento
 * 
 * @property Ubicacion $ubicacion
 * @property Collection|LogisticaTerrestre[] $logistica_terrestres
 *
 * @package App\Models
 */
class Bodega extends Model
{
	protected $table = 'bodegas';
	protected $primaryKey = 'id_bodega';
	public $timestamps = false;

	protected $casts = [
		'id_ubicacion' => 'int',
		'capacidad_almacenamiento' => 'int'
	];

	protected $fillable = [
		'nombre',
		'id_ubicacion',
		'capacidad_almacenamiento'
	];

	public function ubicacion()
	{
		return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
	}

	public function logistica_terrestres()
	{
		return $this->hasMany(LogisticaTerrestre::class, 'id_bodega');
	}
}
