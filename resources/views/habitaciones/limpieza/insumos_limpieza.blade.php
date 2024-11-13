@extends('layouts.admin')
@section('content')
<div class="row mb-2 align-items-center">
    <div class="col-sm-6 d-flex align-items-center" >
        <img src="{{ asset('assets/img/productos.png') }}" alt="Productos de limpieza" style="max-width: 50px; height: auto; margin-right: 10px;" />
        <h1 style="color: #cc9a05;">Insumos de limpieza</h1>
    </div>
    <div class="col-sm-6 text-end">
    <form action="{{ route('habitaciones.limpieza.insumos_limpieza') }}" method="GET" class="d-flex align-items-center justify-content-end"> 
            <a href="{{ route('habitaciones.limpieza.agregarInsumos') }}" class="btn btn-outline-dark me-2" style="width: 80px; margin-right:20px">
                <i class="bi bi-plus-circle-fill" style="color: green; font-size: 1.5rem;"></i>
            </a>
            <div class="form-group mb-0 me-2">
                <label for="categoria" class="visually-hidden">Filtrar por categoría:</label>
                <select name="categoria_id" id="categoria" class="form-control" style="width: 300px;">
                    <option value="">-- Todas las Categorías --</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->idCategoria }}" {{ request('categoria_id') == $categoria->idCategoria ? 'selected' : '' }}>{{ $categoria->nomCategoria }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-lg"> 
                <i class="bi bi-filter"></i> Filtrar
            </button>
        </form>
    </div>
</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Listado de insumos de limpieza</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>
{{-- tabla de insumos --}}
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Insumo</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Unidad de Medida</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->idIInsumo }}</td>
                        <td>{{ $insumo->nombre }}</td>
                        <td>{{ $insumo->descripcion }}</td>
                        <td>{{ $insumo->stock }}</td>
                        <td>{{ $insumo->unidadMedida }}</td>
                        <td>{{ optional($insumo->categoria)->nomCategoria }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" role="status" aria-live="polite">
                    Mostrando {{ $insumos->firstItem() }} a {{ $insumos->lastItem() }} de {{ $insumos->total() }} insumos
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        @if ($insumos->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $insumos->previousPageUrl() }}">Anterior</a></li>
                        @endif

                        @foreach ($insumos->getUrlRange(1, $insumos->lastPage()) as $page => $url)
                            <li class="page-item {{ ($page == $insumos->currentPage()) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($insumos->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $insumos->nextPageUrl() }}">Siguiente</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
