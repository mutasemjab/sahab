<header class="header-container">
  <div class="header-logo">
    <img src="{{ asset('assets/admin/uploads/' . $setting->photo) }}" alt="{{ __('front.sahab_logo_alt') }}">
  </div>

  <div class="header-menu">
    <a href="{{ route('about') }}">{{ __('front.about_municipality') }}</a>
    <a href="{{ route('services') }}">{{ __('front.services') }} <i class="fas fa-chevron-down"></i></a>
    <a href="#">{{ __('front.community') }} <i class="fas fa-chevron-down"></i></a>
    <a href="{{ route('complaints.index') }}">{{ __('front.complaints') }} <i class="fas fa-chevron-down"></i></a>
    <a href="{{ route('media.center') }}">{{ __('front.media_center') }}</a>
    <a href="{{ route('contact.index') }}">{{ __('front.contact_us') }}</a>
  </div>

  <div class="header-icons">
    <i class="fas fa-search"></i>
<div class="custom-dropdown">
    <button class="dropdown-toggle">
        <i class="fas fa-globe"></i> {{ __('Language') }}
    </button>
    <ul class="dropdown-menu">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


    <i class="fas fa-universal-access"></i>
  </div>

  <div class="mobile-menu-icon" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </div>

  <div class="mobile-nav" id="mobileNav">
    <a href="#">{{ __('front.about_municipality') }}</a>
    <a href="#">{{ __('front.services') }}</a>
    <a href="#">{{ __('front.community') }}</a>
    <a href="#">{{ __('front.complaints') }}</a>
    <a href="#">{{ __('front.media_center') }}</a>
    <a href="#">{{ __('front.contact_us') }}</a>
  </div>
</header>

<style>
  .custom-dropdown {
    position: relative;
    display: inline-block;
}

.custom-dropdown .dropdown-toggle {
    background-color: #3490dc;
    color: #fff;
    padding: 10px 16px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}

.custom-dropdown .dropdown-menu {
    display: none;
    position: absolute;
    top: 110%;
    left: 0;
    background-color: #fff;
    min-width: 140px;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 1000;
}

.custom-dropdown:hover .dropdown-menu {
    display: block;
}

.custom-dropdown .dropdown-item {
    color: #333;
    padding: 10px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.2s ease;
}

.custom-dropdown .dropdown-item:hover {
    background-color: #f5f5f5;
}

  </style>
