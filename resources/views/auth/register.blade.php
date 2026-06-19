@extends('layouts.guest')

@section('title', 'Registro')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-body p-5">
                <h2 class="text-center mb-4">
                    <i class="fas fa-user-plus text-primary"></i> Crear Cuenta
                </h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nickname" class="form-label">Apodo (Usuario)</label>
                        <input type="text" class="form-control @error('nickname') is-invalid @enderror" 
                               id="nickname" name="nickname" value="{{ old('nickname') }}" 
                               placeholder="usuario123" required>
                        @error('nickname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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
                        <small class="form-text text-muted">Debe contener mayúsculas, minúsculas y números</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-user-check"></i> Registrarse
                    </button>
                </form>

                <hr>

                <p class="text-center mb-0">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary fw-bold">Inicia sesión aquí</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection