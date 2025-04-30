@extends('layouts.app')

@section('template_title')
    {{ __('Materials') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-box"></i> {{ __('Gestión de Materiales') }}</h3>
            </div>

            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <form method="GET" action="{{ route('materials.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre del material..." value="{{ request('nombre') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="{{ route('materials.index') }}" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('materials.create') }}" class="btn text-white" style="background-color: #A4D65E;">
                                <i class="fa fa-plus-circle"></i> Crear Nuevo
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>
                            <th>{{ __('Clave') }}</th>
                            <th>{{ __('Nombre') }}</th>
                            <th>{{ __('Marca') }}</th>
                            <th>{{ __('Almacén') }}</th>
                            <th>{{ __('Estante') }}</th>
                            <th class="redirectable" data-url="{{ route('categorias.index') }}">{{ __('Categoría') }}</th>
                            <th class="redirectable" data-url="{{ route('tipo-material.index') }}">{{ __('Tipo de Material') }}</th>
                            <th class="redirectable" data-url="{{ route('unidad-medida.index') }}">{{ __('Unidad de Medida') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = ($materials->currentPage() - 1) * $materials->perPage();
                            $nombreBuscado = request('nombre');
                        @endphp
                        @forelse ($materials as $material)
                            @php
                                $coincide = $nombreBuscado && stripos($material->nombre, $nombreBuscado) !== false;
                            @endphp
                            <tr class="{{ $coincide ? 'table-success' : '' }}">
                                <td>{{ $material->clave }}</td>
                                <td>{{ $material->nombre }}</td>
                                <td>{{ $material->marca }}</td>
                                <td>{{ $material->almacen?->nombre ?? 'Sin almacén' }}</td>
                                <td>{{ $material->estante ?? 'Sin estante' }}</td>
                                <td class="redirectable" data-url="{{ route('categorias.index') }}">{{ $material->categoria?->nombre ?? 'Sin categoría' }}</td>
                                <td class="redirectable" data-url="{{ route('tipo-material.index') }}">{{ $material->tipomaterial?->descripcion ?? 'Sin tipo' }}</td>
                                <td class="redirectable" data-url="{{ route('unidad-medida.index') }}">{{ $material->unidadmedida?->descripcion_unidad ?? 'Sin unidad' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar material?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger"><strong>No hay materiales registrados.</strong></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {!! $materials->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
    <div id="hidden-message" style="display: none;">
        Nuevas funciones incorporadas: Redirección con clic derecho en Categoría, Tipo de Material y Unidad de Medida.
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const redirectableCells = document.querySelectorAll('.redirectable');

            redirectableCells.forEach(cell => {
                cell.addEventListener('contextmenu', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('data-url');
                    window.location.href = url;
                });
            });
        });
    </script>
@endsection
