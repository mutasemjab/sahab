@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{route('home')}}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{route('about')}}" class="active">{{ __('front.about_sahab') }}</a>
  </div>
</div>


<section class="about-sahab-section">
  <div class="about-sahab-container">
    <div class="about-sahab-content">
      <h2>{{ __('front.about_sahab_municipality') }}</h2>
      @if($about)
        <p>
          {{ $locale == 'ar' ? $about->description_ar : $about->description_en }}
        </p>
      @endif

      <div class="about-stats">
        <div class="stat-box">
          <strong>+100,000</strong>
          <span>{{ __('front.population') }}</span>
        </div>
        <div class="stat-box">
          <strong>150 {{ __('front.km2') }}</strong>
          <span>{{ __('front.area') }}</span>
        </div>
        <div class="stat-box">
          <strong>12</strong>
          <span>{{ __('front.regions') }}</span>
        </div>
        <div class="stat-box">
          <strong>1825</strong>
          <span>{{ __('front.established') }}</span>
        </div>
      </div>

      <a href="#" class="services-btn">{{ __('front.learn_more') }}</a>
    </div>
    <div class="about-sahab-image">
      @if($about)
        <img src="{{ asset('assets/admin/uploads/' . $about->photo) }}" alt="{{ __('front.sahab_municipality') }}">
      @endif
    </div>
  </div>
</section>

<section class="about-municipality">
  <h2>{{ __('front.about_municipality') }}</h2>
  <div class="cards">
    @foreach($completeAbouts as $completeAbout)
      <div class="card">
        <div class="{!! $completeAbout->icon !!}" style="color: #1b7b63;"></div>
        <h3>{{ $locale == 'ar' ? $completeAbout->title_ar : $completeAbout->title_en }}</h3>
        <p>{!! $locale == 'ar' ? $completeAbout->description_ar : $completeAbout->description_en !!}</p>
      </div>
    @endforeach
  </div>
</section>

<section class="organization-structure">
  <h2>{{ __('front.organization_structure') }}</h2>
    <img src="{{ asset('assets/admin/uploads/' . $about->photo_of_organizational_structure) }}">
</section>


<section class="sections-area">
  <h2 class="section-title">{{ __('front.our_departments') }}</h2>
  <div class="sections-grid">
    @foreach($ourParts as $ourPart)
      <div class="section-box">
        <i class="{{ $ourPart->icon }}"></i>
        <h3>{{ $locale == 'ar' ? $ourPart->title_ar : $ourPart->title_en }}</h3>
        <p>{{ $locale == 'ar' ? $ourPart->description_ar : $ourPart->description_en }}</p>
      </div>
    @endforeach
  </div>
</section>


<section class="municipal-council">
  <h2 class="section-title">{{ __('front.municipal_council') }}</h2>
  <div class="council-grid">
    @foreach($municipalCouncils as $member)
      <div class="member-box">
        <img src="{{ asset('assets/admin/uploads/' . $member->icon) }}" alt="{{ $locale == 'ar' ? $member->title_ar : $member->title_en }}">
        <h4>{{ $locale == 'ar' ? $member->title_ar : $member->title_en }}</h4>
        <p>{!! $locale == 'ar' ? $member->description_ar : $member->description_en !!}</p>
      </div>
    @endforeach
  </div>
</section>

<section class="laws-section">
  <h2 class="section-title">{{ __('front.laws_regulations') }}</h2>
  <div class="laws-grid">
    @foreach($laws as $law)
      <div class="law-card">
        <div class="law-icon">📄</div>
        <div class="law-content">
          <h3 class="law-title">{{ $locale == 'ar' ? $law->title_ar : $law->title_en }}</h3>
          <p class="law-desc">{!! $locale == 'ar' ? $law->description_ar : $law->description_en !!}</p>
          <a href="{{ asset('assets/admin/uploads/' . $law->pdf) }}" class="law-download" download>{{ __('front.download') }} <span>PDF</span> 📥</a>
        </div>
      </div>
    @endforeach
  </div>
</section>


@endsection