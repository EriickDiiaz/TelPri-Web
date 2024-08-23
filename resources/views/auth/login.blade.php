@extends('layout/auth')

@section('title','TelPri-Web | Inicio de Sesión')
@section('contenido')
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-3 justify-content-center">
                <img src="{{ asset('imagenes/Logo_TelPriWeb_Wh.png') }}" alt="Logo TelPri" style="width: 40%;" class="py-3 ">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-2">
                    <i class="fa-regular fa-user"></i>
                    <label for="email" class="col-md-4 col-form-label">{{ __('Usuario:') }}</label>
                    <div class="col-md-6">
                        
                        <input type="text" class="form-control" name="extension" id="extension" value="{{ old('extension') }}" required>
                    </div>
                </div>
                <div class="row mb-3"> 
                    

                    <div class="col-md-6">
                        
                    </div>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-lock"></i>
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña:') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recuérdame') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
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
</div>
@endsection
