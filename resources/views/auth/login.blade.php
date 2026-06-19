@extends('layouts.guest')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-body p-5">
                <h2 class="text-center mb-4">
                    <i class="fas fa-sign-in-alt text-primary"></i> Iniciar Sesión
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña (8-12 caracteres)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-key"></i> Ingresar
                    </button>
                </form>

                <hr>

                <p class="text-center mb-0">
                    ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-primary fw-bold">Registrate aquí</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection