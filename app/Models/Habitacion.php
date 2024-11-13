<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
class Habitacion extends Model
{
	protected $table = 'habitacion';
	protected $primaryKey = 'idHabitacion';
	public $timestamps = false;

	protected $casts = [
		'idtipoHabitacion' => 'int',
		'iddetalle' => 'int'
	];

	protected $fillable = [
		'idtipoHabitacion',
		'iddetalle',
		'estado',
		'estadoLimpieza'
	];

	public function detalle()
	{
		return $this->belongsTo(Detalle::class, 'iddetalle');
	}

	public function tipo_habitacion()
	{
		return $this->belongsTo(TipoHabitacion::class, 'idtipoHabitacion');
	}

	public function alquilers()
	{
		return $this->hasMany(Alquiler::class, 'idhabitacion');
	}

	public function registrolimpiezas()
	{
		return $this->hasMany(Registrolimpieza::class, 'idhabitacion');
	}
}
