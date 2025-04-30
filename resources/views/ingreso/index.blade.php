@extends('layouts.app')

@section('template_title')
    {{ __('Ingresos') }}
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white" style="background-color: #00723E;">
                <h3 class="mb-0"><i class="fa fa-sign-in-alt"></i> {{ __('Gestión de Ingresos') }}</h3>
            </div>

            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <form method="GET" action="{{ route('ingresos.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="fecha" class="form-control" placeholder="Buscar por fecha de ingreso..." value="{{ request('fecha') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn text-white" style="background-color: #4CAF50;">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a href="{{ route('ingresos.index') }}" class="btn btn-warning">
                                <i class="fa fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('ingresos.create') }}" class="btn text-white" style="background-color: #A4D65E;">
                                <i class="fa fa-plus-circle"></i> Crear Nuevo
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white text-center" style="background-color: #00723E;">
                        <tr>
{{--                            <th>No</th>--}}
                            <th>{{ __('Material') }}</th>
                            <th>{{ __('Personal') }}</th>
                            <th>{{ __('Cantidad') }}</th>
                            <th>{{ __('Fecha') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ingresos as $ingreso)
                            <tr>
{{--                                <td class="text-center">{{ $loop->iteration }}</td>--}}
                                <td>{{ $ingreso->material->nombre ?? 'Sin material' }}</td>
                                <td>{{ $ingreso->personal->nombre ?? 'Sin personal' }}</td>
                                <td>{{ $ingreso->cantidad_ingresada }}</td>
                                <td>{{ $ingreso->fecha }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ingresos.edit', $ingreso->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('ingresos.destroy', $ingreso->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este ingreso?')">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {!! $ingresos->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
