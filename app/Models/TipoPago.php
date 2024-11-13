<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoPago
 * 
 * @property int $idTipoPago
 * @property string $tipoPago
 * @property string $numCuenta
 * 
 * @property Collection|Comprobante[] $comprobantes
 *
 * @package App\Models
 */
class TipoPago extends Model
{
	protected $table = 'tipo_pago';
	protected $primaryKey = 'idTipoPago';
	public $timestamps = false;

	protected $fillable = [
		'tipoPago',
		'numCuenta'
	];

	public function comprobantes()
	{
		return $this->hasMany(Comprobante::class, 'idtipopago');
	}
}
