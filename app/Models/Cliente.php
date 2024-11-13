<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $idCliente
 * @property string $dni
 * @property int $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $correo
 * @property string $tipoCliente
 * 
 * @property Collection|Alquiler[] $alquilers
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'cliente';
	protected $primaryKey = 'idCliente';
	public $timestamps = false;

	protected $casts = [
		'nombre' => 'int'
	];

	protected $fillable = [
		'dni',
		'nombre',
		'apellido',
		'telefono',
		'correo',
		'tipoCliente'
	];

	public function alquilers()
	{
		return $this->hasMany(Alquiler::class, 'idcliente');
	}
}
