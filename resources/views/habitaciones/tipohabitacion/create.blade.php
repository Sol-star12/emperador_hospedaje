@extends('layouts.admin')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('habitaciones.tipohabitacion.store') }}">
        @csrf        
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary mb-4">
                    <div class="card-header">
                        <h3 class="card-title">{{('Registrar Nueva Habitación') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombreTipoHabitación">{{ __('Tipo De Habitación') }}</label>
                            <input id="tipoHabitacion" type="text" class="form-control @error('tipoHabitacion') is-invalid @enderror" name="tipoHabitacion" maxlength="30" value="{{ old('tipoHabitacion') }}" placeholder="Ingresa el tipo de habitación" required autofocus>
                            <small id="contadorTipoHabitacion" class="char-counter">30 caracteres restantes</small>
                            @error('nombreTipoHabitacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col text-center">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('habitaciones.tipohabitacion.index') }}" href="#" id="cancelBtn" class="btn btn-outline-dark me-2" style="font-size: 18px; margin-right: 10px;">
                        <img src="{{ asset('assets/img/cancelar.png') }}" alt="Cancelar" style="width: 20px; height: 20px;">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-outline-dark" id="guardarBtn" style="font-size: 18px;">
                        <img src="{{ asset('assets/img/guardar.png') }}" alt="Guardar" style="width: 20px; height: 20px;"> 
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection