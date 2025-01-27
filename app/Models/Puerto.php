<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Puerto
 * 
 * @property int $id_puerto
 * @property string $nombre
 * @property int $id_ubicacion
 * @property int $capacidad_recepcion
 * 
 * @property Ubicacion $ubicacion
 * @property Collection|LogisticaMaritima[] $logistica_maritimas
 *
 * @package App\Models
 */
class Puerto extends Model
{
	protected $table = 'puertos';
	protected $primaryKey = 'id_puerto';
	public $timestamps = false;

	protected $casts = [
		'id_ubicacion' => 'int',
		'capacidad_recepcion' => 'int'
	];

	protected $fillable = [
		'nombre',
		'id_ubicacion',
		'capacidad_recepcion'
	];

	public function ubicacion()
	{
		return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
	}

	public function logistica_maritimas()
	{
		return $this->hasMany(LogisticaMaritima::class, 'id_puerto');
	}
}
