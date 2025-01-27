<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $id_cliente
 * @property string $nombre_completo
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $email
 * @property int $id_tipo_cliente
 * 
 * @property TipoCliente $tipo_cliente
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'id_cliente';
	public $timestamps = false;

	protected $casts = [
		'id_tipo_cliente' => 'int'
	];

	protected $fillable = [
		'nombre_completo',
		'direccion',
		'telefono',
		'email',
		'id_tipo_cliente'
	];

	public  static $validateDataList = [
		'nombre' => 'string|nullable|max:255',
        'email' => 'email|nullable|max:255',
	];
	public function tipo_cliente()
	{
		return $this->belongsTo(TipoCliente::class, 'id_tipo_cliente');
	}
}
