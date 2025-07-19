@extends('layouts.admin')

@section('title', __('messages.edit') . ' ' . __('messages.About'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.edit') }} {{ __('messages.About') }}</h1>
    <a href="{{ route('abouts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('complete_abouts.update', $completeAbout->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_en" class="form-label">{{ __('messages.title_en') }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                               id="title_en" name="title_en" value="{{ old('title_en', $completeAbout->title_en) }}" required>
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">{{ __('messages.title_ar') }}</label>
                        <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                               id="title_ar" name="title_ar" value="{{ old('title_ar', $completeAbout->title_ar) }}" required>
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
                                  id="description_en" name="description_en" rows="8" required>{{ old('description_en', $completeAbout->description_en) }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
                        <textarea class="form-control rich-text @error('description_ar') is-invalid @enderror" 
                                  id="description_ar" name="description_ar" rows="8" required>{{ old('description_ar', $completeAbout->description_ar) }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="icon" class="form-label">{{ __('messages.icon') }}</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                               id="icon" name="icon" value="{{ old('icon', $completeAbout->icon) }}" 
                               placeholder="fas fa-cog" required>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Enter FontAwesome icon class (e.g., fas fa-cog)</small>
                    </div>
                </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('complete_abouts.index') }}" class="btn btn-secondary me-2">
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