@extends('layouts.admin')

@section('content')

<div class="row">
  <!-- Tarjeta de perfil con imagen -->
  <div class="col-md-4 d-flex justify-content-center">
    <div class="card card-secondary card-outline">
      <div class="card-body box-profile text-center">
        <form method="POST" action="{{  route('admin.empleados.update', $usuario->idUsuario) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <h3 class="profile-username text-left" style="margin-bottom: 15px;">
            @if (optional($usuario)->estado == 'Activo')
            <i class="bi bi-circle-fill" style="color: #00ef00; margin-right: 5px;"></i> Activo
            @else
            <i class="bi bi-circle-fill" style="color: gray; margin-right: 5px;"></i> Inactivo
            @endif
          </h3>
          <!-- Imagen de perfil -->
          <img src="{{ $usuario->empleado && $usuario->empleado->foto ? Storage::url($usuario->empleado->foto) : asset('assets/img/usuario.png') }}"
            alt="user-avatar" id="user-avatar" class="user-avatar img-fluid mb-3">

          <!-- Nombre de la imagen cargada -->
          <div id="file-name" class="text-muted mb-2"></div>

          <!-- Campo para cambiar la foto -->
          <div class="form-group">
            <label for="foto" class="btn btn-outline-secondary">
              <i class="bi bi-box-arrow-in-up"></i> Cambiar Foto
            </label>
            <input type="file" id="foto" name="foto" class="form-control-file" accept="image/*" style="display: none;">
          </div>
          <h3 class="profile-username text-center">

            <!-- Campo para Nombre -->
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control" maxlength="40" required pattern="^[A-Za-záéíóúÁÉÍÓÚ\s]+$"
                value="{{ old('nombre', optional($usuario->empleado)->nombre) }}" oninput="this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '')" placeholder="Ingrese su nombre">
            </div>

            <!-- Campo para Apellido -->
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input type="text" id="apellido" name="apellido" class="form-control" maxlength="40" required pattern="^[A-Za-záéíóúÁÉÍÓÚ\s]+$"
                value="{{ old('apellido', optional($usuario->empleado)->apellido) }}" oninput="this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '')" placeholder="Ingrese su apellido">
            </div>
          </h3>
          <p class="text-muted">
          <div class="form-group">
            <!-- Selección de Rol -->
            Rol
            @if(Auth::user()->idrol == 1)
                <!-- Mostrar el select solo si el usuario autenticado es administrador -->
                <select
                    id="idrol"
                    class="form-control @error('idrol') is-invalid @enderror"
                    name="idrol"
                    required
                >
                    <option value="">Seleccione un rol</option>
                    <option value="1" @if($usuario->idrol == 1) selected @endif>Administrador</option>
                    <option value="2" @if($usuario->idrol == 2) selected @endif>Recepcionista</option>
                    <option value="3" @if($usuario->idrol == 3) selected @endif>Personal de Limpieza</option>
                    <option value="4" @if($usuario->idrol == 4) selected @endif>Mantenimiento</option>
                </select>
            @else
                <!-- Mostrar el rol como un label si el usuario no tiene permiso para cambiarlo -->
                <label class="form-control">{{ $usuario->rol->rol ?? 'Rol no asignado' }}</label>
                <!-- Añadir un campo oculto para mantener el idrol actual en el formulario -->
                <input type="hidden" name="idrol" value="{{ $usuario->idrol }}">
            @endif
            @error('idrol')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

          </div>
          </p>

          <div class="mt-3">
            <a href="{{ route('admin.empleados') }}" class="btn btn-secondary btn-sm">
              <i class="bi bi-caret-left-fill"></i> Regresar
            </a>
            <button type="submit" class="btn btn-warning btn-sm">
              <i class="bi bi-arrow-repeat"></i> Actualizar
            </button>
          </div>
      </div>
    </div>
  </div>

  <!-- Formulario para la información del usuario -->
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Editar Perfil de Usuario</h3>
      </div>
      <div class="card-body">
        <!-- Formulario para editar usuario -->

        <!-- Nombre de Usuario con Contador -->
        <div class="form-group">
          <label for="nombreUsuario">{{ __('Nombre de Usuario') }}</label>
          <input id="nombreUsuario" type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" maxlength="12" value="{{ old('nombreUsuario', $usuario->nombreUsuario) }}" placeholder="Ingresa un nombre de usuario" required autofocus>
          <small id="usernameCounter" class="char-counter">0 caracteres restantes</small>
          @error('nombreUsuario')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group">
          <label for="email">{{ __('Correo Electrónico') }}</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="70" value="{{ old('email', $usuario->email) }}" placeholder="Ingresa correo electrónico" required>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Perfil personal</h3>
          </div>
          <div class="card-body">
            <!-- Campo para DNI -->
            <div class="form-group">
              <label for="dni">DNI</label>
              <input type="text" id="dni" name="dni" class="form-control" maxlength="8" required pattern="^[0-9]{8}$"
                value="{{ old('dni', optional($usuario->empleado)->dni) }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ingrese su DNI">
              <small class="form-text text-muted">Solo 8 dígitos numéricos.</small>
            </div>



            <!-- Campo para Teléfono -->
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" id="telefono" name="telefono" class="form-control" maxlength="9" required pattern="^[0-9]{9}$"
                value="{{ old('telefono', optional($usuario->empleado)->telefono) }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ingrese su teléfono">
              <small class="form-text text-muted">Solo 9 dígitos numéricos.</small>
            </div>

            <!-- Campo para Fecha de Nacimiento -->
            <div class="form-group">
              <label for="fNacimiento">Fecha de Nacimiento</label>
              <input type="date" id="fNacimiento" name="fNacimiento" class="form-control"
                value="{{ old('fNacimiento', optional($usuario->empleado)->fNacimiento ? optional($usuario->empleado)->fNacimiento->format('Y-m-d') : '') }}" required>
            </div>

            <!-- Campo para Dirección -->
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input type="text" id="direccion" name="direccion" class="form-control" maxlength="90"
                value="{{ old('direccion', optional($usuario->empleado)->direccion) }}" required placeholder="Ingrese su dirección">
            </div>

          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  // JavaScript para mostrar la imagen seleccionada y el nombre del archivo
  document.getElementById('foto').addEventListener('change', function(event) {
    const input = event.target;
    const fileNameElement = document.getElementById('file-name');
    const reader = new FileReader();

    // Mostrar nombre del archivo
    if (input.files && input.files[0]) {
      fileNameElement.textContent = input.files[0].name; // Muestra el nombre del archivo

      // Leer la imagen seleccionada
      reader.onload = function() {
        const imgElement = document.getElementById('user-avatar');
        imgElement.src = reader.result; // Actualiza la imagen con el resultado
      };
      reader.readAsDataURL(input.files[0]); // Lee la imagen seleccionada como Data URL
    }
  });

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
</script>
@endsection