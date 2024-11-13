<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolesPermiso
 * 
 * @property int $idrol
 * @property int $idpermiso
 * 
 * @property Rol $rol
 * @property Permiso $permiso
 *
 * @package App\Models
 */
class RolesPermiso extends Model
{
	protected $table = 'roles_permisos';
	protected $primaryKey = 'idrol';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idrol' => 'int',
		'idpermiso' => 'int'
	];

	protected $fillable = [
		'idpermiso'
	];

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'idrol');
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class, 'idpermiso');
	}
}
