<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Acompanante
 * 
 * @property int $idalquiler
 * @property string $dni
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * 
 * @property Alquiler $alquiler
 *
 * @package App\Models
 */
class Acompanante extends Model
{
	protected $table = 'acompanante';
	protected $primaryKey = 'idalquiler';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idalquiler' => 'int'
	];

	protected $fillable = [
		'dni',
		'nombre',
		'apellido',
		'telefono'
	];

	public function alquiler()
	{
		return $this->belongsTo(Alquiler::class, 'idalquiler');
	}
}
