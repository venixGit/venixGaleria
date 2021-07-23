@extends('layouts.template-auth')

@section('content-auth')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <h6 class="mb-3">REGISTRARSE</h6>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


    <input id="email" type="email" class="form-control mt-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


    <input id="password" type="password" class="form-control mt-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


    <input id="password-confirm" type="password" class="form-control mt-2" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">


    <button type="submit" class="btn btn-primary mt-2">
        {{ __('Register') }}
    </button>
</form> 
@endsection
