@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
    <div class="breadcrumb-container">
        <a href="{{ route('home') }}">{{ __('front.home') }}</a>
        <span> <i class="fas fa-chevron-left"></i> </span>
        <a href="{{ route('media.center') }}">{{ __('front.media_center') }}</a>
        <span> <i class="fas fa-chevron-left"></i> </span>
        <a href="#" class="active">{{ $advertisement->title }}</a>
    </div>
</div>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <div class="advertisement-detail">
        
        {{-- Advertisement Image --}}
        @if($advertisement->photo_url)
            <div class="advertisement-image" style="width: 100%; height: 400px; overflow: hidden;">
                <img src="{{ $advertisement->photo_url }}" 
                     alt="{{ $advertisement->title }}" 
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        @endif

        {{-- Advertisement Content --}}
        <div class="project-content" style="padding: 40px; min-height: 400px; line-height: 1.8; color: #065f46; text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};">
            
            {{-- Date --}}
            <div class="advertisement-meta" style="margin-bottom: 20px;">
                <span class="start-date" style="color: #6b7280; font-size: 16px; display: inline-flex; align-items: center;">
                    <i class="fas fa-calendar-alt" style="margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;"></i>
                    {{ $advertisement->formatted_date }}
                </span>
            </div>

            {{-- Title --}}
            <h1 style="font-size: 32px; margin-bottom: 30px; color: #065f46; font-weight: bold; line-height: 1.4;">
                {{ $advertisement->title }}
            </h1>

            {{-- Description --}}
            <div class="advertisement-description" style="margin-bottom: 30px; font-size: 18px; line-height: 1.8;">
                {!! nl2br(e($advertisement->description)) !!}
            </div>

        </div>
    </div>
</div>

@endsection