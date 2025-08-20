@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{route('importantLinks.index')}}" class="active">{{ __('front.important_links') }}</a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title">{{ __('front.important_links') }}</h2>
    <p class="mutasem-subtitle">{{ __('front.important_links_subtitle') }}</p>
  </div>
</section>



<section class="mutasem-orgs-wrapper" id="linksContainer">
  @forelse($groupedLinks as $group)
  <div class="mutasem-orgs-group" data-group="{{ $group['class'] }}">
    <h3 class="mutasem-orgs-title">{{ $group['title'] }}</h3>
    <div class="mutasem-orgs-grid">
      @foreach($group['links'] as $link)
      <a href="{{ $link->link }}" 
         class="mutasem-orgs-card" 
         {{ $link->is_external ? 'target="_blank" rel="noopener noreferrer"' : '' }}
         data-link-id="{{ $link->id }}">
        <div class="mutasem-orgs-icon">
          {!! $link->icon_html !!}
        </div>
        <div class="mutasem-orgs-text">
          <h4>{{ $link->title }}</h4>
          <p>{{ $link->description }}</p>
        </div>

      </a>
      @endforeach
    </div>
  </div>
  @empty
  <div class="no-links">
    <div class="mutasem-container">
      <div class="no-links-content">
        <div class="no-links-icon">🔗</div>
        <h3>{{ __('front.no_links_available') }}</h3>
        <p>{{ __('front.no_links_message') }}</p>
      </div>
    </div>
  </div>
  @endforelse
</section>



@endsection