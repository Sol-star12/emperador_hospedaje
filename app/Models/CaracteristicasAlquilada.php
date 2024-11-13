<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaracteristicasAlquilada
 * 
 * @property int $idalquiler
 * @property int $idcaracteristica
 * 
 * @property Caracteristica $caracteristica
 * @property Alquiler $alquiler
 *
 * @package App\Models
 */
class CaracteristicasAlquilada extends Model
{
	protected $table = 'caracteristicas_alquiladas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idalquiler' => 'int',
		'idcaracteristica' => 'int'
	];

	public function caracteristica()
	{
		return $this->belongsTo(Caracteristica::class, 'idcaracteristica');
	}

	public function alquiler()
	{
		return $this->belongsTo(Alquiler::class, 'idalquiler');
	}
}
