<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ubicacion
 * 
 * @property int $id
 * @property string|null $nombre
 * 
 * @property Collection|Bodega[] $bodegas
 * @property Collection|Puerto[] $puertos
 *
 * @package App\Models
 */
class Ubicacion extends Model
{
	protected $table = 'ubicacion';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function bodegas()
	{
		return $this->hasMany(Bodega::class, 'id_ubicacion');
	}

	public function puertos()
	{
		return $this->hasMany(Puerto::class, 'id_ubicacion');
	}
}
