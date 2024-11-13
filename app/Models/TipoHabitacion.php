<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoHabitacion
 * 
 * @property int $idTipoHabitacion
 * @property string $tipoHabitacion
 * 
 * @property Collection|Habitacion[] $habitacions
 *
 * @package App\Models
 */
class TipoHabitacion extends Model
{
	protected $table = 'tipo_habitacion';
	protected $primaryKey = 'idTipoHabitacion';
	public $timestamps = false;

	protected $fillable = [
		'tipoHabitacion'
	];

	public function habitacions()
	{
		return $this->hasMany(Habitacion::class, 'idtipoHabitacion');
	}
}
