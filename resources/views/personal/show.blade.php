@extends('layouts.app')

@section('template_title')
    {{ $personal->name ?? __('Show') . " " . __('Personal') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Personal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('personals.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $personal->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido:</strong>
                                    {{ $personal->apellido }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rp:</strong>
                                    {{ $personal->RP }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Usuario:</strong>
                                    {{ $personal->tipo_usuario }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
