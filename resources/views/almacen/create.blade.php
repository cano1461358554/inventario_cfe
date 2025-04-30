@extends('layouts.app')

@section('template_title')
    {{ __('Crear Almacén') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-plus-circle"></i> {{ __('Nuevo Almacén') }}</h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('almacens.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label"><strong>Nombre del Almacén:</strong></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Ej. Almacén Central" value="{{ old('nombre') }}" required>
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion_id" class="form-label"><strong>Ubicación:</strong></label>
                        <select name="ubicacion_id" id="ubicacion_id" class="form-control @error('ubicacion_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccionar ubicación...</option>
                            @foreach ($ubicacions as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->ubicacion }}</option>
                            @endforeach
                        </select>
                        @error('ubicacion_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('almacens.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> Guardar Almacén
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
