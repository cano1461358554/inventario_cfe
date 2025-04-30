@extends('layouts.app')

@section('content')
    <div class="auth-page">
        <div class="login-container">
            <div class="login-header">
                <h2>{{ __('Login') }}</h2>
                <p>{{ __('Ingresa tus credenciales para acceder al sistema') }}</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="RP">{{ __('Número de RP') }}</label>
                    <input id="RP" type="text" class="form-control @error('RP') is-invalid @enderror"
                           name="RP" value="{{ old('RP') }}" required autocomplete="RP" autofocus
                           placeholder="{{ __('Ingresa tu número de RP') }}">
                    @error('RP')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password"
                           placeholder="{{ __('Ingresa tu contraseña') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('Recuérdame') }}</label>
                    </div>
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> {{ __('Iniciar sesión') }}
                </button>

                @if (Route::has('register'))
                    <div class="login-footer">
                        {{ __('¿No tienes una cuenta?') }} <a href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(135deg, #00573F 0%, #007A5E 100%);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #00573F;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
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

        .btn-login {
            background-color: #00573F;
            color: white;
            border: none;
            height: 45px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #003D2C;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .forgot-password a {
            color: #00573F;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
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
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
@endsection
