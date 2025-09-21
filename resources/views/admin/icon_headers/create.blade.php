@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('messages.create_icon_header') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('icon_headers.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="icon" class="form-label">{{ __('messages.icon') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-icons"></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" 
                                       name="icon" 
                                       value="{{ old('icon') }}"
                                       placeholder="{{ __('messages.icon_placeholder') }}"
                                       required>
                                <div class="input-group-text" id="icon-preview">
                                    <i id="preview-icon" class="fas fa-question"></i>
                                </div>
                            </div>
                            <div class="form-text">
                                {{ __('messages.icon_help') }}
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">{{ __('messages.link') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-link"></i>
                                </span>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link') }}"
                                       placeholder="{{ __('messages.link_placeholder') }}"
                                       required>
                            </div>
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('icon_headers.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> {{ __('messages.create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('icon');
    const previewIcon = document.getElementById('preview-icon');
    
    iconInput.addEventListener('input', function() {
        const iconClass = this.value.trim();
        if (iconClass) {
            previewIcon.className = iconClass;
        } else {
            previewIcon.className = 'fas fa-question';
        }
    });
});
</script>
@endsection