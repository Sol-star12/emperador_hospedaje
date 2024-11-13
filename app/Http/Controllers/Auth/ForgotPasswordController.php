<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function sendResetLinkEmail(Request $request)
{
    // Validación del correo con mensajes personalizados
    $request->validate([
        'email' => 'required|email|exists:usuario,email',  // Verifica que el correo esté registrado
    ], [
        'email.exists' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.' // Mensaje personalizado
    ]);

    // Intentar enviar el enlace de restablecimiento
    $response = Password::sendResetLink($request->only('email'));

    // Verificar la respuesta del sistema de contraseñas
    if ($response == Password::RESET_LINK_SENT) {
        // Enlace enviado correctamente
        return back()->with('status', 'El enlace de restablecimiento de contraseña ha sido enviado.');
    } else {
        // Si no se encuentra el usuario con ese correo
        return back()->withErrors(['email' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.']);
    }
}

}
