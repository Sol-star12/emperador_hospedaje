<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rol
 * 
 * @property int $idRol
 * @property string $rol
 * @property string $descripcion
 * 
 * @property Collection|Permiso[] $permisos
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Rol extends Model
{
	protected $table = 'rol';
	protected $primaryKey = 'idRol';
	public $timestamps = false;

	protected $fillable = [
		'rol',
		'descripcion'
	];

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class, 'roles_permisos', 'idrol', 'idpermiso');
	}

	public function usuario()
	{
		return $this->hasOne(Usuario::class, 'idrol');
	}
}
