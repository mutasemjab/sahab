@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('contact.index') }}" class="active">{{ __('front.contact_us') }}</a>
  </div>
</div>

<section class="municipal-services">
  <h2 class="section-title">{{ __('front.contact_us_title') }}</h2>
  <p class="section-desc">
    {{ __('front.contact_us_description') }}
  </p>
</section>

<section class="contact-section">
  <div class="container contact-grid">
    <div class="contact-form">
      <h3>{{ __('front.send_us_message') }}</h3>
      
      @if(session('success'))
        <div class="alert alert-success">
          {{ __('front.message_sent_success') }}
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
            @php
                $fixedUrl = str_replace('https://maps.google.com/embed', 'https://www.google.com/maps/embed', $setting->google_map);
            @endphp
            <iframe 
                src="{{ $fixedUrl }}"
                width="100%" 
                height="250" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        @endif
      </div>

      {{-- Social Media Section --}}
      <div class="social-media-section" style="margin-top: 30px;">
        <h3>{{ __('front.follow_us') }}</h3>
        <div class="social-icons" style="display: flex; gap: 15px; margin-top: 15px;">
          
          {{-- Facebook --}}
          @if($setting && $setting->facebook)
            <a href="{{ $setting->facebook }}" target="_blank" class="social-icon facebook" style="display: flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: #1877F2; color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s ease; font-size: 18px;">
              <i class="fab fa-facebook-f"></i>
            </a>
          @endif

          {{-- Instagram --}}
          @if($setting && $setting->instagram)
            <a href="{{ $setting->instagram }}" target="_blank" class="social-icon instagram" style="display: flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s ease; font-size: 18px;">
              <i class="fab fa-instagram"></i>
            </a>
          @endif

          {{-- Twitter/X --}}
          @if($setting && $setting->twitter)
            <a href="{{ $setting->twitter }}" target="_blank" class="social-icon twitter" style="display: flex; align-items: center; justify-content: center; width: 45px; height: 45px; background: #1DA1F2; color: white; border-radius: 50%; text-decoration: none; transition: all 0.3s ease; font-size: 18px;">
              <i class="fab fa-twitter"></i>
            </a>
          @endif

          {{-- If social URLs are not in settings, you can use static links --}}
          {{-- Remove the @if conditions above and uncomment below if you want static links --}}
          
          {{--
          <a href="https://facebook.com/your-page" target="_blank" class="social-icon facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          
          <a href="https://instagram.com/your-profile" target="_blank" class="social-icon instagram">
            <i class="fab fa-instagram"></i>
          </a>
          
          <a href="https://twitter.com/your-profile" target="_blank" class="social-icon twitter">
            <i class="fab fa-twitter"></i>
          </a>
          --}}

        </div>
      </div>
    </div>
  </div>
</section>

{{-- Add this CSS for better social media icons styling --}}
<style>
.social-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.social-icon.facebook:hover {
    background: #166fe5;
}

.social-icon.instagram:hover {
    background: linear-gradient(45deg, #e1306c 0%, #f77737 50%, #fcaf45 100%);
}

.social-icon.twitter:hover {
    background: #1a91da;
}

@media (max-width: 768px) {
    .social-icons {
        justify-content: center;
    }
}
</style>

@endsection