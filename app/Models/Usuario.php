<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
class Usuario extends Authenticatable
{
	protected $table = 'usuario';
	use Notifiable; 
	protected $primaryKey = 'idUsuario';

	protected $casts = [
		'idrol' => 'int',
		'email_verified_at' => 'datetime',
		'estado' => 'string'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'idrol',
		'nombreUsuario',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'estado'
	];
	

	protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
		
    }

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'idrol');
	}

	//Verificacion de roles
	public function getRolNameAttribute()
	{
		$roles = [
			1 => 'Administrador',
			2 => 'Recepcionista',
			3 => 'Personal de Limpieza',
			4 => 'Personal de Mantenimiento'
		];

		return $roles[$this->idrol] ?? 'Desconocido';
	}
	public function empleado()
	{
		return $this->hasOne(Empleado::class, 'idusuario');
	}
	public function getEstadoNombreAttribute()
	{
		return $this->estado === 'Activo' ? 'Activo' : 'Inactivo';
	}
}
