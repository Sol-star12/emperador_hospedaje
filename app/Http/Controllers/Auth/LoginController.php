<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function username()
    {
        return 'nombreUsuario';
    }
    use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    // Sobrescribir el método 'authenticated' del trait AuthenticatesUsers
    protected function authenticated($request, $user)
    {
        // Verificar el estado del usuario (estado debe ser 'Activo')
        if ($user->estado !== 'Activo') {
            // Si el estado no es 'Activo', cerramos sesión y mostramos el mensaje de error
            Auth::logout(); // Cerrar sesión del usuario

            // Redirigir con mensaje y tipo de icono usando la sesión
            return redirect('/login')
                ->with('mensaje', 'Tu cuenta no está activa. Por favor, contacta al administrador.')
                ->with('icono', 'error');
                
        }

        return redirect()->intended($this->redirectTo)
            ->with('mensaje', 'Inicio de sesión exitoso')
            ->with('icono', 'success');;
    }
    
}

