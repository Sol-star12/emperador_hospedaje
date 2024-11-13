<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegistroInsumosl
 * 
 * @property int $idregistroLimpieza
 * @property int $idinsumo
 * @property int $cantidad
 * 
 * @property InsumosLimpieza $insumos_limpieza
 * @property Registrolimpieza $registrolimpieza
 *
 * @package App\Models
 */
class RegistroInsumosl extends Model
{
	protected $table = 'registro_insumosl';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idregistroLimpieza' => 'int',
		'idinsumo' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'cantidad'
	];

	public function insumos_limpieza()
	{
		return $this->belongsTo(InsumosLimpieza::class, 'idinsumo');
	}

	public function registrolimpieza()
	{
		return $this->belongsTo(Registrolimpieza::class, 'idregistroLimpieza');
	}
}
