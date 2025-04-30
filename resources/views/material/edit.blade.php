@extends('layouts.app')

@section('template_title')
    {{ __('Editar Material') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-box"></i> {{ __('Editar Material') }}</h3>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('materials.update', $material->id) }}" role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    <div class="form-group mb-4">
                        <label for="nombre">{{ __('Nombre del Material') }}</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $material->nombre }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="categoria_id">{{ __('Categoría') }}</label>
                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $material->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="tipomaterial_id">{{ __('Tipo de Material') }}</label>
                        <select name="tipomaterial_id" id="tipomaterial_id" class="form-control" required>
                            <option value="">Seleccione un tipo de material</option>
                            @foreach ($tiposMaterial as $tipoMaterial)
                                <option value="{{ $tipoMaterial->id }}" {{ $material->tipomaterial_id == $tipoMaterial->id ? 'selected' : '' }}>
                                    {{ $tipoMaterial->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="unidadmedida_id">{{ __('Unidad de Medida') }}</label>
                        <select name="unidadmedida_id" id="unidadmedida_id" class="form-control" required>
                            <option value="">Seleccione una unidad de medida</option>
                            @foreach ($unidadesMedida as $unidadMedida)
                                <option value="{{ $unidadMedida->id }}" {{ $material->unidadmedida_id == $unidadMedida->id ? 'selected' : '' }}>
                                    {{ $unidadMedida->descripcion_unidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> {{ __('Guardar Cambios') }}
                        </button>
                        <a href="{{ route('materials.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Cancelar') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
