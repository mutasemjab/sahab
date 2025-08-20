@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('newListen.index') }}" class="active">{{ __('front.listen_sessions') }}</a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title">{{ __('front.listen_sessions') }}</h2>
  </div>
</section>

<section class="news-section">
  <div class="projects-grid">
    @forelse($newListens as $newListen)
    <div class="project-card">
      <div class="project-image">
        <img src="{{ $newListen->photo_url }}" alt="{{ $newListen->title }}">
      </div>
      <div class="project-content">
        <h3>{{ $newListen->title }}</h3>
        <p>{{ Str::limit($newListen->description, 100) }}</p>
        <a href="{{ route('newListen.show', $newListen->id) }}" class="project-link">
         {{ __('front.read_more') }}
         <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
    @empty
    <div class="no-data">
      <p>{{ __('front.listen_sessions') }}</p>
    </div>
    @endforelse
  </div>
</section>


@endsection