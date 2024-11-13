<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 * 
 * @property int $idPermiso
 * @property string $permiso
 * @property string $descripcion
 * 
 * @property Collection|Rol[] $rols
 *
 * @package App\Models
 */
class Permiso extends Model
{
	protected $table = 'permisos';
	protected $primaryKey = 'idPermiso';
	public $timestamps = false;

	protected $fillable = [
		'permiso',
		'descripcion'
	];

	public function rols()
	{
		return $this->belongsToMany(Rol::class, 'roles_permisos', 'idpermiso', 'idrol');
	}
}
