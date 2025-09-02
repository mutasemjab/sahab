@extends('layouts.front')

@section('content')
    <div class="breadcrumb-bar">
        <div class="breadcrumb-container">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span> <i class="fas fa-chevron-left"></i> </span>
            <a href="{{ route('media.center') }}" class="active">{{ __('front.media_center') }}</a>
        </div>
    </div>

    <section class="mutasem-propose-intro">
        <div class="mutasem-container">
            <h2 class="mutasem-title">{{ __('front.media_center') }}</h2>
            <p class="mutasem-subtitle">{{ __('front.media_center_subtitle') }}</p>
        </div>
    </section>

    <section class="news-section">
        <h2 class="section-title">{{ __('front.advertisements') }}</h2>

        <div class="projects-grid">
            @forelse($advertisements as $advertisement)
                <div class="project-card">
                    <div class="project-image">
                        <img src="{{ $advertisement->photo_url }}" alt="{{ $advertisement->title }}">
                    </div>
                    <div class="project-content">
                        <p class="start-date">{{ $advertisement->formatted_date }}</p>
                        <h3>{{ $advertisement->title }}</h3>
                        <p>{{ Str::limit($advertisement->description, 100) }}</p>
                        <a href="{{ route('advertisement.show', $advertisement->id) }}" class="project-link">
                            {{ __('front.read_more') }}
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="no-data">
                    <p>{{ __('front.no_advertisements') }}</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination Links --}}
        @if($advertisements->hasPages())
            <div class="pagination-wrapper" style="margin-top: 40px; text-align: center;">
                {{ $advertisements->links() }}
            </div>
        @endif

        {{-- Remove the "More" button since we're using pagination now --}}
    </section>

    <section class="mutasem-social-section">
        <h2 class="mutasem-gallery-title">{{ __('front.social_media_updates') }}</h2>
        <div class="mutasem-container mutasem-social-grid">

            <!-- فيسبوك -->
            <div class="mutasem-social-card">
                <div class="mutasem-social-header">
                    <svg width="20" height="20" fill="#1877F2" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898v-2.891h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                    <span>{{ __('front.facebook_updates') }}</span>
                </div>
                
                <div class="mutasem-facebook-posts">
                    <!-- Facebook Page Plugin -->
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" 
                        src="https://connect.facebook.net/{{ app()->getLocale() == 'ar' ? 'ar_AR' : 'en_US' }}/sdk.js#xfbml=1&version=v18.0&appId={{ config('services.facebook.app_id') }}">
                    </script>
                    
                    <div class="fb-page" 
                         data-href="https://www.facebook.com/sahab.municipality" 
                         data-tabs="timeline" 
                         data-width="350" 
                         data-height="400" 
                         data-small-header="true" 
                         data-adapt-container-width="true" 
                         data-hide-cover="true" 
                         data-show-facepile="false">
                        <blockquote cite="https://www.facebook.com/sahab.municipality" 
                                   class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/sahab.municipality">
                                {{ __('front.sahab_municipality') }}
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection