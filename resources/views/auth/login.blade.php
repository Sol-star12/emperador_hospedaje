<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/style/style_login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Para los íconos -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="login-container">
        <div class="container">
            @if ( ($message = Session::get('mensaje')) && ($icono = Session::get('icono')) )
            <script>
                Swal.fire({
                    title: "Mensaje",
                    text: "{{$message}}",
                    icon: "{{$icono}}"
                });
            </script>
            @endif
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" style="max-width: 40%; height: auto; margin-bottom: 20px;">
            <h2>Hospedaje "El Emperador"</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-container">
                    <i class="fa fa-user"></i>
                    <input type="text" name="nombreUsuario" id="nombreUsuario" maxlength="12" placeholder="Nombre de usuario" value="{{ old('nombreUsuario') }}" required autofocus>
                    <!-- <small id="usernameCounter" class="char-counter">12 caracteres restantes</small> -->
                </div>
                <div class="input-container">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" id="password" maxlength="8" placeholder="Contraseña" required>
                    <i class="fa fa-eye" id="togglePassword"></i>
                    <!-- <small id="passwordCounter" class="char-counter">8 caracteres restantes</small> -->
                </div>
                <div class="remember-me-container">
                    <input type="checkbox" name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember-me">Recuérdame</label>
                </div>
                <button type="submit" class="login-button">LOGIN</button>
                <p><a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a></p>
            </form>
        </div>

        <div class="motivational-container">
            <div class="motivational-content">
                <img src="{{ asset('assets/img/inicio.jpg') }}" alt="Hospedaje" class="motivational-image">
                <p class="footer">
                    ¿Aún no estás registrado?
                    <a href="https://wa.me/51924829519?text=Requiero%20un%20usuario%20para%20ingresar%20a%20la%20plataforma%20del%20Emperador" target="_blank">
                        Contáctate con el administrador
                    </a>
                </p>
            </div>
        </div>
    </div>
    <script>
        // Mostrar / Ocultar contraseña
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Contador de caracteres para nombreUsuario
        const nombreUsuario = document.querySelector('#nombreUsuario');
        const usernameCounter = document.querySelector('#usernameCounter');

        nombreUsuario.addEventListener('input', function() {
            const remaining = 12 - nombreUsuario.value.length;
            usernameCounter.textContent = `${remaining} caracteres restantes`;
        });

        // Contador de caracteres para password
        const passwordCounter = document.querySelector('#passwordCounter');

        password.addEventListener('input', function() {
            const remaining = 8 - password.value.length;
            passwordCounter.textContent = `${remaining} caracteres restantes`;
        });
    </script>
</body>

</html>