<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoProducto
 * 
 * @property int $id
 * @property string|null $nombre
 * 
 * @property Collection|Producto[] $productos
 *
 * @package App\Models
 */
class TipoProducto extends Model
{
	protected $table = 'tipo_producto';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function productos()
	{
		return $this->hasMany(Producto::class, 'id_tipo_producto');
	}
}
