@extends('layouts.admin')

@section('title', __('messages.edit') . ' ' . __('messages.Projects'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.edit') }} {{ __('messages.Projects') }}</h1>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_en" class="form-label">{{ __('messages.title_en') }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                               id="title_en" name="title_en" value="{{ old('title_en', $project->title_en) }}" required>
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">{{ __('messages.title_ar') }}</label>
                        <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                               id="title_ar" name="title_ar" value="{{ old('title_ar', $project->title_ar) }}" required>
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
                                  id="description_en" name="description_en" rows="5" required>{{ old('description_en', $project->description_en) }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
                        <textarea class="form-control rich-text @error('description_ar') is-invalid @enderror" 
                                  id="description_ar" name="description_ar" rows="5" required>{{ old('description_ar', $project->description_ar) }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">{{ __('messages.type') }}</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="1" {{ old('type', $project->type) == '1' ? 'selected' : '' }}>{{ __('messages.done') }}</option>
                            <option value="2" {{ old('type', $project->type) == '2' ? 'selected' : '' }}>{{ __('messages.on_going') }}</option>
                            <option value="3" {{ old('type', $project->type) == '3' ? 'selected' : '' }}>{{ __('messages.planned') }}</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="time" class="form-label">{{ __('messages.time') }}</label>
                        <input type="text" class="form-control @error('time') is-invalid @enderror" 
                               id="time" name="time" value="{{ old('time', $project->time) }}" 
                               placeholder="e.g., 6 months, Q1 2024">
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
                @if($project->photo)
                    <div class="mb-2">
                        <img src="{{ asset('assets/admin/uploads/' . $project->photo) }}" alt="Current Photo" class="img-thumbnail" style="max-height: 200px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                       id="photo" name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary me-2">
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