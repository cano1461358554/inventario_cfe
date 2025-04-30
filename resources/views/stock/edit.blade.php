@extends('layouts.app')

@section('template_title')
    {{ __('Editar Stock') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-edit"></i> {{ __('Editar Stock') }}</h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('stocks.update', $stock->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="cantidad" class="form-label"><strong>{{ __('Cantidad') }}:</strong></label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ $stock->cantidad }}" required>
                        @error('cantidad')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="material_id" class="form-label"><strong>{{ __('Material') }}:</strong></label>
                        <select name="material_id" id="material_id" class="form-control @error('material_id') is-invalid @enderror" required>
                            <option value="">Seleccione un material</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}" {{ $stock->material_id == $material->id ? 'selected' : '' }}>
                                    {{ $material->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('material_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="almacen_id" class="form-label"><strong>{{ __('Almacén') }}:</strong></label>
                        <select name="almacen_id" id="almacen_id" class="form-control @error('almacen_id') is-invalid @enderror" required>
                            <option value="">Seleccione un almacén</option>
                            @foreach ($almacens as $almacen)
                                <option value="{{ $almacen->id }}" {{ $stock->almacen_id == $almacen->id ? 'selected' : '' }}>
                                    {{ $almacen->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('almacen_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('stocks.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
