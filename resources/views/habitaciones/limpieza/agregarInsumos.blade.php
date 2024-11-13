@extends('layouts.admin')
@section('content')
<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Insumos de limpieza</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('limpieza.agregarInsumos') }}" id="registerForm" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-sm-6">
                    <label for="categoria" class="visually-hidden">Selecciona la categoria</label>
                    <select name="categoria_id" id="categoria" class="form-control" class="form-control @error('idcategoria') is-invalid @enderror" name="idcategoria" style="width: 300px;">
                        <option value="">-- Categorías --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->idCategoria }}" {{ request('categoria_id') == $categoria->idCategoria ? 'selected' : '' }}>{{ $categoria->nomCategoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombre del insumo de limpieza</label>
                        <input type="text" name="nombre" class="form-control" maxlength="50" required pattern="^[A-Za-záéíóúÁÉÍÓÚ\s]+$" value="{{ old('nombre') }}" oninput="this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '')" placeholder="Ingresa el nombre del insumo de limpieza">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- Descripción -->
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3" maxlength="255" required pattern="^[A-Za-záéíóúÁÉÍÓÚ\s]+$" value="{{ old('descripcion') }}" oninput="this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '')" placeholder="Descripción"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- Stock -->
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" required pattern="^[0-9]{9}$" value="{{ old('stock') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ingresa el stock disponible" min="1">
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- Unidad de Medida -->
                    <div class="form-group">
                        <label for="unidadMedida">Unidad de Medida</label>
                        <select name="unidadMedida" id="unidadMedida" class="form-control @error('unidadMedida') is-invalid @enderror" name="unidadMedida" required>
                            <option value="">-- Selecciona la unidad --</option>
                            <option value="Kilogramos">Kilogramos</option>
                            <option value="Litros">Litros</option>
                            <option value="Unidades">Unidades</option>
                            <option value="Paquete">Paquete</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- Stock Mínimo -->
                    <div class="form-group">
                        <label>Stock Mínimo</label>
                        <input type="number" name="stockMinimo" class="form-control" required pattern="^[0-9]{9}$" value="{{ old('stockMinimo') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Ingresa el stock mínimo" min="1">
                    </div>
                </div>
            </div>
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
    <!-- /.card-body -->
     <script>
        const guardarBtn = document.getElementById('guardarBtn');
        const originalIcon = '{{ asset("assets/img/guardar.png") }}';
        const hoverIcon = '{{ asset("assets/img/guardar2.png") }}';

        guardarBtn.addEventListener('mouseenter', function() {
            this.querySelector('img').src = hoverIcon; // Cambia al ícono de hover
        });

        guardarBtn.addEventListener('mouseleave', function() {
            this.querySelector('img').src = originalIcon; // Cambia de vuelta al ícono original
        });

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
                        window.location.href = "{{ url('habitaciones/limpieza') }}"; // Cambia la URL por la de destino
                    }
                });
            } else {
                // Redirigir directamente si no hay datos en el formulario
                window.location.href = "{{ url('habitaciones/limpieza') }}"; // Cambia la URL por la de destino
            }
        });

    });
     </script>
</div>
@endsection
