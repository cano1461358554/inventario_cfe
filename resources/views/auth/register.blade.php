@extends('layouts.app')

@section('content')
    <div class="auth-page">
        <div class="register-container">
            <div class="register-header">
                <h2>{{ __('Register') }}</h2>
                <p>{{ __('Completa el formulario para crear una cuenta') }}</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                               name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus
                               placeholder="{{ __('Ingresa tu nombre') }}">
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="apellido">{{ __('Apellido') }}</label>
                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror"
                               name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido"
                               placeholder="{{ __('Ingresa tu apellido') }}">
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="RP">{{ __('RP') }} <span class="required-field">*</span></label>
                    <input id="RP" type="text" class="form-control @error('RP') is-invalid @enderror"
                           name="RP" value="{{ old('RP') }}" required autocomplete="RP"
                           placeholder="{{ __('Ingresa tu número de RP') }}">
                    <small class="form-text text-muted">Este será tu identificador principal para iniciar sesión</small>
                    @error('RP')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipo_usuario">{{ __('Tipo de Usuario') }}</label>
                    <select id="tipo_usuario" class="form-control @error('tipo_usuario') is-invalid @enderror"
                            name="tipo_usuario" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="admin" {{ old('tipo_usuario') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="encargado" {{ old('tipo_usuario') == 'encargado' ? 'selected' : '' }}>Encargado</option>
                        <option value="empleado" {{ old('tipo_usuario') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                    </select>
                    @error('tipo_usuario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="email">{{ __('Correo Electrónico') }} <span class="required-field">*</span></label>--}}
{{--                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"--}}
{{--                           name="email" value="{{ old('email') }}" required autocomplete="email"--}}
{{--                           placeholder="{{ __('Ingresa tu correo electrónico') }}">--}}
{{--                    @error('email')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password"
                               placeholder="{{ __('Crea una contraseña') }}">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password"
                               placeholder="{{ __('Confirma tu contraseña') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus"></i> {{ __('Registrate') }}
                </button>

                <div class="login-footer">
                    {{ __('¿Ya tienes una cuenta?') }} <a href="{{ route('login') }}">{{ __('Inicia sesión') }}</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(135deg, #00573F 0%, #007A5E 100%);
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: #00573F;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-row .form-group {
            padding-right: 15px;
            padding-left: 15px;
            flex: 1;
            min-width: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        .required-field {
            color: #dc3545;
        }

        .form-control {
            height: 45px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding-left: 15px;
            transition: all 0.3s;
            width: 100%;
        }

        .form-control:focus {
            border-color: #00573F;
            box-shadow: 0 0 0 0.2rem rgba(0, 87, 63, 0.25);
        }

        select.form-control {
            height: 45px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
        }

        .btn-register {
            background-color: #00573F;
            color: white;
            border: none;
            height: 45px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #003D2C;
            transform: translateY(-2px);
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-footer a {
            color: #00573F;
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-text {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-row .form-group {
                width: 100%;
                padding-right: 0;
                padding-left: 0;
            }

            .register-container {
                padding: 20px;
            }
        }
    </style>
@endsection
