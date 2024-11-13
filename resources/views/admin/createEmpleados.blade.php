@extends('layouts.admin')
@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->has('db_error'))
    <div class="alert alert-danger">{{ $errors->first('db_error') }}</div>
    @endif

    @if ($errors->has('general_error'))
    <div class="alert alert-danger">{{ $errors->first('general_error') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('empleados.createEmpleados') }}" id="registerForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Primera tarjeta para datos de usuario -->
            <div class="col-md-6">
                <div class="card card-primary mb-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Registrar Usuario') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Selección de Rol -->
                        <div class="form-group">
                            <label for="idrol">{{ __('Rol') }}</label>
                            <select id="idrol" class="form-control @error('idrol') is-invalid @enderror" name="idrol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Recepcionista</option>
                                <option value="3">Personal de Limpieza</option>
                                <option value="4">Mantenimiento</option>
                            </select>
                            @error('idrol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Nombre de Usuario con Contador -->
                        <div class="form-group">
                            <label for="nombreUsuario">{{ __('Nombre de Usuario') }}</label>
                            <input id="nombreUsuario" type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" maxlength="12" value="{{ old('nombreUsuario') }}" placeholder="Ingresa un nombre de usuario" required autofocus>
                            <small id="usernameCounter" class="char-counter">12 caracteres restantes</small>
                            @error('nombreUsuario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="form-group">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="70" value="{{ old('email') }}" placeholder="Ingresa correo electrónico" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Campo para Contraseña con Icono y Mostrar/Ocultar -->
                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                            <div class="col-md-8 position-relative">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" maxlength="8" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8}" placeholder="Contraseña">
                                <i class="fa fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 12px;"></i>
                                <small class="form-text text-muted">Debe contener exactamente 8 caracteres, incluyendo mayúsculas, minúsculas y números.</small>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmación de Contraseña -->
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>
                            <div class="col-md-8 position-relative">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="8" maxlength="8" placeholder="Confirmar contraseña" required>
                                <i class="fa fa-eye" id="togglePasswordConfirm" style="cursor: pointer; position: absolute; right: 10px; top: 12px;"></i>
                            </div>
                        </div>

                        <div id="passwordError" class="alert alert-danger mt-2" style="display: none;">{{ __('Error: las contraseñas no coinciden.') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Card para Registro de Empleado -->
                <div class="card card-secondary mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Empleado</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Campo para DNI -->
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" id="dni" name="dni" class="form-control" maxlength="8" required pattern="^[0-9]{8}$" value="{{ old('dni') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ingrese su DNI">
                            <small class="form-text text-muted">Solo 8 dígitos numéricos.</small>
                        </div>

                        <!-- Campo para Nombre -->
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" maxlength="40" required pattern="^[A-Za-záéíóúÁÉÍÓÚ\s]+$" value="{{ old('nombre') }}" oninput="this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '')" placeholder="Ingrese su nombre">
                        </div>

                        <!-- Campo para Apellido -->
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="form-control" maxlength="40" required pattern="^[A-Za-záéíóúÁÉÍÓÚ\s]+$" value="{{ old('apellido') }}" oninput="this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '')" placeholder="Ingrese su apellido">
                        </div>

                        <!-- Campo para Teléfono -->
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" maxlength="9" required pattern="^[0-9]{9}$" value="{{ old('telefono') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ingrese su teléfono">
                            <small class="form-text text-muted">Solo 9 dígitos numéricos.</small>
                        </div>
                        <!-- Campo para Fecha de Nacimiento -->
                        <div class="form-group">
                            <label for="fNacimiento">Fecha de Nacimiento</label>
                            <input type="date" id="fNacimiento" name="fNacimiento" class="form-control" value="{{ old('fNacimiento') }}" required>
                        </div>

                        <!-- Campo para Dirección -->
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" maxlength="90" value="{{ old('direccion') }}" required placeholder="Ingrese su dirección">
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control-file" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col text-center">
            <div class="d-flex justify-content-center">
                <a href="#" id="cancelBtn" class="btn btn-outline-dark me-2" style="font-size: 18px; margin-right: 10px; margin-bottom: 20px;">
                    <img src="{{ asset('assets/img/cancelar.png') }}" alt="Cancelar" style="width: 20px; height: 20px;">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-outline-dark" id="guardarBtn" style="font-size: 18px; margin-bottom: 20px;">
                    <img src="{{ asset('assets/img/guardar.png') }}" alt="Guardar" style="width: 20px; height: 20px;">
                    Guardar
                </button>
            </div>
    </form>
</div>
<script>
    const nombreUsuarioInput = document.getElementById('nombreUsuario');
    const usernameCounter = document.getElementById('usernameCounter');
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');

    [nombreInput, apellidoInput].forEach(input => {
        input.addEventListener('input', function() {
            // Permitir letras y espacios, incluyendo acentos
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚ\s]/g, '');
        });
    });
    nombreUsuarioInput.addEventListener('input', function() {
        const remaining = 12 - nombreUsuarioInput.value.length;
        usernameCounter.textContent = `${remaining} caracteres restantes`;

        const regex = /^[a-zA-Z0-9]*$/;
        nombreUsuarioInput.classList.toggle('is-invalid', !regex.test(nombreUsuarioInput.value));
    });
    const guardarBtn = document.getElementById('guardarBtn');
    const originalIcon = '{{ asset("assets/img/guardar.png") }}';
    const hoverIcon = '{{ asset("assets/img/guardar2.png") }}';

    guardarBtn.addEventListener('mouseenter', function() {
        this.querySelector('img').src = hoverIcon; // Cambia al ícono de hover
    });

    guardarBtn.addEventListener('mouseleave', function() {
        this.querySelector('img').src = originalIcon; // Cambia de vuelta al ícono original
    });

    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password-confirm');
    const passwordError = document.getElementById('passwordError');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', function() {
        const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    // Validación de las contraseñas al enviar el formulario
    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', function(event) {
        if (!validatePasswords()) {
            event.preventDefault(); // Evita el envío del formulario si hay un error
            Swal.fire({
                title: "Mensaje",
                text: "Las contraseñas no coinciden.",
                icon: "warning",
                confirmButtonText: "Aceptar",
                confirmButtonColor: '#006aff'
            });
        }
    });

    const validatePasswords = () => {
        const passwordMatch = passwordInput.value === passwordConfirmInput.value;
        passwordError.style.display = passwordMatch ? 'none' : 'block';
        return passwordMatch;
    };
    // Controlar el evento de envío
    registerForm.addEventListener('submit', function(event) {
        if (!validatePasswords()) {
            event.preventDefault(); // Evita el envío del formulario si hay un error
        }
    });

    // Cambiar la funcionalidad del botón "Guardar"
    guardarBtn.addEventListener('click', function() {
        if (registerForm.checkValidity()) {
            registerForm.submit(); // Envía el formulario si es válido
        } else {
            // Aquí podrías manejar los errores de validación
            Swal.fire({
                title: "Mensaje",
                text: "Por favor, completa todos los campos requeridos correctamente.",
                icon: "warning",
                confirmButtonText: "Aceptar",
                confirmButtonColor: '#006aff'
            });
        }
    });
    document.querySelector('.form-control-file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || "Selecciona un archivo";
        const nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Código para el botón cancelar
        const cancelBtn = document.getElementById('cancelBtn');
        const formInputs = document.querySelectorAll('#registerForm input, #registerForm select');

        // Escucha el evento de clic del botón de cancelar
        cancelBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Prevenir la acción predeterminada del botón

            let hasData = false;

            // Verificar si hay datos en los campos de entrada
            formInputs.forEach(input => {
                if (input.type !== 'file' && input.value.trim() !== '') {
                    hasData = true; // Indica que al menos un campo tiene datos
                }
            });

            // Mostrar SweetAlert2 si hay datos en los campos
            if (hasData) {
                Swal.fire({
                    title: 'Salir sin guardar',
                    text: '¿Está seguro que desea salir sin guardar los cambios?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, salir',
                    cancelButtonText: 'No, permanecer',
                    confirmButtonColor: '#006aff',
                    cancelButtonColor: '#ca3b24'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirigir si el usuario confirma
                        window.location.href = "{{ url('empleados') }}"; // Cambia la URL por la de destino
                    }
                });
            } else {
                // Redirigir directamente si no hay datos en el formulario
                window.location.href = "{{ url('empleados') }}"; // Cambia la URL por la de destino
            }
        });


        // Código para manejar el cambio en el input de archivo
        const customFileInput = document.querySelector('.custom-file-input');
        if (customFileInput) {
            customFileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || "Selecciona un archivo";
                const nextSibling = e.target.nextElementSibling;
                if (nextSibling) {
                    nextSibling.innerText = fileName;
                }
            });
        }
    });
</script>
</div>
</div>
@endsection