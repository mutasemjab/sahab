@extends('layouts.admin')
@section('title', __('messages.create') . ' ' . __('messages.Services'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.create') }} {{ __('messages.Services') }}</h1>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_en" class="form-label">{{ __('messages.title_en') }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                               id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">{{ __('messages.title_ar') }}</label>
                        <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                               id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                        @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description_en" class="form-label">{{ __('messages.description_en') }}</label>
                        <textarea class="form-control rich-text @error('description_en') is-invalid @enderror" 
                                  id="description_en" name="description_en" rows="5" required>{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
                        <textarea class="form-control rich-text @error('description_ar') is-invalid @enderror" 
                                  id="description_ar" name="description_ar" rows="5" required>{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="icon" class="form-label">{{ __('messages.icon') }}</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                               id="icon" name="icon" value="{{ old('icon') }}" 
                               placeholder="fas fa-cog" required>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Enter FontAwesome icon class (e.g., fas fa-cog)</small>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pdf" class="form-label">{{ __('messages.pdf') }}</label>
                        <input type="file" class="form-control @error('pdf') is-invalid @enderror" 
                               id="pdf" name="pdf" accept=".pdf" required>
                        @error('pdf')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="target_audience" class="form-label">{{ __('messages.target_audience') }}</label>
                        <input type="text" class="form-control @error('target_audience') is-invalid @enderror" 
                               id="target_audience" name="target_audience" value="{{ old('target_audience') }}" required>
                        @error('target_audience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duration_service" class="form-label">{{ __('messages.duration_service') }}</label>
                        <input type="text" class="form-control @error('duration_service') is-invalid @enderror" 
                               id="duration_service" name="duration_service" value="{{ old('duration_service') }}" required>
                        @error('duration_service')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="service_channel" class="form-label">{{ __('messages.service_channel') }}</label>
                        <input type="text" class="form-control @error('service_channel') is-invalid @enderror" 
                               id="service_channel" name="service_channel" value="{{ old('service_channel') }}" required>
                        @error('service_channel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="service_cost" class="form-label">{{ __('messages.service_cost') }}</label>
                        <input type="text" class="form-control @error('service_cost') is-invalid @enderror" 
                               id="service_cost" name="service_cost" value="{{ old('service_cost') }}" required>
                        @error('service_cost')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('services.index') }}" class="btn btn-secondary me-2">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('messages.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection