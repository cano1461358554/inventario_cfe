@extends('layouts.app')

@section('template_title')
    {{ __('Crear Préstamo') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-hand-holding-usd"></i> {{ __('Crear Nuevo Préstamo') }}</h3>
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

                <form method="POST" action="{{ route('prestamos.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="fecha_prestamo">{{ __('Fecha de Préstamo') }}</label>
                        <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo"
                               value="{{ now()->format('Y-m-d') }}" readonly>
                        <small class="form-text text-muted">Generada automáticamente</small>
                    </div>

                    <div class="form-group">
                        <label for="cantidad_prestada">{{ __('Cantidad Prestada') }}</label>
                        <input type="number" name="cantidad_prestada" id="cantidad_prestada"
                               class="form-control" value="{{ old('cantidad_prestada') }}"
                               min="0.01" step="0.01" required>
                        @error('cantidad_prestada')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="material_id">{{ __('Material') }}</label>
                            <a href="{{ route('materials.create') }}" class="btn btn-sm btn-outline-success">
                                <i class="fa fa-plus"></i> {{ __('Nuevo Material') }}
                            </a>
                        </div>
                        <select name="material_id" id="material_id" class="form-control" required>
                            <option value="">Seleccione un material</option>
                            @foreach ($materials as $material)
                                @php
                                    $stockTotal = $material->stocks->sum('cantidad');
                                @endphp
                                <option value="{{ $material->id }}"
                                        {{ old('material_id') == $material->id ? 'selected' : '' }}
                                        data-stock="{{ $stockTotal }}">
                                    {{ $material->nombre }} (Stock: {{ $stockTotal }})
                                </option>
                            @endforeach
                        </select>
                        <small id="stockHelp" class="form-text text-muted">
                            Solo se muestran materiales con stock disponible
                        </small>
                        @error('material_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="personal_id">{{ __('Personal') }}</label>
                        <select name="personal_id" id="personal_id" class="form-control" required>
                            <option value="">Seleccione un personal</option>
                            @foreach ($personals as $personal)
                                <option value="{{ $personal->id }}" {{ old('personal_id') == $personal->id ? 'selected' : '' }}>
                                    {{ $personal->nombre }} {{ $personal->apellido }} (RP: {{ $personal->RP }})
                                </option>
                            @endforeach
                        </select>
                        @error('personal_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">{{ __('Descripción de uso') }}</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                            <i class="fa fa-save"></i> {{ __('Guardar Préstamo') }}
                        </button>
                        <a href="{{ route('prestamos.index') }}" class="btn btn-secondary ml-2">
                            <i class="fa fa-times"></i> {{ __('Cancelar') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const materialSelect = document.getElementById('material_id');
                const cantidadInput = document.getElementById('cantidad_prestada');

                // Validar stock al seleccionar material
                materialSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const stockDisponible = parseFloat(selectedOption.getAttribute('data-stock'));

                    // Actualizar el máximo permitido
                    cantidadInput.setAttribute('max', stockDisponible);

                    // Mostrar ayuda
                    if (selectedOption.value) {
                        document.getElementById('stockHelp').textContent =
                            `Stock disponible: ${stockDisponible}. Máximo permitido: ${stockDisponible}`;
                    } else {
                        document.getElementById('stockHelp').textContent =
                            'Solo se muestran materiales con stock disponible';
                    }
                });

                // Validar stock al enviar el formulario
                document.querySelector('form').addEventListener('submit', function(e) {
                    const selectedOption = materialSelect.options[materialSelect.selectedIndex];
                    const stockDisponible = parseFloat(selectedOption.getAttribute('data-stock'));
                    const cantidad = parseFloat(cantidadInput.value);

                    if (cantidad > stockDisponible) {
                        e.preventDefault();
                        alert(`No hay suficiente stock disponible. Stock actual: ${stockDisponible}`);
                    }
                });
            });
        </script>
    @endpush
@endsection
