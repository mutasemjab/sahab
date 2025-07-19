@extends('layouts.admin')

@section('title', __('messages.create') . ' ' . __('messages.Questions'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.create') }} {{ __('messages.Questions') }}</h1>
    <a href="{{ route('questions.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="question_en" class="form-label">{{ __('messages.question_en') }}</label>
                        <input type="text" class="form-control @error('question_en') is-invalid @enderror" 
                               id="question_en" name="question_en" value="{{ old('question_en') }}" required>
                        @error('question_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="question_ar" class="form-label">{{ __('messages.question_ar') }}</label>
                        <input type="text" class="form-control @error('question_ar') is-invalid @enderror" 
                               id="question_ar" name="question_ar" value="{{ old('question_ar') }}" required>
                        @error('question_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="answer_en" class="form-label">{{ __('messages.answer_en') }}</label>
                        <textarea class="form-control rich-text @error('answer_en') is-invalid @enderror" 
                                  id="answer_en" name="answer_en" rows="5" required>{{ old('answer_en') }}</textarea>
                        @error('answer_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="answer_ar" class="form-label">{{ __('messages.answer_ar') }}</label>
                        <textarea class="form-control rich-text @error('answer_ar') is-invalid @enderror" 
                                  id="answer_ar" name="answer_ar" rows="5" required>{{ old('answer_ar') }}</textarea>
                        @error('answer_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('questions.index') }}" class="btn btn-secondary me-2">
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