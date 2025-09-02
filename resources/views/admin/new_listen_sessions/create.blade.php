@extends('layouts.admin')

@section('title', __('messages.add_new_session'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('messages.add_new_session') }}</h4>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('new-listen-sessions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                   id="photo" name="photo" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title_en" class="form-label">{{ __('messages.youtube_link') }}</label>
                            <input type="text" class="form-control @error('youtube_link') is-invalid @enderror" 
                                   id="youtube_link" name="youtube_link" value="{{ old('youtube_link') }}" required>
                            @error('youtube_link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                     
                        <div class="mb-3">
                            <label for="title_en" class="form-label">{{ __('messages.title_english') }}</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                   id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                            @error('title_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title_ar" class="form-label">{{ __('messages.title_arabic') }}</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                   id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required dir="rtl">
                            @error('title_ar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description_en" class="form-label">{{ __('messages.description_english') }}</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="4" required>{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description_ar" class="form-label">{{ __('messages.description_arabic') }}</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                      id="description_ar" name="description_ar" rows="4" required dir="rtl">{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('new-listen-sessions.index') }}" class="btn btn-secondary">
                                {{ __('messages.back') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                {{ __('messages.create_session') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection