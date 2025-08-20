@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('complaints.index') }}" class="active">{{ __('front.track_your_complaint') }}</a>
  </div>
</div>

<section class="track-complaint-section">
  <div class="track-heading">
    <h2 class="section-title">{{ __('front.track_your_complaint') }}</h2>
    <p class="section-subtitle">{{ __('front.enter_complaint_number_or_phone') }}</p>
  </div>
  
  @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <div class="track-box">
    <form class="track-form" action="{{ route('complaints.track') }}" method="GET">
      <input
        type="text"
        name="search_term"
        class="track-input"
        placeholder="{{ __('front.complaint_number_or_phone_placeholder') }}"
        value="{{ request('search_term') }}"
        required
      />
      <button class="track-submit" type="submit">← {{ __('front.submit') }}</button>
    </form>
  </div>

  @if(isset($complaints))
    <div class="track-results">
      @if($complaints->count() > 0)
        <h3 class="results-title">{{ __('front.search_results') }}</h3>
        <div class="complaints-track-list">
          @foreach($complaints as $complaint)
            <div class="complaint-track-card">
              <div class="complaint-track-header">
                <div class="complaint-track-number">
                  <strong>{{ __('front.complaint_number') }}: #{{ $complaint->number }}</strong>
                  @if($complaint->is_complaint_emergency == 1)
                    <span class="emergency-badge">{{ __('front.emergency') }}</span>
                  @endif
                </div>
                <div class="complaint-track-date">
                  {{ $complaint->created_at->format('Y-m-d') }}
                </div>
              </div>
              
              <div class="complaint-track-content">
                @if($complaint->hide_information == 2)
                  <div class="complaint-submitter">
                    <i class="fas fa-user"></i>
                    {{ $complaint->name }}
                  </div>
                @endif
                
                <div class="complaint-service">
                  <i class="fas fa-cog"></i>
                  <strong>{{ __('front.service') }}:</strong>
                  {{ $locale == 'ar' ? $complaint->service->title_ar : $complaint->service->title_en }}
                </div>
                
                <div class="complaint-location">
                  <i class="fas fa-map-marker-alt"></i>
                  <strong>{{ __('front.location') }}:</strong>
                  {{ $locale == 'ar' ? $complaint->placeComplaint->name_ar : $complaint->placeComplaint->name_en }}
                </div>
                
                <div class="complaint-details">
                  <strong>{{ __('front.complaint_details') }}:</strong>
                  {{ Str::limit($complaint->complaint_details, 150) }}
                </div>
              </div>
              
              <div class="complaint-track-footer">
                <div class="complaint-status">
                  <span class="status-badge-track 
                    @if($complaint->status == 1) pending
                    @elseif($complaint->status == 2) working
                    @elseif($complaint->status == 3) done
                    @elseif($complaint->status == 4) outside-jurisdiction
                    @else not-solved
                    @endif">
                    <i class="fas fa-circle status-icon"></i>
                    @if($complaint->status == 1)
                      {{ __('front.status_pending') }}
                    @elseif($complaint->status == 2)
                      {{ __('front.status_working') }}
                    @elseif($complaint->status == 3)
                      {{ __('front.status_done') }}
                    @elseif($complaint->status == 4)
                      {{ __('front.status_outside_jurisdiction') }}
                    @else
                      {{ __('front.status_not_solved') }}
                    @endif
                  </span>
                </div>
                
                <div class="complaint-actions">
                  <span class="time-ago">{{ $complaint->created_at->diffForHumans() }}</span>
                  <a href="{{ route('complaints-details-two', $complaint->id) }}" class="view-details-btn">
                    {{ __('front.view_full_details') }}
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
          <h4>{{ __('front.need_help') }}</h4>
          <div class="action-buttons">
            <a href="{{ route('complaints.index') }}" class="action-btn primary">
              <i class="fas fa-plus"></i>
              {{ __('front.submit_new_complaint') }}
            </a>
            <a href="{{ route('contact.index') }}" class="action-btn secondary">
              <i class="fas fa-phone"></i>
              {{ __('front.contact_support') }}
            </a>
          </div>
        </div>
        
      @else
        <div class="no-results">
          <div class="no-results-icon">
            <i class="fas fa-search"></i>
          </div>
          <h3>{{ __('front.no_complaints_found') }}</h3>
          <p>{{ __('front.no_complaints_found_message') }}</p>
          <div class="no-results-actions">
            <a href="{{ route('complaints.index') }}" class="btn-primary">
              {{ __('front.submit_new_complaint') }}
            </a>
          </div>
        </div>
      @endif
    </div>
  @endif
</section>


@endsection