@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.edit_service_details') }} - {{ $service->title_en }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('services.details', $service->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.details.update', [$service->id, $serviceDetail->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">{{ __('messages.video') }} <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('video') is-invalid @enderror" 
                                           id="video" 
                                           name="video" 
                                           value="{{ old('video', $serviceDetail->video) }}" 
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
                                              placeholder="{{ __('messages.description_en_placeholder') }}">{{ old('description_en', $serviceDetail->description_en) }}</textarea>
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
                                              placeholder="{{ __('messages.description_ar_placeholder') }}">{{ old('description_ar', $serviceDetail->description_ar) }}</textarea>
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
                                              placeholder="{{ __('messages.steps_placeholder') }}">{{ old('steps', $serviceDetail->steps) }}</textarea>
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
                                              placeholder="{{ __('messages.condition_placeholder') }}">{{ old('condition', $serviceDetail->condition) }}</textarea>
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
                                    <textarea class="form-control @error('required_file') is-invalid @enderror" 
                                              id="required_file" 
                                              name="required_file" 
                                              rows="3" 
                                              placeholder="{{ __('messages.required_file_placeholder') }}">{{ old('required_file', $serviceDetail->required_file) }}</textarea>
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
                                <i class="fas fa-save"></i> {{ __('messages.update') }}
                            </button>
                            <a href="{{ route('services.details', $service->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> {{ __('messages.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Current Details Info Card -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('messages.current_detail_information') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>{{ __('messages.created_at') }}:</strong> {{ date('Y-m-d H:i', strtotime($serviceDetail->created_at)) }}</p>
                        <p><strong>{{ __('messages.updated_at') }}:</strong> {{ date('Y-m-d H:i', strtotime($serviceDetail->updated_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Auto-resize textareas
    $('textarea').each(function() {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
</script>
@endsection