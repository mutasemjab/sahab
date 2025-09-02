@extends('layouts.admin')

@section('title', __('messages.add_new_initiative'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.add_new_initiative') }}</h3>
                    <a href="{{ route('community-initiatives.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_list') }}
                    </a>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('community-initiatives.store') }}" method="POST">
                    @csrf
                    
                    <div class="card-body">
                        <div class="row">
                            <!-- English Title -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_en" class="form-label">{{ __('messages.title_en') }} <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title_en') is-invalid @enderror" 
                                           id="title_en" 
                                           name="title_en" 
                                           value="{{ old('title_en') }}" 
                                           required>
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Arabic Title -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_ar" class="form-label">{{ __('messages.title_ar') }} <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title_ar') is-invalid @enderror" 
                                           id="title_ar" 
                                           name="title_ar" 
                                           value="{{ old('title_ar') }}" 
                                           required>
                                    @error('title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- English Description -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description_en" class="form-label">{{ __('messages.description_en') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text @error('description_en') is-invalid @enderror" 
                                              id="description_en" name="description_en" rows="5" required>{{ old('description_en') }}</textarea>
                                    @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Arabic Description -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description_ar" class="form-label">{{ __('messages.description_ar') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control rich-text @error('description_ar') is-invalid @enderror" 
                                              id="description_ar" name="description_ar" rows="5" required>{{ old('description_ar') }}</textarea>
                                    @error('description_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Finish Date -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_finish" class="form-label">{{ __('messages.finish_date') }}</label>
                                    <input type="date" 
                                           class="form-control @error('date_finish') is-invalid @enderror" 
                                           id="date_finish" 
                                           name="date_finish" 
                                           value="{{ old('date_finish') }}"
                                           min="{{ date('Y-m-d') }}">
                                    <div class="form-text">{{ __('messages.finish_date_help') }}</div>
                                    @error('date_finish')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Initiative Status Preview -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.initiative_status') }}</label>
                                    <div class="form-control-plaintext">
                                        <span id="status-preview" class="badge bg-success">{{ __('messages.ongoing') }}</span>
                                        <div class="form-text" id="status-description">
                                            {{ __('messages.ongoing_description') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Instructions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle"></i> {{ __('messages.form_instructions') }}:</h6>
                                    <ul class="mb-0">
                                        <li>{{ __('messages.initiative_instruction_1') }}</li>
                                        <li>{{ __('messages.initiative_instruction_2') }}</li>
                                        <li>{{ __('messages.initiative_instruction_3') }}</li>
                                        <li>{{ __('messages.initiative_instruction_4') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('community-initiatives.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> {{ __('messages.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('messages.create_initiative') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection