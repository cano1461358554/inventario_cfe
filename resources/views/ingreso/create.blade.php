@extends('layouts.app')

@section('template_title')
    {{ __('Crear Ingreso') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-sign-in-alt"></i> {{ __('Crear Ingreso') }}</h3>
            </div>

            <div class="card-body bg-white">
                {{-- MENSAJES --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('ingresos.store') }}" role="form">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="cantidad_ingresada">{{ __('Cantidad Ingresada') }}</label>
                        <input type="number" name="cantidad_ingresada" id="cantidad_ingresada"
                               class="form-control @error('cantidad_ingresada') is-invalid @enderror"
                               value="{{ old('cantidad_ingresada') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="fecha">{{ __('Fecha') }}</label>
                        <input type="date" name="fecha" id="fecha"
                               class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha') }}" required readonly>
                    </div>

                    <div class="form-group mb-4">
                        <label for="material_id">{{ __('Material') }}</label>
                        <select name="material_id" id="material_id"
                                class="form-control @error('material_id') is-invalid @enderror" required>
                            <option value="">Seleccione un material</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                    {{ $material->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="personal_id">{{ __('Personal Responsable') }}</label>
                        <select name="personal_id" id="personal_id"
                                class="form-control @error('personal_id') is-invalid @enderror" required>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($personals as $personal)
                                <option value="{{ $personal->id }}" {{ old('personal_id') == $personal->id ? 'selected' : '' }}>
                                    {{ $personal->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <a href="{{ route('materials.create') }}" class="btn btn-info">
                            <i class="fa fa-plus"></i> {{ __('Dar de alta un material') }}
                        </a>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> {{ __('Guardar') }}
                        </button>
                        <a href="{{ route('ingresos.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> {{ __('Cancelar') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fechaInput = document.getElementById('fecha');
            if (!fechaInput.value) {
                const hoy = new Date().toISOString().split('T')[0];
                fechaInput.value = hoy;
            }
        });
    </script>
@endsection
