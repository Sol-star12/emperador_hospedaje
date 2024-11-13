@extends('layouts.admin')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Listado de empleados</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between" style="padding: 10px;">
        <!-- Buscador -->
        <form action="{{ route('admin.empleados.search') }}" method="GET" class="d-flex align-items-center justify-content-between" style="padding: 10px;">
            <div class="input-group" style="width: 300px;">
                <input type="text" name="search" id="search" class="form-control" placeholder="Buscar por nombre, dni o apellido" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Botones para cambiar la vista y nuevo empleado -->
        <div class="d-flex align-items-center">
            <button id="toggleView" class="btn btn-outline-dark" style="margin-right: 10px; width: 80px;">
                <i class="fas fa-th"></i>
            </button>
            <a href="{{ route('admin.createEmpleados') }}" class="btn btn-outline-dark" style="width: 80px; margin-right: 10px;">
                <i class="bi bi-person-fill-add" style="color: green; font-size: 1.5rem;"></i>
            </a>
        </div>
    </div>

    <div id="tableView">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de usuario</th>
                    <th>Email</th>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th style="width: 40px">Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                @php $contador = 0; @endphp
                @foreach ($usuario as $usuarios)
                @php $contador++; 
                @endphp
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $usuarios->nombreUsuario }}</td>
                    <td>{{ $usuarios->email }}</td>
                    <td>{{ optional($usuarios->empleado)->dni }}</td>
                    <td>{{ optional($usuarios->empleado)->nombre }}</td>
                    <td>{{ optional($usuarios->empleado)->apellido }}</td>
                    <td>{{ optional($usuarios->empleado)->telefono }}</td>
                    <td>{{ optional($usuarios->rol)->rol }}</td>
                    <td>{{ $usuarios->estado }}</td>
                    <td style="text-align:center">
                        <a href="{{route('admin.empleados.show',$usuarios->idUsuario)}}" type="button" class="btn btn-success"><i class="bi bi-eye-fill"></i></a>
                        
                        <!-- Verificar el estado del usuario para mostrar el botón adecuado -->
                        @if ($usuarios->estado == 'Activo')
                            <!-- Botón de desactivación -->
                            <form action="{{ route('admin.empleados.deactivate', $usuarios->idUsuario) }}" method="POST" style="display:inline;" id="formulariod{{ $usuarios->idUsuario }}">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="mostrarConfirmacion(event, 'formulariod{{ $usuarios->idUsuario }}', 'Desactivar', '¿Estás seguro que deseas desactivar este usuario?', 'Desactivar')">
                                    <i class="bi bi-trash-fill"></i> Desactivar
                                </button>
                            </form>
                        @else
                            <!-- Botón de activación -->
                            <form action="{{ route('admin.empleados.activate', $usuarios->idUsuario) }}" method="POST" style="display:inline;" id="formulario{{ $usuarios->idUsuario }}">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="mostrarConfirmacion(event, 'formulario{{ $usuarios->idUsuario }}', 'Activar', '¿Desea activar este usuario?', 'Activar')">
                                    <i class="bi bi-check-circle-fill"></i> Activar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div id="cardView" class="row d-none">
    @foreach ($usuario as $usuarios)
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                {{ optional($usuarios->rol)->rol }}
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{ $usuarios->nombreUsuario }}</b></h2>
                        <p class="text-muted text-sm"><b>Usuario: </b> {{ optional($usuarios->empleado)->nombre }} {{ optional($usuarios->empleado)->apellido }}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="bi bi-person-vcard-fill"></i></span> Dni: {{ optional($usuarios->empleado)->dni }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: {{ $usuarios->edad ?? 'No disponible' }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: {{ optional($usuarios->empleado)->direccion }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono: {{ optional($usuarios->empleado)->telefono }}</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{ $usuarios->empleado && $usuarios->empleado->foto ? Storage::url($usuarios->empleado->foto) : asset('assets/img/usuario.png') }}"
                            alt="user-avatar"
                            class="user-avatar img-fluid">
                        <style>
                            .user-avatar {
                                width: 150px;
                                height: 150px;
                                border-radius: 50%;
                                object-fit: cover;
                            }
                        </style>
                        <!-- Mover el bloque de estado aquí -->
                        @if (optional($usuarios)->estado == 'Activo') <!-- Accediendo directamente al estado del usuario -->
                        <i class="bi bi-circle-fill" style="color: #00ef00; margin-right: 5px;"></i> Activo
                        @else
                        <i class="bi bi-circle-fill" style="color: gray; margin-right: 5px;"></i> Inactivo
                        @endif
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                <a href="{{route('admin.empleados.edit',$usuarios->idUsuario)}}" type="button" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>Editar perfil
                </a>
                <!-- Verificar el estado del usuario para mostrar el botón adecuado -->
                @if ($usuarios->estado == 'Activo')
                            <!-- Botón de desactivación -->
                            <form action="{{ route('admin.empleados.deactivate', $usuarios->idUsuario) }}" method="POST" style="display:inline;" id="formulariod{{ $usuarios->idUsuario }}">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="mostrarConfirmacion(event, 'formulariod{{ $usuarios->idUsuario }}', 'Desactivar', '¿Estás seguro que deseas desactivar este usuario?', 'Desactivar')">
                                    <i class="bi bi-trash-fill"></i> Desactivar
                                </button>
                            </form>
                        @else
                            <!-- Botón de activación -->
                            <form action="{{ route('admin.empleados.activate', $usuarios->idUsuario) }}" method="POST" style="display:inline;" id="formulario{{ $usuarios->idUsuario }}">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="mostrarConfirmacion(event, 'formulario{{ $usuarios->idUsuario }}', 'Activar', '¿Desea activar este usuario?', 'Activar')">
                                    <i class="bi bi-check-circle-fill"></i> Activar
                                </button>
                            </form>
                            
                        @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
            Mostrando {{ $usuario->firstItem() }} a {{ $usuario->lastItem() }} de {{ $usuario->total() }} usuarios
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $usuario->links() }}
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('toggleView').addEventListener('click', function() {
        const tableView = document.getElementById('tableView');
        const cardView = document.getElementById('cardView');

        if (tableView.classList.contains('d-none')) {
            tableView.classList.remove('d-none');
            cardView.classList.add('d-none');
            this.innerHTML = '<i class="fas fa-th"></i>';
        } else {
            tableView.classList.add('d-none');
            cardView.classList.remove('d-none');
            this.innerHTML = '<i class="fas fa-table"></i>';
        }
    });
</script>
@endsection