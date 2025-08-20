@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('community.index') }}">{{ __('front.community') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.session_details') }}</a>
  </div>
</div>

<section class="mutasem-sessionview-wrapper">
  <div class="mutasem-sessionview-container">
    <div class="mutasem-sessionview-header">
      <h2 class="mutasem-sessionview-title">{{ $locale == 'ar' ? $session->title_ar : $session->title_en }}</h2>
      <p class="mutasem-sessionview-desc">
        {{ $locale == 'ar' ? $session->description_ar : $session->description_en }}
      </p>
    </div>

<div class="mutasem-sessionview-details">

  @if($session->time)
    <div class="mutasem-sessionview-info-box">
      <strong>
        <i class="far fa-clock" style="color:#1b7b63; margin-left:6px;"></i>
        {{ __('front.time') }}
      </strong>
      <div>{{ $session->time }}</div>
    </div>
  @endif

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="far fa-calendar-alt" style="color:#1b7b63; margin-left:6px;"></i>
      {{ __('front.date') }}
    </strong>
    <div>{{ Carbon\Carbon::parse($session->date_of_event)->format('l, d F Y') }}</div>
  </div>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="fas fa-map-marker-alt" style="color:#1b7b63; margin-left:6px;"></i>
      {{ __('front.location') }}
    </strong>
    <div>{{ __('front.online_via_zoom') }}</div>
  </div>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="fas fa-video" style="color:#1b7b63; margin-left:6px;"></i>
      {{ __('front.platform') }}
    </strong>
    <div>{{ __('front.zoom_platform') }}</div>
  </div>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="fas fa-info-circle" style="color:#1b7b63; margin-left:6px;"></i>
      {{ __('front.status') }}
    </strong>
    <div class="session-status {{ $session->type == 1 ? 'open' : 'soon' }}">
      {{ $session->type == 1 ? __('front.open_for_registration') : __('front.coming_soon') }}
    </div>
  </div>

</div>


    <div class="mutasem-sessionview-content">
      @if($session->video)
        <div class="mutasem-sessionview-video">
          <h3 class="mutasem-sessionview-subtitle">{{ __('front.session_video') }}</h3>
          <div class="mutasem-sessionview-video-box">
            <iframe src="{{ $session->video }}" frameborder="0" allowfullscreen style="width: 100%; height: 300px; border-radius: 8px;"></iframe>
          </div>
        </div>
      @else
        <div class="mutasem-sessionview-video">
          <h3 class="mutasem-sessionview-subtitle">{{ __('front.session_video') }}</h3>
          <div class="mutasem-sessionview-video-box">
            <span class="mutasem-sessionview-play">▶</span>
            <p>{{ __('front.video_will_be_available') }}</p>
          </div>
        </div>
      @endif
    </div>

    <div class="mutasem-sessionview-expect">
      <h3 class="mutasem-sessionview-subtitle">{{ __('front.what_to_expect') }}</h3>
      @if($session->what_expect)
        <div class="session-expectations">
          {!! nl2br(e($session->what_expect)) !!}
        </div>
      @else
        <ul class="mutasem-sessionview-list">
          <li>{{ __('front.expect_1') }}</li>
          <li>{{ __('front.expect_2') }}</li>
          <li>{{ __('front.expect_3') }}</li>
          <li>{{ __('front.expect_4') }}</li>
        </ul>
      @endif
    </div>


  </div>
</section>



@endsection