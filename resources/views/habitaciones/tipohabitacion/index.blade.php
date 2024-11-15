@extends('layouts.admin')
@section('content')
<div class="card card-primary">
    <div class="box box-primary">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">Administrar Tipos De Habitación</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"
                        data-card-widget="card-refresh"
                        data-source="widgets.html"
                        data-source-selector="#card-refresh-content">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <a href="{{ url('/habitaciones/tipohabitacion/create') }}" class="btn btn-tool btn-success">
                        <i class="bi bi-plus"></i> Nuevo
                    </a>
                </div>
            </div>
        </div>

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-tools">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar..."
                            aria-label="Buscar..." aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button"
                                id="button-addon2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="box-body-no-padding">
            <table
                class="table table-striped table-bordered table-hover dataTable">
                <thead class="bg-blue">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Tipo Habitacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiposHabitacion as $tipoHabitacion)
                    <tr>
                        <td>{{ $tipoHabitacion->idTipoHabitacion }}</td>
                        <td>{{ $tipoHabitacion->tipoHabitacion }}</td>
                        <td>
                            <a href="{{ route('habitaciones/tipohabitacion/edit') }}"
                                class="btn btn-sm btn-info"><i
                                    class="fa fa-pencil"></i> Editar</a>
                            <a class="btn btn-sm btn-danger"><i
                                    class="fa fa-trash"></i> Eliminar</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="box-footer">
            <div class="row">
                <div class="col-sm-3">
                    Mostrando <span>1-10</span> de <span>100</span> registros
                </div>
                <div class="col-sm-9">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection