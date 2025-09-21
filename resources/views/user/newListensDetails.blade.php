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
    <div class="listen-session-detail">
        

        {{-- Session Content --}}
        <div class="project-content">
            
            {{-- Title --}}
            <h1>
                {{ $newListen->title }}
            </h1>

            {{-- Description --}}
            <div class="session-description">
                {!! nl2br(e($newListen->description)) !!}
            </div>

            {{-- YouTube Video Section --}}
            @if($newListen->youtube_link)
                <div class="youtube-video-section">
                    <h3>{{ __('front.watch_session') }}</h3>
                    
                    <div class="video-container">
                        @php
                            // Extract YouTube video ID from various YouTube URL formats
                            $videoId = null;
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $newListen->youtube_link, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp
                        
                        @if($videoId)
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&showinfo=0&modestbranding=1" 
                                title="{{ $newListen->title }}"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        @else
                            {{-- Fallback if video ID extraction fails --}}
                            <div class="video-fallback">
                                <div>
                                    <i class="fab fa-youtube"></i>
                                    <p>{{ __('front.video_not_available') }}</p>
                                    <a href="{{ $newListen->youtube_link }}" target="_blank">
                                        {{ __('front.watch_on_youtube') }}
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Direct YouTube Link --}}
                    <div class="youtube-direct">
                        <a href="{{ $newListen->youtube_link }}" target="_blank">
                            <i class="fab fa-youtube"></i>
                            {{ __('front.watch_on_youtube') }}
                        </a>
                    </div>
                </div>
            @endif

            {{-- Back Button --}}
            <div class="back-button">
                <a href="{{ route('newListen.index') }}" class="services-btn">
                    <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}"></i>
                    {{ __('front.back_to_listen_sessions') }}
                </a>
            </div>
        </div>
        {{-- Session Image --}}
        @if($newListen->photo_url)
            <div class="session-image">
                <img src="{{ $newListen->photo_url }}" 
                     alt="{{ $newListen->title }}">
            </div>
        @endif

    </div>
</div>

{{-- Additional CSS --}}
<style>
.listen-session-detail {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 40px;
    align-items: start;
}

.session-image {
    width: 100%;
    height: 400px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.session-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.project-content {
    padding: 20px;
    min-height: 400px;
    line-height: 1.8;
    color: #065f46;
    text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
}

.project-content h1 {
    font-size: 32px;
    margin-bottom: 30px;
    color: #065f46;
    font-weight: bold;
    line-height: 1.4;
}

.project-content a {
    color: #ffffff !important;
    font-weight: bold;
    text-decoration: none;
}



.session-description {
    margin-bottom: 30px;
    font-size: 18px;
    line-height: 1.8;
}

/* Video */
.youtube-video-section {
    margin: 40px 0;
}
.youtube-video-section h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #065f46;
}
.video-container {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    margin-bottom: 20px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.video-container iframe {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
}
.video-fallback {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f3f4f6;
    color: #6b7280;
    text-align: center;
}
.video-fallback i {
    font-size: 48px;
    color: #ef4444;
    margin-bottom: 10px;
}
.youtube-direct {
    text-align: center;
    margin-top: 15px;
}
.youtube-direct a {
    display: inline-flex;
    align-items: center;
    background: #ef4444;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.youtube-direct a i {
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;
    font-size: 18px;
}
.youtube-direct a:hover {
    background: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

/* Back button */
.back-button {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #e5e7eb;
}
.services-btn {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    background: #065f46;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}
.services-btn i {
    margin-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 8px;
}
.services-btn:hover {
    background: #047857;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(6, 95, 70, 0.3);
}

/* Responsive */
@media (max-width: 992px) {
    .listen-session-detail {
        grid-template-columns: 1fr;
    }
    .session-image {
        height: 250px;
    }
    .project-content h1 {
        font-size: 24px;
    }
}
</style>

@endsection
