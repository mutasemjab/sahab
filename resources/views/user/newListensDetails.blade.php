@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('newListen.index') }}">{{ __('front.listen_sessions') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ $newListen->title }}</a>
  </div>
</div>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <div class="listen-session-detail" >
        
        {{-- Session Image --}}
        @if($newListen->photo_url)
            <div class="session-image" style="width: 100%; height: 400px; overflow: hidden;">
                <img src="{{ $newListen->photo_url }}" 
                     alt="{{ $newListen->title }}" 
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        @endif

        {{-- Session Content --}}
        <div class="project-content" style="padding: 40px; min-height: 400px; line-height: 1.8; color: #065f46; text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};">
            
            {{-- Title --}}
            <h1 style="font-size: 32px; margin-bottom: 30px; color: #065f46; font-weight: bold; line-height: 1.4;">
                {{ $newListen->title }}
            </h1>

            {{-- Description --}}
            <div class="session-description" style="margin-bottom: 30px; font-size: 18px; line-height: 1.8;">
                {!! nl2br(e($newListen->description)) !!}
            </div>

            {{-- YouTube Video Section --}}
            @if($newListen->youtube_link)
                <div class="youtube-video-section" style="margin: 40px 0;">
                    <h3 style="font-size: 24px; margin-bottom: 20px; color: #065f46;">
                        {{ __('front.watch_session') }}
                    </h3>
                    
                    <div class="video-container" style="position: relative; width: 100%; height: 0; padding-bottom: 56.25%; /* 16:9 aspect ratio */ margin-bottom: 20px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                        @php
                            // Extract YouTube video ID from various YouTube URL formats
                            $videoId = null;
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $newListen->youtube_link, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp
                        
                        @if($videoId)
                            <iframe 
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" 
                                src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&showinfo=0&modestbranding=1" 
                                title="{{ $newListen->title }}"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        @else
                            {{-- Fallback if video ID extraction fails --}}
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f3f4f6; color: #6b7280;">
                                <div style="text-align: center;">
                                    <i class="fab fa-youtube" style="font-size: 48px; color: #ef4444; margin-bottom: 10px;"></i>
                                    <p>{{ __('front.video_not_available') }}</p>
                                    <a href="{{ $newListen->youtube_link }}" target="_blank" style="color: #065f46; text-decoration: none; font-weight: bold;">
                                        {{ __('front.watch_on_youtube') }}
                                        <i class="fas fa-external-link-alt" style="margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 5px;"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Direct YouTube Link --}}
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="{{ $newListen->youtube_link }}" 
                           target="_blank" 
                           style="display: inline-flex; align-items: center; background: #ef4444; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 16px; font-weight: 500; transition: all 0.3s ease;">
                            <i class="fab fa-youtube" style="margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px; font-size: 18px;"></i>
                            {{ __('front.watch_on_youtube') }}
                        </a>
                    </div>
                </div>
            @endif

            {{-- Back Button --}}
            <div class="back-button" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #e5e7eb;">
                <a href="{{ route('newListen.index') }}" 
                   class="services-btn" 
                   style="display: inline-flex; align-items: center; text-decoration: none; background: #065f46; color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; transition: all 0.3s ease;">
                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" 
                       style="margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;"></i>
                    {{ __('front.back_to_listen_sessions') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Additional CSS for responsive video --}}
<style>
@media (max-width: 768px) {
    .project-content {
        padding: 20px !important;
        width: 100% !important;
    }
    
    .video-container {
        border-radius: 8px !important;
    }
    
    .project-content h1 {
        font-size: 24px !important;
    }
}

/* Hover effect for YouTube button */
.project-content a[href*="youtube"]:hover {
    background: #dc2626 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

/* Back button hover effect */
.services-btn:hover {
    background: #047857 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(6, 95, 70, 0.3);
}
</style>

@endsection