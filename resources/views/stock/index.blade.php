@extends('layouts.app')

@section('template_title')
    {{ __('Stocks') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-boxes"></i> {{ __('Gestión de Stocks') }}</h3>
            </div>

            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <form method="GET" action="{{ route('stocks.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="material" class="form-control" placeholder="Buscar por nombre del material..." value="{{ request('material') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="{{ route('stocks.index') }}" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('stocks.create') }}" class="btn text-white" style="background-color: #A4D65E;">
                                <i class="fa fa-plus-circle"></i> Crear Nuevo
                            </a>
                        </div>
                    </div>

                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="mostrar_coincidencias" name="mostrar_coincidencias"
                               {{ request('mostrar_coincidencias') ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <label class="form-check-label" for="mostrar_coincidencias">Mostrar solo coincidencias</label>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>
                            <th>No</th>
                            <th>{{ __('Cantidad') }}</th>
                            <th class="redirectable" data-url="{{ route('materials.index') }}">{{ __('Material') }}</th>
                            <th class="redirectable" data-url="{{ route('almacens.index') }}">{{ __('Almacén') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = ($stocks->currentPage() - 1) * $stocks->perPage();
                            $materialBuscado = request('material');
                        @endphp

                        @forelse ($stocks as $stock)
                            @php
                                $coincide = $materialBuscado && stripos($stock->material->nombre, $materialBuscado) !== false;
                            @endphp
                            <tr class="{{ $coincide ? 'table-success' : '' }}">
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $stock->cantidad }}</td>
                                <td class="redirectable" data-url="{{ route('materials.index') }}">{{ $stock->material->nombre }}</td>
                                <td class="redirectable" data-url="{{ route('almacens.index') }}">{{ $stock->almacen->nombre }}</td>
                                <td class="text-center">
                                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar stock?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger"><strong>No hay stocks registrados.</strong></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {!! $stocks->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const redirectableCells = document.querySelectorAll('.redirectable');

            redirectableCells.forEach(cell => {
                cell.style.cursor = 'context-menu';

                cell.addEventListener('contextmenu', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('data-url');
                    window.location.href = url;
                });

                cell.title = "Clic derecho para ir a " + (cell.textContent.trim().toLowerCase().includes('material') ? "Materiales" : "Almacenes");
            });
        });
    </script>
@endsection
