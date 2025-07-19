@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.community') }}</a>
  </div>
</div>

<section class="mutasem-community-section">
  <div class="mutasem-container">
    <h2 class="mutasem-title">{{ __('front.shape_community_future') }}</h2>
    <p class="mutasem-subtitle">{{ __('front.community_participation_description') }}</p>

    <!-- المبادرات المجتمعية -->
    <div class="mutasem-block">
      <h3 class="mutasem-heading">{{ __('front.community_initiatives') }}</h3>
      <div class="mutasem-cards-row">
        @forelse($initiatives as $initiative)
          <div class="mutasem-card">
            <div class="mutasem-card-header">
              <h4>{{ app()->getLocale() == 'ar' ? $initiative->title_ar : $initiative->title_en }}</h4>
              <p>{{ Str::limit(app()->getLocale() == 'ar' ? $initiative->description_ar : $initiative->description_en, 100) }}</p>
            </div>
            <div class="mutasem-card-progress">
              <span class="supporter-count-{{ $initiative->id }}">{{ $initiative->supporting_users_count }} {{ __('front.supporters') }}</span>
              @if($initiative->date_finish)
                <span>{{ __('front.ends_on') }} {{ Carbon\Carbon::parse($initiative->date_finish)->format('d M Y') }}</span>
              @endif
              @php
                $supportCount = $initiative->supporting_users_count;
                $progressPercentage = min(($supportCount / 100) * 100, 100); // Assuming 100 is the target
              @endphp
              <div class="mutasem-progress-bar">
                <div class="progress-fill-{{ $initiative->id }}" style="width: {{ $progressPercentage }}%;"></div>
              </div>
              @auth
                @if($initiative->isSupportedByUser(Auth::id()))
                  <button class="support-initiative-btn supported" disabled>
                    {{ __('front.supported') }} ✓
                  </button>
                @else
                  <button class="support-initiative-btn" data-id="{{ $initiative->id }}">
                    {{ __('front.support_initiative') }}
                  </button>
                @endif
              @else
                <a href="{{ route('login') }}" class="support-initiative-btn">
                  {{ __('front.login_to_support') }}
                </a>
              @endauth
            </div>
          </div>
        @empty
          <div class="no-initiatives">
            <p>{{ __('front.no_initiatives_available') }}</p>
          </div>
        @endforelse
      </div>
      <button class="mutasem-add-btn">+ {{ __('front.start_initiative') }}</button>
    </div>

    <!-- الجلسات العامة القادمة -->
    <div class="mutasem-block">
      <h3 class="mutasem-heading">{{ __('front.upcoming_public_sessions') }}</h3>
      <div class="mutasem-cards-row">
        @forelse($publicSessions as $session)
          <div class="mutasem-session-card">
            <span class="mutasem-status {{ $session->type == 1 ? 'open' : '' }}">
              {{ $session->type == 1 ? __('front.open') : __('front.coming_soon') }}
            </span>
            <h4>{{ app()->getLocale() == 'ar' ? $session->title_ar : $session->title_en }}</h4>
            <p>{{ Str::limit(app()->getLocale() == 'ar' ? $session->description_ar : $session->description_en, 100) }}</p>
            @if($session->date_of_event && $session->time)
              <p class="mutasem-time">
                {{ Carbon\Carbon::parse($session->date_of_event)->format('d M Y') }} | {{ $session->time }}
              </p>
            @endif
            @if($session->type == 1)
             <a href="{{ route('sessions.show', $session->id) }}" class="mutasem-primary-btn">
                  {{ __('front.join_session') }}
              </a>

            @else
              <button class="mutasem-light-btn">{{ __('front.vote_on_discussion_topics') }}</button>
            @endif
          </div>
        @empty
          <div class="no-sessions">
            <p>{{ __('front.no_sessions_available') }}</p>
          </div>
        @endforelse
      </div>
    </div>

    <!-- التصويت على مواضيع النقاش -->
    <div class="mutasem-block">
      <h3 class="mutasem-heading">{{ __('front.vote_on_discussion_topics') }}</h3>
      <div class="mutasem-cards-row">
        <!-- Sample static voting topics -->
        <div class="mutasem-vote-card">
          <h4>{{ __('front.public_safety') }}</h4>
          <p>{{ __('front.public_safety_desc') }}</p>
          <button class="mutasem-vote-btn">{{ __('front.vote') }} ↑</button>
          <div class="mutasem-progress-bar small"><div style="width: 60%;"></div></div>
          <span class="mutasem-vote-count">{{ __('front.current_votes') }}: 98</span>
        </div>

        <div class="mutasem-vote-card">
          <h4>{{ __('front.waste_management') }}</h4>
          <p>{{ __('front.waste_management_desc') }}</p>
          <button class="mutasem-vote-btn">{{ __('front.vote') }} ↑</button>
          <div class="mutasem-progress-bar small"><div style="width: 80%;"></div></div>
          <span class="mutasem-vote-count">{{ __('front.current_votes') }}: 134</span>
        </div>

        <div class="mutasem-vote-card">
          <h4>{{ __('front.road_infrastructure') }}</h4>
          <p>{{ __('front.road_infrastructure_desc') }}</p>
          <button class="mutasem-vote-btn">{{ __('front.vote') }} ↑</button>
          <div class="mutasem-progress-bar small"><div style="width: 90%;"></div></div>
          <span class="mutasem-vote-count">{{ __('front.current_votes') }}: 156</span>
        </div>
      </div>
    </div>
  </div>
</section>

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<script>
// Support Initiative
document.querySelectorAll('.support-initiative-btn:not(.supported)').forEach(button => {
  button.addEventListener('click', function() {
    const initiativeId = this.getAttribute('data-id');
    const button = this;
    
    fetch(`/community/support-initiative/${initiativeId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update button
        button.textContent = '{{ __("front.supported") }} ✓';
        button.classList.add('supported');
        button.disabled = true;
        
        // Update supporter count
        document.querySelector(`.supporter-count-${initiativeId}`).textContent = 
          `${data.new_count} {{ __('front.supporters') }}`;
        
        // Update progress bar
        const progressPercentage = Math.min((data.new_count / 100) * 100, 100);
        document.querySelector(`.progress-fill-${initiativeId}`).style.width = 
          `${progressPercentage}%`;
        
        // Show success message
        alert(data.message);
      } else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('{{ __("front.error_occurred") }}');
    });
  });
});
</script>


@endsection