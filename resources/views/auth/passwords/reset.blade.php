@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Restablecer contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Campo para el Correo Electrónico con Ícono -->
                        <div class="form-group mb-3">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" maxlength="70" value="{{ $email ?? old('email') }}" 
                                       placeholder="Ingresa correo electrónico" required autofocus>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Campo para Contraseña con Mostrar/Ocultar y Validación -->
                        <div class="form-group mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <div class="position-relative">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" minlength="8" maxlength="8" required 
                                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8}" 
                                       placeholder="Contraseña">
                                <i class="fa fa-eye" id="togglePassword" 
                                   style="cursor: pointer; position: absolute; right: 10px; top: 12px;"></i>
                                <small class="form-text text-muted">Debe contener exactamente 8 caracteres, incluyendo mayúsculas, minúsculas y números.</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo para Confirmación de Contraseña con Mostrar/Ocultar -->
                        <div class="form-group mb-3">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <div class="position-relative">
                                <input id="password-confirm" type="password" class="form-control" 
                                       name="password_confirmation" minlength="8" maxlength="8" 
                                       placeholder="Confirmar contraseña" required>
                                <i class="fa fa-eye" id="togglePasswordConfirm" 
                                   style="cursor: pointer; position: absolute; right: 10px; top: 12px;"></i>
                            </div>
                        </div>

                        <!-- Botón para Restablecer Contraseña -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Restablecer contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para Mostrar/Ocultar Contraseña -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#password-confirm');
        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection
