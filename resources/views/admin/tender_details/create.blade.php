@extends('layouts.admin')

@section('title', __('messages.create') . ' ' . __('messages.TenderDetails'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.create') }} {{ __('messages.TenderDetails') }}</h1>
    <a href="{{ route('tender-details.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tender-details.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="tender_id" class="form-label">{{ __('messages.tender_id') }}</label>
                <select class="form-select @error('tender_id') is-invalid @enderror" id="tender_id" name="tender_id" required>
                    <option value="">Select Tender</option>
                    @foreach($tenders as $tender)
                        <option value="{{ $tender->id }}" {{ old('tender_id') == $tender->id ? 'selected' : '' }}>
                            {{ $tender->title_en }} - {{ $tender->title_ar }}
                        </option>
                    @endforeach
                </select>
                @error('tender_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="video" class="form-label">{{ __('messages.video') }}</label>
                <input type="url" class="form-control @error('video') is-invalid @enderror" 
                       id="video" name="video" value="{{ old('video') }}" 
                       placeholder="https://youtube.com/watch?v=..." required>
                @error('video')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
            
            <div class="mb-3">
                <label for="condition" class="form-label">{{ __('messages.condition') }}</label>
                <textarea class="form-control rich-text @error('condition') is-invalid @enderror" 
                          id="condition" name="condition" rows="4" required>{{ old('condition') }}</textarea>
                @error('condition')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="required_file" class="form-label">{{ __('messages.required_file') }}</label>
                <textarea class="form-control rich-text @error('required_file') is-invalid @enderror" 
                          id="required_file" name="required_file" rows="4" required>{{ old('required_file') }}</textarea>
                @error('required_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('tender-details.index') }}" class="btn btn-secondary me-2">
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