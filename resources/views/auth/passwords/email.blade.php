@extends('layouts.template-auth')

@section('content-auth')
        @if (session('status'))
            <div class="alert alert-success" role="alert">
            {{ session('status') }}
            </div>
        @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <p class="mt-2 mb-0 pb-0 d-flex justify-content-between">¿Olvidó su contraseña? No hay problema, simplemente dejenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer una contraseña nueva.</p>
        <!--INPUT DEL EMAIL-->
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        <button type="submit" class="btn btn-info m-4 mx-auto">
            {{ __('Send Password Reset Link') }}
        </button>
    </form> 
@endsection


