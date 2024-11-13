<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpresaCliente
 * 
 * @property int $idEmpresa
 * @property int $idAlquiler
 * 
 * @property Alquiler $alquiler
 * @property Organizacione $organizacione
 *
 * @package App\Models
 */
class EmpresaCliente extends Model
{
	protected $table = 'empresa_cliente';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idEmpresa' => 'int',
		'idAlquiler' => 'int'
	];

	protected $fillable = [
		'idEmpresa',
		'idAlquiler'
	];

	public function alquiler()
	{
		return $this->belongsTo(Alquiler::class, 'idAlquiler');
	}

	public function organizacione()
	{
		return $this->belongsTo(Organizacione::class, 'idEmpresa');
	}
}
