<header class="header-container">
  <div class="header-logo">
    <img src="{{ asset('assets/admin/uploads/' . $setting->photo) }}" alt="{{ __('front.sahab_logo_alt') }}">
  </div>

<div class="header-menu">
    
    <div class="dropdown">
        <a href="{{ route('about') }}">{{ __('front.about_municipality') }} <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
            <a href="{{ route('about') }}">عن البلدية</a>
            <a href="{{ route('projects') }}">المشاريع</a>
        </div>
    </div>
    
    <a href="{{ route('services') }}">{{ __('front.services') }} </a>
    
    <div class="dropdown">
        <a href="{{ route('community.index') }}">{{ __('front.community') }} <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
             <a href="{{ route('community.index') }}">تفاصيل المجتمع</a>
            <a href="{{ route('suggestion') }}">اقتراحات</a>
           
        </div>
    </div>

    <div class="dropdown">
        <a href="{{ route('complaints.index') }}">{{ __('front.complaints') }} <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
            <a href="{{ route('complaints.index') }}">تقديم شكوى</a>
            <a href="{{ route('complaintdetails') }}">تفاصيل الشكوى</a>
            <a href="{{ route('complaintfollow') }}">تتبع شكواك</a>
        </div>
    </div>

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


    <a href="{{route('community.index')}}"><i class="fas fa-universal-access"></i></a>
  </div>

  <div class="mobile-menu-icon" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </div>
<div class="mobile-nav" id="mobileNav">
    <!-- About & Projects -->
    <div class="mobile-section">
        <div class="mobile-main">
            {{ __('front.about_municipality') }}
        </div>
        <div class="mobile-sub">
            <div><a href="{{ route('about') }}">عن البلدية</a></div>
            <div><a href="{{ route('projects') }}">المشاريع</a></div>
        </div>
    </div>

    <!-- Services -->
    <div class="mobile-section">
        <div class="mobile-main">
            <a href="{{ route('services') }}">{{ __('front.services') }}</a>
        </div>
    </div>

    <!-- Community -->
    <div class="mobile-section">
        <div class="mobile-main">
            {{ __('front.community') }}
        </div>
        <div class="mobile-sub">
            <div><a href="{{ route('community.index') }}">تفاصيل المجتمع</a></div>
            <div><a href="{{ route('suggestion') }}">اقتراحات</a></div>
        </div>
    </div>

    <!-- Complaints -->
    <div class="mobile-section">
        <div class="mobile-main">
            {{ __('front.complaints') }}
        </div>
        <div class="mobile-sub">
            <div><a href="{{ route('complaints.index') }}">تقديم شكوى</a></div>
            <div><a href="{{ route('complaintdetails') }}">تفاصيل الشكوى</a></div>
            <div><a href="{{ route('complaintfollow') }}">تتبع شكواك</a></div>
        </div>
    </div>

    <!-- Media Center -->
    <div class="mobile-section">
        <div class="mobile-main">
            <a href="{{ route('media.center') }}">{{ __('front.media_center') }}</a>
        </div>
    </div>

    <!-- Contact Us -->
    <div class="mobile-section">
        <div class="mobile-main">
            <a href="{{ route('contact.index') }}">{{ __('front.contact_us') }}</a>
        </div>
    </div>
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

.header-menu {
    display: flex;
    gap: 20px;
    position: relative;
}

.header-menu .dropdown {
    position: relative;
}

.header-menu .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    min-width: 180px;
    z-index: 1000;
}

.header-menu .dropdown-menu a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s;
}

.header-menu .dropdown-menu a:hover {
    background: #f2f2f2;
}


.header-menu .dropdown:hover .dropdown-menu {
    display: block;
}

.mobile-nav {
    display: none;
    flex-direction: column;
    background: #fff;
    padding: 15px;
    border-top: 1px solid #ddd;
}


.mobile-section {
    margin-bottom: 15px;
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 10px;
}

.mobile-main {
    font-size: 18px;
    font-weight: bold;
    color: #2c3a47;
    margin-bottom: 8px;
}


.mobile-main a {
    color: #2c3a47;
    text-decoration: none;
    display: block;
    padding: 5px 0;
}


.mobile-sub div {
    margin-bottom: 5px;
}

.mobile-sub a {
    display: block;
    font-size: 15px;
    color: #555;
    padding: 6px 10px;
    border-radius: 6px;
    background: #f8f8f8;
    text-decoration: none;
    transition: background 0.3s;
}

.mobile-sub a:hover {
    background: #e9e9e9;
}


@media (max-width: 991px) {
    .mobile-nav {
        display: none;
    }
}

@media (max-width: 768px) {
  .header-menu {
    display: none !important;
  }
}
  </style>
