@extends('layouts.app')

@section('template_title')
    {{ __('Crear Personal') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-user-plus"></i> {{ __('Crear Nuevo Personal') }}</h3>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('personals.store') }}" role="form">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        @if ($errors->has('nombre'))
                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="apellido" class="form-label">{{ __('Apellido') }}</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
                        @if ($errors->has('apellido'))
                            <span class="text-danger">{{ $errors->first('apellido') }}</span>
                        @endif
                    </div>

{{--                    <!-- Campo: RP -->--}}
{{--                    <div class="form-group mb-3">--}}
{{--                        <label for="RP" class="form-label">{{ __('RP') }}</label>--}}
{{--                        <input type="text" name="RP" id="RP" class="form-control" value="{{ old('RP') }}" required>--}}
{{--                        @if ($errors->has('RP'))--}}
{{--                            <span class="text-danger">{{ $errors->first('RP') }}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
                    <div class="form-group mb-3">
                        <label for="RP" class="form-label">{{ __('RP') }}</label>
                        <input type="text" name="RP" id="RP" class="form-control" value="{{ old('RP') }}" required>
                        @if ($errors->has('RP'))
                            <span class="text-danger">{{ $errors->first('RP') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipo_usuario" class="form-label">{{ __('Tipo de Usuario') }}</label>
                        <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Administrador" {{ old('tipo_usuario') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Supervisor" {{ old('tipo_usuario') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="Empleado" {{ old('tipo_usuario') == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                        </select>
                        @if ($errors->has('tipo_usuario'))
                            <span class="text-danger">{{ $errors->first('tipo_usuario') }}</span>
                        @endif
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> {{ __('Guardar') }}
                        </button>
                        <a href="{{ route('personals.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> {{ __('Cancelar') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
