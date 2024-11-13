<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/style/email.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="login-container">
    <div class="container">
        <!-- Icono centrado de pregunta -->
        <div class="icon-container">
            <i class="fas fa-question-circle"></i>
        </div>

        <!-- Título y mensaje de recuperación de contraseña -->
        <h1>¿Olvidó su Contraseña?</h1>
        <p>No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña.</p>
        
        <!-- Título centrado en azul "El Emperador" -->
        <div class="brand-title">El Emperador</div>

        <!-- Mensaje de éxito o error en atributos 'data-*' -->
        <div id="status-message" data-status="{{ session('status') }}"></div>
        <div id="error-message" data-error="{{ $errors->first('email') }}"></div>

        <!-- Formulario de recuperación -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Campo de email -->
            <div class="input-container">
                <div class="email-icon-container">
                    <i class="fas fa-envelope"></i>
                </div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Correo electrónico" autofocus>
                
                <!-- Mensajes de error de validación -->
                @error('email')
                    <span class="invalid-feedback" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Botón de envío de enlace -->
            <button type="submit" class="login-button">
                Enviar
            </button>
        </form>

        <!-- Botón "Ir a Iniciar Sesión" con el logo -->
        <a href="{{ url('/login') }}" class="brand-link">
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" class="brand-image">
            <button class="inicio-sesion-button">Ir a Iniciar Sesión</button>
        </a>
    </div>
</div>

<script>
    // Verifica si hay un mensaje de éxito
    let successMessage = document.getElementById('status-message').getAttribute('data-status');
    if (successMessage) {
        // Si existe el mensaje de éxito, muestra el SweetAlert
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: successMessage,
        });
    }

    // Verifica si hay un mensaje de error
    let errorMessage = document.getElementById('error-message').getAttribute('data-error');
    if (errorMessage) {
        // Si hay error, muestra el SweetAlert con el mensaje
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: errorMessage,
        });
    }
</script>

</body>
</html>
