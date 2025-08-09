@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('media.center') }}" class="active">{{ __('front.media_center') }}</a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title">{{ __('front.media_center') }}</h2>
    <p class="mutasem-subtitle">{{ __('front.media_center_subtitle') }}</p>
  </div>
</section>

<section class="news-section">
  <h2 class="section-title">{{ __('front.advertisements') }}</h2>

  <div class="projects-grid">
    @forelse($advertisements as $advertisement)
    <div class="project-card">
      <div class="project-image">
        <img src="{{ $advertisement->photo_url }}" alt="{{ $advertisement->title }}">
        <span class="project-tag">{{ __('front.planned') }}</span>
      </div>
      <div class="project-content">
        <h3>{{ $advertisement->title }}</h3>
        <p>{{ Str::limit($advertisement->description, 100) }}</p>
        <p class="start-date">{{ __('front.starting_from') }}: {{ $advertisement->formatted_date }}</p>
        <a href="{{ route('advertisements.show', $advertisement->id) }}" class="project-link">
          <i class="fas fa-arrow-left"></i> {{ __('front.learn_more') }}
        </a>
      </div>
    </div>
    @empty
    <div class="no-data">
      <p>{{ __('front.no_advertisements') }}</p>
    </div>
    @endforelse
  </div>

  @if($advertisements->count() >= 6)
  <div class="more-btn-wrapper">
    <a href="{{ route('advertisements.index') }}" class="services-btn">{{ __('front.more') }}</a>
  </div>
  @endif
</section>

<section class="projects-section">
  <h2 class="section-title">{{ __('front.latest_news') }}</h2>

  <div class="news-grid">
    @forelse($news as $newsItem)
    <div class="news-card">
      <img src="{{ $newsItem->photo_url }}" alt="{{ $newsItem->title }}">
      <div class="news-content">
        <span class="news-date">{{ $newsItem->formatted_date }}</span>
        <h3>{{ $newsItem->title }}</h3>
        <p>{{ $newsItem->excerpt }}</p>
        <a href="{{ route('news.show', $newsItem->id) }}" class="news-link">
          <i class="fas fa-arrow-left"></i> {{ __('front.read_more') }}
        </a>
      </div>
    </div>
    @empty
    <div class="no-data">
      <p>{{ __('front.no_news') }}</p>
    </div>
    @endforelse
  </div>

  @if($news->count() >= 6)
  <div class="more-btn-wrapper">
    <a href="{{ route('news.index') }}" class="services-btn">{{ __('front.more') }}</a>
  </div>
  @endif
</section>

@if($gallery && $gallery->photo_urls)
<!-- معرض الصور -->
<section class="mutasem-gallery-section">
  <div class="mutasem-container">
    <h2 class="mutasem-gallery-title">{{ __('front.photo_gallery') }}</h2>
    <div class="mutasem-gallery-grid">
      @foreach(array_slice($gallery->photo_urls, 0, 8) as $photo)
      <img src="{{ $photo }}" alt="{{ __('front.gallery_image') }}" class="mutasem-gallery-img">
      @endforeach
    </div>
  </div>
</section>
@endif

@if($gallery && $gallery->video_data)
<!-- معرض الفيديو -->
<section class="mutasem-gallery-section video">
  <div class="mutasem-container">
    <h2 class="mutasem-gallery-title">{{ __('front.video_gallery') }}</h2>
    <div class="mutasem-gallery-grid">
      @foreach(array_slice($gallery->video_data, 0, 6) as $video)
      <!-- بطاقة فيديو -->
      <div class="mutasem-video-card">
        <div class="mutasem-video-thumbnail">
          <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}">
          <span class="mutasem-play-icon">▶</span>
        </div>
        <div class="mutasem-video-info">
          <h4>{{ $video['title'] }}</h4>
          <p>{{ $video['date'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<section class="mutasem-social-section">
  <h2 class="mutasem-gallery-title">{{ __('front.social_media_updates') }}</h2>
  <div class="mutasem-container mutasem-social-grid">
    <!-- تويتر -->
    <div class="mutasem-social-card">
      <div class="mutasem-social-header">
        <span>{{ __('front.twitter_feed') }}</span>
        <svg width="20" height="20" fill="#1DA1F2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.4.36a9.1 9.1 0 0 1-2.86 1.09A4.52 4.52 0 0 0 16.11 0c-2.5 0-4.52 2.01-4.52 4.49 0 .35.04.7.11 1.03A12.87 12.87 0 0 1 3.13.67a4.5 4.5 0 0 0-.61 2.26c0 1.56.8 2.94 2.02 3.75A4.49 4.49 0 0 1 2 6.58v.06c0 2.19 1.56 4.02 3.63 4.44a4.52 4.52 0 0 1-2.03.08 4.52 4.52 0 0 0 4.22 3.13A9.06 9.06 0 0 1 0 19.54a12.78 12.78 0 0 0 6.95 2.03c8.34 0 12.9-6.9 12.9-12.89 0-.2 0-.4-.01-.6A9.1 9.1 0 0 0 23 3z"/>
        </svg>
      </div>
      <div class="mutasem-facebook-posts">
        <p>{{ __('front.sample_social_post') }} #{{ __('front.sahab_municipality') }}<br><span>{{ __('front.two_hours_ago') }}</span></p>
        <p>{{ __('front.sample_social_post') }} #{{ __('front.sahab_municipality') }}<br><span>{{ __('front.two_hours_ago') }}</span></p>
        <p>{{ __('front.sample_social_post') }} #{{ __('front.sahab_municipality') }}<br><span>{{ __('front.two_hours_ago') }}</span></p>
      </div>
    </div>

    <!-- فيسبوك -->
    <div class="mutasem-social-card">
      <div class="mutasem-social-header">
        <span>{{ __('front.facebook_updates') }}</span>
        <svg width="20" height="20" fill="#1877F2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898v-2.891h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
        </svg>
      </div>
      <div class="mutasem-facebook-posts">
        <p>{{ __('front.sample_social_post') }} #{{ __('front.sahab_municipality') }}<br><span>{{ __('front.two_hours_ago') }}</span></p>
        <p>{{ __('front.sample_social_post') }} #{{ __('front.sahab_municipality') }}<br><span>{{ __('front.two_hours_ago') }}</span></p>
        <p>{{ __('front.sample_social_post') }} #{{ __('front.sahab_municipality') }}<br><span>{{ __('front.two_hours_ago') }}</span></p>
      </div>
    </div>

    <!-- إنستغرام -->
    <div class="mutasem-social-card">
      <div class="mutasem-social-header">
        <span>{{ __('front.instagram_feed') }}</span>
        <svg width="20" height="20" fill="#d62976" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm10.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
        </svg>
      </div>
      <div class="mutasem-instagram-grid">
        @for($i = 0; $i < 4; $i++)
        <img src="{{ asset('assets/Images/about.png') }}" alt="{{ __('front.instagram_post') }}">
        @endfor
      </div>
    </div>
  </div>
</section>

@endsection