<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
	protected $table = 'empleados';
	protected $primaryKey = 'idEmpleado';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int',
		'fNacimiento' => 'datetime'
	];

	protected $fillable = [
		'idusuario',
		'dni',
		'nombre',
		'apellido',
		'telefono',
		'fNacimiento',
		'direccion',
		'foto',
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}

	public function comprobantes()
	{
		return $this->hasMany(Comprobante::class, 'idempleado');
	}

	public function registrolimpiezas()
	{
		return $this->hasMany(Registrolimpieza::class, 'idempleado');
	}
}
