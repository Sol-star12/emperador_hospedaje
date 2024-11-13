<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
class Registrolimpieza extends Model
{
	protected $table = 'registrolimpieza';
	protected $primaryKey = 'idLimpiezaHabitacion';
	public $timestamps = false;

	protected $casts = [
		'idhabitacion' => 'int',
		'idempleado' => 'int',
		'fecha_Limpieza' => 'datetime'
	];

	protected $fillable = [
		'idhabitacion',
		'idempleado',
		'fecha_Limpieza',
		'estado'
	];

	public function habitacion()
	{
		return $this->belongsTo(Habitacion::class, 'idhabitacion');
	}

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'idempleado');
	}

	public function registro_insumosls()
	{
		return $this->hasMany(RegistroInsumosl::class, 'idregistroLimpieza');
	}
}
