@extends('layouts.admin')

@section('title', __('messages.edit_initiative'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.edit_initiative') }}: {{ $communityInitiative->title_en }}</h3>
                    <div class="btn-group">
                    
                        <a href="{{ route('community-initiatives.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_list') }}
                        </a>
                    </div>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('community-initiatives.update', $communityInitiative) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
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
                                           value="{{ old('title_en') ?? $communityInitiative->title_en }}" 
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
                                           value="{{ old('title_ar') ?? $communityInitiative->title_ar }}" 
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
                                              id="description_en" name="description_en" rows="5" required>{{ old('description_en') ?? $communityInitiative->description_en }}</textarea>
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
                                              id="description_ar" name="description_ar" rows="5" required>{{ old('description_ar') ?? $communityInitiative->description_ar }}</textarea>
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
                                           value="{{ old('date_finish') ?? ($communityInitiative->date_finish ? $communityInitiative->date_finish->format('Y-m-d') : '') }}"
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
                                        <span id="status-preview" class="badge bg-{{ $communityInitiative->status['class'] }}">{{ $communityInitiative->status['label'] }}</span>
                                        <div class="form-text" id="status-description">
                                            @if($communityInitiative->status['key'] === 'ongoing')
                                                {{ __('messages.ongoing_description') }}
                                            @elseif($communityInitiative->status['key'] === 'active')
                                                {{ __('messages.active_description') }}
                                            @else
                                                {{ __('messages.completed_description') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Initiative Information -->
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-secondary">
                                    <h6><i class="fas fa-info-circle"></i> {{ __('messages.initiative_information') }}:</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-1"><strong>{{ __('messages.created_at') }}:</strong> {{ $communityInitiative->created_at->format('Y-m-d H:i:s') }}</p>
                                            <p class="mb-0"><strong>{{ __('messages.updated_at') }}:</strong> {{ $communityInitiative->updated_at->format('Y-m-d H:i:s') }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1"><strong>{{ __('messages.current_status') }}:</strong> 
                                                <span class="badge bg-{{ $communityInitiative->status['class'] }}">
                                                    {{ $communityInitiative->status['label'] }}
                                                </span>
                                            </p>
                                            @if($communityInitiative->days_remaining !== null)
                                                <p class="mb-0"><strong>{{ __('messages.days_remaining') }}:</strong> 
                                                    @if($communityInitiative->days_remaining > 0)
                                                        {{ $communityInitiative->days_remaining }} {{ __('messages.days') }}
                                                    @else
                                                        {{ __('messages.completed') }}
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($communityInitiative->date_finish)
                                                <p class="mb-0"><strong>{{ __('messages.current_finish_date') }}:</strong> {{ $communityInitiative->formatted_finish_date }}</p>
                                            @else
                                                <p class="mb-0"><strong>{{ __('messages.current_finish_date') }}:</strong> {{ __('messages.no_end_date') }}</p>
                                            @endif
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
                                <i class="fas fa-save"></i> {{ __('messages.update_initiative') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection