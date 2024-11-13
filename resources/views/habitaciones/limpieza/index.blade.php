@extends('layouts.admin')
@section('content')
<div class="row mb-2 align-items-center">
  <h1 style="color: #6d2bf1;">Registro de limpieza de habitaciones</h1>
</div>
<div class="card card-info" style="color: #6d2bf1;">
  <div class="card-header">
    <h3 class="card-title">Limpieza</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 text-end">
        <label><strong>Fecha y Hora Actual:</strong> {{ $fechaHoraActual }}</label>
      </div>

      <!-- Opciones de registro para el administrador (idrol = 1) -->
      @if($usuarioAutenticado->idrol == 1)
        <div class="col-6">
          <label><strong>Seleccione una opción de registro:</strong></label><br>
          <input type="radio" name="registroOption" id="registrarAdministrador" value="administrador" onclick="toggleRegistro()">
          <label for="registrarAdministrador">Registrar como Administrador</label><br>
          <input type="radio" name="registroOption" id="registrarEmpleado" value="empleado" onclick="toggleRegistro()" checked>
          <label for="registrarEmpleado">Registrar al Empleado</label>
        </div>

        <!-- Combo box de empleados, se desactiva si se selecciona "Registrar como Administrador" -->
        <div class="col-6 mt-3" id="empleadoSelection">
          <label for="empleadoCombo"><strong>Seleccione un empleado:</strong></label>
          <select id="empleadoCombo" class="form-control">
            <option value="">-- Selecciona Empleado --</option>
            @foreach($empleados as $empleado)
              <option value="{{ $empleado->idUsuario }}">{{ optional($empleado->empleado)->nombre }} {{ optional($empleado->empleado)->apellido }}</option>
            @endforeach
          </select>
        </div>

        <!-- Información del administrador al seleccionar "Registrar como Administrador" -->
        <div class="col-6 mt-3" id="adminInfo" style="display: none;">
          <label><strong>Registrar como:</strong> {{ optional($usuarioAutenticado->empleado)->nombre }} {{ optional($usuarioAutenticado->empleado)->apellido }}</label>
        </div>
      @elseif($usuarioAutenticado->idrol == 3)
        <!-- Mostrar nombre y apellido del empleado autenticado para rol = 3 -->
        <div class="col-6">
          <label><strong>Empleado:</strong> {{ $empleado->nombre }} {{ $empleado->apellido }}</label>
        </div>
      @endif

      <!-- Combo box de habitaciones sucias -->
      <div class="col-6 mt-3">
        <label for="habitacionSuciasCombo"><strong>Seleccione una Habitación Sucia:</strong></label>
        <select id="habitacionSuciasCombo" class="form-control">
          <option value="">-- Selecciona Habitación --</option>
          @foreach($habitacionesSucias as $habitacion)
            <option value="{{ $habitacion->idHabitacion }}">Habitación {{ $habitacion->idHabitacion }}</option>
          @endforeach
        </select>
      </div>
      
    </div>
  </div>
</div>

<script>
  function toggleRegistro() {
    const registrarAdmin = document.getElementById('registrarAdministrador').checked;
    const comboBox = document.getElementById('empleadoCombo');
    const empleadoSelection = document.getElementById('empleadoSelection');
    const adminInfo = document.getElementById('adminInfo');

    if (registrarAdmin) {
      // Desactivar combo box y mostrar info del administrador
      empleadoSelection.style.display = 'none'; // Ocultar el combo box
      adminInfo.style.display = 'block'; // Mostrar info del administrador
    } else {
      // Activar combo box y ocultar info del administrador
      empleadoSelection.style.display = 'block'; // Mostrar el combo box
      adminInfo.style.display = 'none'; // Ocultar info del administrador
    }
  }
</script>
@endsection
