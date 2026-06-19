@extends('layouts.app')

@section('title', 'Cambiar Avatar')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-image"></i> Cambiar Avatar</h5>
            </div>
            <div class="card-body p-5">
                <!-- Avatar actual -->
                <div class="text-center mb-4">
                    <h6 class="text-muted">Avatar Actual</h6>
                    <img src="{{ auth()->user()->avatar_path ? asset('storage/' . auth()->user()->avatar_path) : 'https://via.placeholder.com/150' }}" 
                         alt="Avatar" class="rounded-circle mb-3" width="150" height="150">
                </div>

                <!-- Formulario -->
                <form method="POST" enctype="multipart/form-data" action="{{ route('profile.avatar.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="avatar" class="form-label">Selecciona una nueva imagen</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                               id="avatar" name="avatar" accept="image/*" required>
                        <small class="form-text text-muted">
                            Formatos permitidos: JPG, PNG, GIF (máximo 2MB)
                        </small>
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview -->
                    <div class="mb-4" id="previewContainer" style="display:none;">
                        <h6 class="text-muted">Preview</h6>
                        <img id="previewImage" class="rounded-circle" width="150" height="150" 
                             style="object-fit: cover;">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-upload"></i> Actualizar Avatar
                    </button>
                </form>

                <hr>

                <p class="text-center mb-0">
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('previewImage').src = event.target.result;
            document.getElementById('previewContainer').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection