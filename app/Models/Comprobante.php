<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comprobante
 * 
 * @property int $idFactura
 * @property int $idempleado
 * @property int $idalquiler
 * @property Carbon $fecha
 * @property int $idtipopago
 * @property string $tipoComprobante
 * 
 * @property TipoPago $tipo_pago
 * @property Empleado $empleado
 *
 * @package App\Models
 */
class Comprobante extends Model
{
	protected $table = 'comprobantes';
	protected $primaryKey = 'idFactura';
	public $timestamps = false;

	protected $casts = [
		'idempleado' => 'int',
		'idalquiler' => 'int',
		'fecha' => 'datetime',
		'idtipopago' => 'int'
	];

	protected $fillable = [
		'idempleado',
		'idalquiler',
		'fecha',
		'idtipopago',
		'tipoComprobante'
	];

	public function tipo_pago()
	{
		return $this->belongsTo(TipoPago::class, 'idtipopago');
	}

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'idempleado');
	}
}
