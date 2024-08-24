@extends('layout/auth')

@section('title','TelPri-Web | Inicio de Sesión')
@section('contenido')
<div class="container my-3 d-flex align-items-center justify-content-center" >
    <div class="col-md-6">
        <div class="row mb-4 justify-content-center">
            <img src="{{ asset('imagenes/Logo_TelPriWeb_Wh.png') }}" alt="Logo TelPri" style="width: 40%;" class="py-3">
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="col-form-label">{{ __('Usuario:') }}</label>
                <div class="input-group">
                    <div class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="col-form-label">{{ __('Contraseña:') }}</label>
                <div class="input-group">
                    <div class="input-group-text">
                        <i class="fa-solid fa-lock-open"></i>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Recuérdame') }}
                </label>
            </div>

            <div class="row mb-0 justify-content-center">
                <div class="col-md-8 text-center">
                    <button type="submit" class="btn btn-outline-primary">
                        {{ __('Iniciar sesión') }}
                    </button>
            
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection

