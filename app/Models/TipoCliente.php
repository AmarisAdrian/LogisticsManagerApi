<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoCliente
 * 
 * @property int $id
 * @property string|null $nombre
 * 
 * @property Collection|Cliente[] $clientes
 *
 * @package App\Models
 */
class TipoCliente extends Model
{
	protected $table = 'tipo_cliente';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function clientes()
	{
		return $this->hasMany(Cliente::class, 'id_tipo_cliente');
	}
}
