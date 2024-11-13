<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Caracteristica
 * 
 * @property int $idCaracteristica
 * @property string $nombre
 * @property float $precio
 * 
 * @property Collection|CaracteristicasAlquilada[] $caracteristicas_alquiladas
 *
 * @package App\Models
 */
class Caracteristica extends Model
{
	protected $table = 'caracteristicas';
	protected $primaryKey = 'idCaracteristica';
	public $timestamps = false;

	protected $casts = [
		'precio' => 'float'
	];

	protected $fillable = [
		'nombre',
		'precio'
	];

	public function caracteristicas_alquiladas()
	{
		return $this->hasMany(CaracteristicasAlquilada::class, 'idcaracteristica');
	}
}
