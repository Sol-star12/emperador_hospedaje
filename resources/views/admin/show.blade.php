@extends('layouts.admin')
@section('content')

<div class="row"> <!-- Fila para organizar las tarjetas en columnas -->

  <!-- Tarjeta de perfil con imagen -->
  <div class="col-md-4 d-flex justify-content-center">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile text-center">
      <!-- Estado del usuario a la izquierda con margen inferior -->
      <h3 class="profile-username text-left" style="margin-bottom: 15px;">
          @if (optional($usuario)->estado == 'Activo') <!-- Accediendo directamente al estado del usuario -->
            <i class="bi bi-circle-fill" style="color: #00ef00; margin-right: 5px;"></i> Activo
          @else
            <i class="bi bi-circle-fill" style="color: gray; margin-right: 5px;"></i> Inactivo
          @endif
        </h3>
        <img src="{{ $usuario->empleado && $usuario->empleado->foto ? Storage::url($usuario->empleado->foto) : asset('assets/img/usuario.png') }}" 
             alt="user-avatar" 
             class="user-avatar img-fluid mb-3">
        
        <h3 class="profile-username text-center">
          {{ optional($usuario->empleado)->nombre }} {{ optional($usuario->empleado)->apellido }}
        </h3>
        <p class="text-muted">
          {{ optional($usuario->rol)->rol }}
        </p>

        <!-- Botones de acción debajo de la foto -->
        <div class="mt-3">
          <a href="{{ route('admin.empleados') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-caret-left-fill"></i> Regresar
          </a>
          <a href="{{route('admin.empleados.edit',$usuario->idUsuario)}}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-fill"></i> Editar
          </a>          
        </div>
      </div>
    </div>
  </div>

  <!-- Información del usuario -->
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Perfil de usuario</h3>
      </div>
      <div class="card-body">
        <strong><i class="bi bi-person"></i> Nombre de usuario</strong>
        <p class="text-muted">{{ $usuario->nombreUsuario }}</p>
        <hr>
        
        <strong><i class="bi bi-envelope-at-fill"></i> Email</strong>
        <p class="text-muted">{{ $usuario->email }}</p>
        <hr>
      </div>
    </div>

    <!-- Información personal del empleado -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Perfil personal</h3>
      </div>
      <div class="card-body">
        <strong><i class="bi bi-person-vcard-fill"></i> DNI</strong>
        <p class="text-muted">{{ optional($usuario->empleado)->dni }}</p>
        <hr>

        <strong><i class="fas fa-lg fa-birthday-cake"></i> Edad</strong>
        <p class="text-muted">{{ $usuario->edad ?? 'No disponible' }}</p>
        <hr>

        <strong><i class="fas fa-lg fa-birthday-cake"></i> Fecha de nacimiento</strong>
        <p class="text-muted">{{ optional($usuario->empleado?->fNacimiento)->format('d/m/Y') }}</p>
        <hr>

        <strong><i class="fas fa-lg fa-building"></i> Dirección</strong>
        <p class="text-muted">{{ optional($usuario->empleado)->direccion }}</p>
        <hr>

        <strong><i class="fas fa-lg fa-phone"></i> Teléfono</strong>
        <p class="text-muted">{{ optional($usuario->empleado)->telefono }}</p>
        <hr>
      </div>
    </div>
  </div>

</div>

@endsection

