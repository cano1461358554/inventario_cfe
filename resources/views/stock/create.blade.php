@extends('layouts.app')

@section('template_title')
    {{ __('Crear Stock') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-cubes"></i> {{ __('Crear Stock') }}</h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('stocks.store') }}" role="form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="cantidad">{{ __('Cantidad') }}</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="material_id">{{ __('Material') }}</label>
                        <select name="material_id" id="material_id" class="form-control" required>
                            <option value="">Seleccione un material</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="almacen_id">{{ __('Almacén') }}</label>
                        <select name="almacen_id" id="almacen_id" class="form-control" required>
                            <option value="">Seleccione un almacén</option>
                            @foreach ($almacens as $almacen)
                                <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> {{ __('Guardar') }}
                        </button>
                        <a href="{{ route('stocks.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Cancelar') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
