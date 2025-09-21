@extends('layouts.admin')

@section('title', __('messages.edit') . ' ' . __('messages.Banners'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.edit') }} {{ __('messages.Banners') }}</h1>
        <a href="{{ route('banners.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title_en" class="form-label">{{ __('messages.title_en') }}</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                                id="title_en" name="title_en" value="{{ old('title_en', $banner->title_en) }}" required>
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title_ar" class="form-label">{{ __('messages.title_ar') }}</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror"
                                id="title_ar" name="title_ar" value="{{ old('title_ar', $banner->title_ar) }}" required>
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
                            <textarea class="form-control rich-text @error('description_en') is-invalid @enderror" id="description_en"
                                name="description_en" rows="5" required>{{ old('description_en', $banner->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}</label>
                            <textarea class="form-control rich-text @error('description_ar') is-invalid @enderror" id="description_ar"
                                name="description_ar" rows="5" required>{{ old('description_ar', $banner->description_ar) }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
                    @if ($banner->photo)
                        <div class="mb-2">
                            <img src="{{ asset('assets/admin/uploads/' . $banner->photo) }}" alt="Current Photo"
                                class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                        name="photo" accept="image/*">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="in_top" class="form-label">{{ __('messages.in_top') }}</label>
                    <select class="form-control @error('in_top') is-invalid @enderror" id="in_top" name="in_top"
                        required>
                        <option value="1" {{ old('in_top', $banner->in_top) == 1 ? 'selected' : '' }}>
                            {{ __('messages.yes') }}
                        </option>
                        <option value="2" {{ old('in_top', $banner->in_top) == 2 ? 'selected' : '' }}>
                            {{ __('messages.no') }}
                        </option>
                    </select>
                    @error('in_top')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('banners.index') }}" class="btn btn-secondary me-2">
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
