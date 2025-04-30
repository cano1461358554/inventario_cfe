@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Material
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-box"></i> {{ __('Crear Material') }}</h3>
            </div>

            <div class="card-body bg-white">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('materials.store') }}" role="form">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="clave">{{ __('Clave') }}</label>
                        <input type="text" name="clave" id="clave" class="form-control" value="Generada automáticamente" readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="nombre">{{ __('Nombre del Material') }}</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        @if ($errors->has('nombre'))
                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <label for="marca">{{ __('Marca') }}</label>
                        <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca') }}" required>
                        @if ($errors->has('marca'))
                            <span class="text-danger">{{ $errors->first('marca') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <label for="descripcion">{{ __('Descripción') }}</label>
                        <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="almacen_id">{{ __('Almacén') }}</label>
                        <select name="almacen_id" id="almacen_id" class="form-control" required>
                            <option value="">Seleccione un almacén</option>
                            @foreach ($almacens as $almacen)
                                <option value="{{ $almacen->id }}" {{ old('almacen_id') == $almacen->id ? 'selected' : '' }}>{{ $almacen->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="estante">{{ __('Estante') }}</label>
                        <input type="text" name="estante" id="estante" class="form-control" value="{{ old('estante') }}" required>
                        @if ($errors->has('estante'))
                            <span class="text-danger">{{ $errors->first('estante') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <label for="categoria_id">{{ __('Categoría') }}</label>
                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="tipomaterial_id">{{ __('Tipo de Material') }}</label>
                        <select name="tipomaterial_id" id="tipomaterial_id" class="form-control" required>
                            <option value="">Seleccione un tipo de material</option>
                            @foreach ($tiposMaterial as $tipoMaterial)
                                <option value="{{ $tipoMaterial->id }}" {{ old('tipomaterial_id') == $tipoMaterial->id ? 'selected' : '' }}>{{ $tipoMaterial->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="unidadmedida_id">{{ __('Unidad de Medida') }}</label>
                        <select name="unidadmedida_id" id="unidadmedida_id" class="form-control" required>
                            <option value="">Seleccione una unidad de medida</option>
                            @foreach ($unidadesMedida as $unidadMedida)
                                <option value="{{ $unidadMedida->id }}" {{ old('unidadmedida_id') == $unidadMedida->id ? 'selected' : '' }}>{{ $unidadMedida->descripcion_unidad }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> {{ __('Guardar') }}
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
