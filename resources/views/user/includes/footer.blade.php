<footer class="main-footer">
  <div class="footer-top">
    <div class="footer-col">
      <h3>{{ __('front.about_municipality') }}</h3>
      <ul>
        <li><a href="{{ route('about') }}">{{ __('front.about_us') }}</a></li>
        <li><a href="{{ route('projects') }}">{{ __('front.projects') }}</a></li>
        <li><a href="{{ route('services') }}">{{ __('front.services') }}</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h3>{{ __('front.quick_links') }}</h3>
      <ul>
        <li><a href="{{ route('importantLink') }}">{{ __('front.important_links') }}</a></li>
        <li><a href="{{ route('questions') }}">{{ __('front.faq') }}</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h3>{{ __('front.contact_us') }}</h3>
      <p><i class="fas fa-phone-alt"></i> {{ $setting->phone }}</p>
      <p><i class="fas fa-envelope"></i> {{ $setting->email }}</p>
      <div class="social-icons">
        <a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a>
        <a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
        <a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
      </div>
    </div>

    <div class="footer-col newsletter">
      <h3>{{ __('front.newsletter') }}</h3>
      <div class="newsletter-form">
        <input type="email" placeholder="{{ __('front.enter_email') }}">
        <button><i class="fas fa-paper-plane"></i></button>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    {{ __('front.copyright') }}
  </div>
</footer>
