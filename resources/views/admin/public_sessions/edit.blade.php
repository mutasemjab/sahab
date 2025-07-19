@extends('layouts.admin')
@section('title', __('messages.edit') . ' ' . __('messages.PublicSessions'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.edit') }} {{ __('messages.PublicSessions') }}</h1>
    <a href="{{ route('public-sessions.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('public-sessions.update', $publicSession->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_of_event" class="form-label">{{ __('messages.date_of_event') }}</label>
                        <input type="date" class="form-control @error('date_of_event') is-invalid @enderror" 
                               id="date_of_event" name="date_of_event" value="{{ old('date_of_event', $publicSession->date_of_event) }}" required>
                        @error('date_of_event')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="time" class="form-label">{{ __('messages.time') }}</label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror" 
                               id="time" name="time" value="{{ old('time', $publicSession->time) }}">
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_en" class="form-label">{{ __('messages.title_en') }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                               id="title_en" name="title_en" value="{{ old('title_en', $publicSession->title_en) }}" required>
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">{{ __('messages.title_ar') }}</label>
                        <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                               id="title_ar" name="title_ar" value="{{ old('title_ar', $publicSession->title_ar) }}" required>
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
                                  id="description_en" name="description_en" rows="5" required>{{ old('description_en', $publicSession->description_en) }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
                        <textarea class="form-control rich-text @error('description_ar') is-invalid @enderror" 
                                  id="description_ar" name="description_ar" rows="5" required>{{ old('description_ar', $publicSession->description_ar) }}</textarea>
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
                            <option value="1" {{ old('type', $publicSession->type) == '1' ? 'selected' : '' }}>{{ __('messages.open') }}</option>
                            <option value="2" {{ old('type', $publicSession->type) == '2' ? 'selected' : '' }}>{{ __('messages.soon') }}</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="video" class="form-label">{{ __('messages.video') }}</label>
                        <input type="url" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" value="{{ old('video', $publicSession->video) }}" 
                               placeholder="https://youtube.com/watch?v=...">
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="what_expect" class="form-label">{{ __('messages.what_expect') }}</label>
                <textarea class="form-control rich-text @error('what_expect') is-invalid @enderror" 
                          id="what_expect" name="what_expect" rows="4">{{ old('what_expect', $publicSession->what_expect) }}</textarea>
                @error('what_expect')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('public-sessions.index') }}" class="btn btn-secondary me-2">
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