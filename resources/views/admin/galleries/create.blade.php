@extends('layouts.admin')

@section('title', __('messages.create') . ' ' . __('messages.Galleries'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.create') }} {{ __('messages.Galleries') }}</h1>
    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('messages.photos') }} (Multiple)</label>
                <input type="file" class="form-control @error('photo.*') is-invalid @enderror" 
                       id="photo" name="photo[]" accept="image/*" multiple required>
                @error('photo.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">You can select multiple images</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">{{ __('messages.videos') }} (URLs)</label>
                <div id="video-container">
                    <div class="input-group mb-2">
                        <input type="url" class="form-control @error('video.*') is-invalid @enderror" 
                               name="video[]" placeholder="https://youtube.com/watch?v=..." required>
                        <button type="button" class="btn btn-outline-secondary" onclick="addVideoField()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                @error('video.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Enter video URLs (YouTube, Vimeo, etc.)</small>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary me-2">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('messages.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addVideoField() {
    const container = document.getElementById('video-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="url" class="form-control" name="video[]" placeholder="https://youtube.com/watch?v=..." required>
        <button type="button" class="btn btn-outline-danger" onclick="removeVideoField(this)">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeVideoField(button) {
    button.parentElement.remove();
}
</script>
@endsection