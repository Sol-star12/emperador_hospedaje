<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organizacione
 * 
 * @property int $idOrganizacion
 * @property string $nombre
 * @property int $ruc
 * 
 * @property EmpresaCliente $empresa_cliente
 *
 * @package App\Models
 */
class Organizacione extends Model
{
	protected $table = 'organizaciones';
	protected $primaryKey = 'idOrganizacion';
	public $timestamps = false;

	protected $casts = [
		'ruc' => 'int'
	];

	protected $fillable = [
		'nombre',
		'ruc'
	];

	public function empresa_cliente()
	{
		return $this->hasOne(EmpresaCliente::class, 'idEmpresa');
	}
}
