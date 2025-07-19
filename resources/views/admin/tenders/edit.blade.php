@extends('layouts.admin')

@section('title', __('messages.edit') . ' ' . __('messages.Tenders'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.edit') }} {{ __('messages.Tenders') }}</h1>
    <a href="{{ route('tenders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tenders.update', $tender->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="number" class="form-label">{{ __('messages.number') }}</label>
                        <input type="number" class="form-control @error('number') is-invalid @enderror" 
                               id="number" name="number" value="{{ old('number', $tender->number) }}" required>
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cost" class="form-label">{{ __('messages.cost') }}</label>
                        <input type="text" class="form-control @error('cost') is-invalid @enderror" 
                               id="cost" name="cost" value="{{ old('cost', $tender->cost) }}" required>
                        @error('cost')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                            <label>{{ __('messages.title_en') }}</label>
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
                        <label for="date_publish" class="form-label">{{ __('messages.date_publish') }}</label>
                        <input type="text" class="form-control @error('date_publish') is-invalid @enderror" 
                               id="date_publish" name="date_publish" value="{{ old('date_publish') }}" required>
                        @error('date_publish')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_close" class="form-label">{{ __('messages.date_close') }}</label>
                        <input type="text" class="form-control @error('date_close') is-invalid @enderror" 
                               id="date_close" name="date_close" value="{{ old('date_close') }}" required>
                        @error('date_close')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="photo" class="form-label">{{ __('messages.photo') }} (Optional)</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
            
            <div class="mb-3">
                <label for="pdf_file" class="form-label">{{ __('messages.pdf_file') }} (Multiple)</label>
                <input type="file" class="form-control @error('pdf_file.*') is-invalid @enderror" 
                       id="pdf_file" name="pdf_file[]" accept=".pdf" multiple required>
                @error('pdf_file.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">You can select multiple PDF files</small>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('tenders.index') }}" class="btn btn-secondary me-2">
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