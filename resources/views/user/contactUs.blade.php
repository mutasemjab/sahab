@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.contact_us') }}</a>
  </div>
</div>

<section class="contact-section">
  <div class="container contact-grid">
    <div class="contact-form">
      <h3>{{ __('front.send_us_message') }}</h3>
      
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

      <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <label>{{ __('front.full_name') }}</label>
        <input type="text" name="name" placeholder="{{ __('front.your_full_name') }}" value="{{ old('name') }}" required />
        
        <label>{{ __('front.email_address') }}</label>
        <input type="email" name="email" placeholder="{{ __('front.email_placeholder') }}" value="{{ old('email') }}" required />
        
        <label>{{ __('front.subject') }}</label>
        <input type="text" name="subject" placeholder="{{ __('front.subject_placeholder') }}" value="{{ old('subject') }}" required />
        
        <label>{{ __('front.message') }}</label>
        <textarea name="message" placeholder="{{ __('front.message_placeholder') }}" rows="5" required>{{ old('message') }}</textarea>
        
        <button type="submit">{{ __('front.send_message') }}</button>
      </form>
    </div>
    
    <div class="contact-info">
      <h3>{{ __('front.contact_information') }}</h3>
      @if($setting)
        <p><i class="fas fa-map-marker-alt"></i> {{ __('front.address') }}: {{ $locale == 'ar' ? $setting->address_ar : $setting->address_en }}</p>
        <p><i class="fas fa-phone-alt"></i> {{ __('front.phone') }}: {{ $setting->phone }}</p>
        <p><i class="fas fa-envelope"></i> {{ __('front.email') }}: {{ $setting->email }}</p>
      @endif
      
      <h3>{{ __('front.our_location') }}</h3>
      <div class="map-container">
        @if($setting && $setting->google_map)
          <iframe
            src="{{ $setting->google_map }}"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
          </iframe>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection