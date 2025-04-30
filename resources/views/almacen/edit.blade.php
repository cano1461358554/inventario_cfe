@extends('layouts.app')

@section('template_title')
    {{ __('Actualizar Almacén') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-edit"></i> {{ __('Editar Almacén') }}</h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('almacens.update', $almacen->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label"><strong>Nombre del Almacén:</strong></label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $almacen->nombre }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="ubicacion" class="form-label"><strong>Ubicación:</strong></label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ $almacen->ubicacion }}" required>
                    </div>

{{--                    <div class="mb-3">--}}
{{--                        <label for="responsable" class="form-label"><strong>Responsable:</strong></label>--}}
{{--                        <input type="text" name="responsable" id="responsable" class="form-control" value="{{ $almacen->responsable }}" required>--}}
{{--                    </div>--}}

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('almacens.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> Actualizar Almacén
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
