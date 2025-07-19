{{-- resources/views/user/complaint-details.blade.php --}}
@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('complaints.index') }}">{{ __('front.complaints') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.complaint_details') }}</a>
  </div>
</div>

<section class="complaints-summary-section">
  <h2 class="section-title">{{ __('front.complaint_details') }}</h2>
  <p class="section-subtitle">
    {{ __('front.complaint_summary_description') }}
  </p>

  <div class="filters-bar">
    <div class="filters-tabs">
      <button class="tab-filter {{ request('status') == '' ? 'active' : '' }}" data-status="">{{ __('front.all_complaints') }}</button>
      <button class="tab-filter {{ request('status') == '1' ? 'active' : '' }}" data-status="1">{{ __('front.unprocessed_complaints') }}</button>
      <button class="tab-filter {{ request('status') == '3' ? 'active' : '' }}" data-status="3">{{ __('front.resolved_complaints') }}</button>
      <button class="tab-filter {{ request('status') == '4' ? 'active' : '' }}" data-status="4">{{ __('front.complaints_outside_jurisdiction') }}</button>
    </div>

    <div class="filters-controls">
      <form method="GET" id="filter-form">
        <select name="service_id" onchange="submitFilter()">
          <option value="">{{ __('front.all_categories') }}</option>
          @foreach($services as $service)
            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
              {{ $locale == 'ar' ? $service->title_ar : $service->title_en }}
            </option>
          @endforeach
        </select>

        <select name="date_range" onchange="submitFilter()">
          <option value="30" {{ request('date_range') == '30' ? 'selected' : '' }}>{{ __('front.last_30_days') }}</option>
          <option value="7" {{ request('date_range') == '7' ? 'selected' : '' }}>{{ __('front.last_7_days') }}</option>
          <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>{{ __('front.this_month') }}</option>
        </select>

        <input type="text" name="search" placeholder="{{ __('front.search_complaints') }}" value="{{ request('search') }}">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <button type="submit" class="btn-search">{{ __('front.search') }}</button>
      </form>
    </div>
  </div>

  <div class="complaints-list">
    @forelse($complaints as $complaint)
      <div class="complaint-card">
        <div class="status-dot 
          @if($complaint->status == 1) red
          @elseif($complaint->status == 2) orange  
          @elseif($complaint->status == 3) green
          @elseif($complaint->status == 4) black
          @else red
          @endif"></div>
        <div class="complaint-info">
          <h4>{{ Str::limit($complaint->complaint_details, 60) }}</h4>
          <p>{{ Str::limit($complaint->complaint_details, 120) }}</p>
          <span class="date">{{ $complaint->created_at->format('Y-m-d') }}</span>
          <div class="complaint-meta-info">
            <small><strong>{{ __('front.complaint_number') }}:</strong> #{{ $complaint->number }}</small>
            <small><strong>{{ __('front.service') }}:</strong> {{ $locale == 'ar' ? $complaint->service->title_ar : $complaint->service->title_en }}</small>
            @if($complaint->is_complaint_emergency == 1)
              <span class="emergency-tag">{{ __('front.emergency') }}</span>
            @endif
          </div>
        </div>
        <a href="{{ route('complaint-details-two', $complaint->id) }}" class="btn-details">{{ __('front.view_details') }}</a>
      </div>
    @empty
      <div class="no-complaints">
        <p>{{ __('front.no_complaints_found') }}</p>
      </div>
    @endforelse
  </div>

  @if($complaints->hasPages())
    <div class="nav-buttons">
      @if($complaints->onFirstPage())
        <button class="btn-secondary" disabled>→ {{ __('front.previous') }}</button>
      @else
        <a href="{{ $complaints->previousPageUrl() }}" class="btn-secondary">→ {{ __('front.previous') }}</a>
      @endif
      
      @if($complaints->hasMorePages())
        <a href="{{ $complaints->nextPageUrl() }}" class="btn-primary">{{ __('front.next') }} ←</a>
      @else
        <button class="btn-primary" disabled>{{ __('front.next') }} ←</button>
      @endif
    </div>
  @endif
</section>

<script>
// Tab filtering
document.querySelectorAll('.tab-filter').forEach(tab => {
    tab.addEventListener('click', function() {
        const status = this.getAttribute('data-status');
        const form = document.getElementById('filter-form');
        const statusInput = form.querySelector('input[name="status"]');
        statusInput.value = status;
        form.submit();
    });
});

function submitFilter() {
    document.getElementById('filter-form').submit();
}
</script>

@endsection