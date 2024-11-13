<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InsumosLimpieza extends Model
{
	protected $table = 'insumos_limpieza';
	protected $primaryKey = 'idIInsumo';
	public $timestamps = false;

	protected $casts = [
		'idcategoria' => 'int',
		'stock' => 'int',
		'stockMinimo' => 'float'
	];

	protected $fillable = [
		'idcategoria',
		'nombre',
		'descripcion',
		'stock',
		'unidadMedida',
		'stockMinimo'
	];

	public function categoria()
	{
		return $this->belongsTo(Categorium::class, 'idcategoria');
	}

	public function registro_insumosls()
	{
		return $this->hasMany(RegistroInsumosl::class, 'idinsumo');
	}
}
