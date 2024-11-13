<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alquiler
 * 
 * @property int $idAlquiler
 * @property Carbon $fecha_entrada
 * @property Carbon $fecha_salida
 * @property float $totalPago
 * @property int $idhabitacion
 * @property int $idcliente
 * @property float $reserva
 * 
 * @property Habitacion $habitacion
 * @property Cliente $cliente
 * @property Acompanante $acompanante
 * @property CaracteristicasAlquilada $caracteristicas_alquilada
 * @property EmpresaCliente $empresa_cliente
 *
 * @package App\Models
 */
class Alquiler extends Model
{
	protected $table = 'alquiler';
	protected $primaryKey = 'idAlquiler';
	public $timestamps = false;

	protected $casts = [
		'fecha_entrada' => 'datetime',
		'fecha_salida' => 'datetime',
		'totalPago' => 'float',
		'idhabitacion' => 'int',
		'idcliente' => 'int',
		'reserva' => 'float'
	];

	protected $fillable = [
		'fecha_entrada',
		'fecha_salida',
		'totalPago',
		'idhabitacion',
		'idcliente',
		'reserva'
	];

	public function habitacion()
	{
		return $this->belongsTo(Habitacion::class, 'idhabitacion');
	}

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'idcliente');
	}

	public function acompanante()
	{
		return $this->hasOne(Acompanante::class, 'idalquiler');
	}

	public function caracteristicas_alquilada()
	{
		return $this->hasOne(CaracteristicasAlquilada::class, 'idalquiler');
	}

	public function empresa_cliente()
	{
		return $this->hasOne(EmpresaCliente::class, 'idAlquiler');
	}
}
