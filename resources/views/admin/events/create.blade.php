@extends('layouts.admin')
@section('title', __('messages.create') . ' ' . __('messages.Events'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.create') }} {{ __('messages.Events') }}</h1>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="date_of_event" class="form-label">{{ __('messages.date_of_event') }}</label>
                <input type="date" class="form-control @error('date_of_event') is-invalid @enderror" 
                       id="date_of_event" name="date_of_event" value="{{ old('date_of_event') }}" required>
                @error('date_of_event')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
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
            
            <div class="mb-3">
                <label for="link_google_meet" class="form-label">{{ __('messages.link_google_meet') }}</label>
                <input type="url" class="form-control @error('link_google_meet') is-invalid @enderror" 
                       id="link_google_meet" name="link_google_meet" value="{{ old('link_google_meet') }}" 
                       placeholder="https://meet.google.com/..." required>
                @error('link_google_meet')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('events.index') }}" class="btn btn-secondary me-2">
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