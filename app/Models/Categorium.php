<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorium extends Model
{
	protected $table = 'categoria';
	protected $primaryKey = 'idCategoria';
	public $timestamps = false;

	protected $fillable = [
		'nomCategoria',
		'descripcion'
	];

	public function insumos_limpieza()
	{
		return $this->hasOne(InsumosLimpieza::class, 'idcategoria');
	}
}
