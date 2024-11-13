@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Campo para ID de Rol -->
                        <div class="row mb-3">
                            <label for="idrol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>
                            <div class="col-md-6">
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
                        </div>

                        <!-- Campo para Nombre de Usuario con Contador -->
                        <div class="row mb-3">
                            <label for="nombreUsuario" class="col-md-4 col-form-label text-md-end">{{ __('Nombre de Usuario') }}</label>
                            <div class="col-md-6">
                                <input id="nombreUsuario" type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" maxlength="12" value="{{ old('nombreUsuario') }}" required autofocus>
                                <small id="usernameCounter" class="char-counter">12 caracteres restantes</small>

                                @error('nombreUsuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- JavaScript para el contador de nombreUsuario -->
                        <script>
                            const nombreUsuarioInput = document.getElementById('nombreUsuario');
                            const usernameCounter = document.getElementById('usernameCounter');
                            
                            nombreUsuarioInput.addEventListener('input', function () {
                                const remaining = 12 - nombreUsuarioInput.value.length;
                                usernameCounter.textContent = `${remaining} caracteres restantes`;
                            });
                        </script>

                        
                        <!-- Campo para Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="70" value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Campo para Contraseña con Restricciones -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" maxlength="8" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8}">
                                <small class="form-text text-muted">Debe contener exactamente 8 caracteres, incluyendo mayúsculas, minúsculas y números.</small>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <!-- Confirmación de Contraseña -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="8" maxlength="8" required>
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
