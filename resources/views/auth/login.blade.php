@extends('layouts.template-auth')

@section('content-auth')

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h6 class="mb-3">LOGIN</h6>
         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Usuario">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        <input id="password" type="password" class="form-control mt-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        <div class="form-check text-left mt-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
        <div class="d-flex justify-content-between">
           {{--  <a class="btn btn-link m-auto text-xl-left" href="#">¿Olvidó su contraseña?</a> --}}
           @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
            @endif
             <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
            </button>    

        <!-- <button class="btn btn-info m-4 mx-auto">Iniciar Sesión</button> -->
        <!-- El siguiente 'a' es temporal, debe usarse el boton comentado de arriba -->
        </div>
        <div class="my-4 text-secondary">
            @if (Route::has('password.request'))
                ¿Aun no posee una cuenta?
                    <a class="btn btn-link" href="{{ route('register') }}">
                        <b>Registrarse</b>
                    </a>
            @endif
        </div>
    </form> 
@endsection
