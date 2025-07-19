@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.services') }}</a>
  </div>
</div>

<section class="municipal-services">
  <h2 class="section-title">{{ __('front.municipal_services') }}</h2>
  <p class="section-desc">
    {{ __('front.municipal_services_description') }}
  </p>
</section>

<section class="service-cards">
  <h3 class="cards-title">{{ __('front.municipal_services') }}</h3>
  <div class="cards-grid">
    @forelse($services as $service)
      <div class="card">
        <div class="icon">{!! $service->icon !!}</div>
        <h4>{{ $locale == 'ar' ? $service->title_ar : $service->title_en }}</h4>
        <p>{{ Str::limit($locale == 'ar' ? $service->description_ar : $service->description_en, 80) }}</p>
        <a href="{{ route('services.show', $service->id) }}">{{ __('front.learn_more') }} ←</a>
      </div>
    @empty
      <div class="no-services">
        <p>{{ __('front.no_services_available') }}</p>
      </div>
    @endforelse
  </div>
</section>

<section class="service-request">
  <div class="request-box">
    <h3>{{ __('front.submit_service_request') }}</h3>
    
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <form action="{{ route('services.form.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>{{ __('front.service_type') }}</label>
        <select name="service_id" required>
          <option value="" selected disabled>{{ __('front.choose_service') }}</option>
          @foreach($services as $service)
            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
              {{ $locale == 'ar' ? $service->title_ar : $service->title_en }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>{{ __('front.full_name') }}</label>
        <input type="text" name="name" placeholder="{{ __('front.full_name') }}" value="{{ old('name') }}" required />
      </div>

      <div class="form-group">
        <label>{{ __('front.email_address') }}</label>
        <input type="email" name="email" placeholder="{{ __('front.email_address') }}" value="{{ old('email') }}" required />
      </div>

      <div class="form-group">
        <label>{{ __('front.request_details') }}</label>
        <textarea name="message" placeholder="{{ __('front.request_details') }}" required>{{ old('message') }}</textarea>
      </div>

      <button type="submit" class="submit-btn">{{ __('front.submit_request') }}</button>
    </form>
  </div>
</section>

@endsection