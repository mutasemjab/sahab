@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.add_service_details') }} - {{ $service->title_en }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.details.store', $service->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">{{ __('messages.video') }} <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('video') is-invalid @enderror" 
                                           id="video" 
                                           name="video" 
                                           value="{{ old('video') }}" 
                                           placeholder="{{ __('messages.video_placeholder') }}">
                                    @error('video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description_en">{{ __('messages.description_en') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text  @error('description_en') is-invalid @enderror" 
                                              id="description_en" 
                                              name="description_en" 
                                              rows="4" 
                                              placeholder="{{ __('messages.description_en_placeholder') }}">{{ old('description_en') }}</textarea>
                                    @error('description_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description_ar">{{ __('messages.description_ar') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text  @error('description_ar') is-invalid @enderror" 
                                              id="description_ar" 
                                              name="description_ar" 
                                              rows="4" 
                                              placeholder="{{ __('messages.description_ar_placeholder') }}">{{ old('description_ar') }}</textarea>
                                    @error('description_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="steps">{{ __('messages.steps') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text  @error('steps') is-invalid @enderror" 
                                              id="steps" 
                                              name="steps" 
                                              rows="4" 
                                              placeholder="{{ __('messages.steps_placeholder') }}">{{ old('steps') }}</textarea>
                                    @error('steps')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="condition">{{ __('messages.condition') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text  @error('condition') is-invalid @enderror" 
                                              id="condition" 
                                              name="condition" 
                                              rows="4" 
                                              placeholder="{{ __('messages.condition_placeholder') }}">{{ old('condition') }}</textarea>
                                    @error('condition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="required_file">{{ __('messages.required_file') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text  @error('required_file') is-invalid @enderror" 
                                              id="required_file" 
                                              name="required_file" 
                                              rows="3" 
                                              placeholder="{{ __('messages.required_file_placeholder') }}">{{ old('required_file') }}</textarea>
                                    @error('required_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('messages.save') }}
                            </button>
                            <a href="{{ route('services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> {{ __('messages.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection