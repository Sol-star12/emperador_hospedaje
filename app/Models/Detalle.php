<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Detalle
 * 
 * @property int $idDetalle
 * @property string $ubicacion
 * @property int $piso
 * 
 * @property Collection|Habitacion[] $habitacions
 *
 * @package App\Models
 */
class Detalle extends Model
{
	protected $table = 'detalle';
	protected $primaryKey = 'idDetalle';
	public $timestamps = false;

	protected $casts = [
		'piso' => 'int'
	];

	protected $fillable = [
		'ubicacion',
		'piso'
	];

	public function habitacions()
	{
		return $this->hasMany(Habitacion::class, 'iddetalle');
	}
}
