@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.tenders_bids') }}</a>
  </div>
</div>

<section class="tenders-page">
  <div class="tenders-header">
    <h2>{{ __('front.tenders_bids') }}</h2>
    <p>{{ __('front.tenders_description') }}</p>
  </div>

  <div class="tenders-filters">
    <div class="filters-right">
      <form method="GET" id="filter-form">
        <input type="search" name="search" class="tenders-search" placeholder="{{ __('front.search_tenders') }}" value="{{ request('search') }}">
        <select name="category" class="tenders-category" onchange="document.getElementById('filter-form').submit()">
          <option value="">{{ __('front.all_categories') }}</option>
          <!-- Add categories when needed -->
        </select>
      </form>
    </div>
    <div class="filters-left">
      <select name="sort" onchange="updateSort(this.value)" class="filter-sort">
        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('front.newest_first') }}</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('front.oldest_first') }}</option>
        <option value="closing_soon" {{ request('sort') == 'closing_soon' ? 'selected' : '' }}>{{ __('front.closing_soon') }}</option>
        <option value="value_high" {{ request('sort') == 'value_high' ? 'selected' : '' }}>{{ __('front.highest_value') }}</option>
        <option value="value_low" {{ request('sort') == 'value_low' ? 'selected' : '' }}>{{ __('front.lowest_value') }}</option>
      </select>
    </div>
  </div>

  @forelse($tenders as $tender)
    <div class="tender-box">
      <div class="tender-header">
        <span class="tender-category">{{ __('front.tender_category') }}</span>
        <h3 class="tender-title">{{ app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en }}</h3>
        <p class="tender-desc">{{ Str::limit(app()->getLocale() == 'ar' ? $tender->description_ar : $tender->description_en, 100) }}</p>
      </div>

      <div class="tender-details-grid">
        <div class="tender-item">
          <span class="tender-label">{{ __('front.reference_number') }}</span>
          <span class="tender-value">{{ $tender->number }}</span>
        </div>
        <div class="tender-item">
          <span class="tender-label">{{ __('front.value') }}</span>
          <span class="tender-value">{{ $tender->cost }}</span>
        </div>
        <div class="tender-item">
          <span class="tender-label">{{ __('front.publish_date') }}</span>
          <span class="tender-value">{{ Carbon\Carbon::parse($tender->date_publish)->format('d M Y') }}</span>
        </div>
        <div class="tender-item">
          <span class="tender-label">{{ __('front.closing_date') }}</span>
          <span class="tender-value tender-close-date 
            @if(Carbon\Carbon::parse($tender->date_close)->isPast()) expired
            @elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7) urgent
            @endif">
            {{ Carbon\Carbon::parse($tender->date_close)->format('d M Y') }}
            @if(Carbon\Carbon::parse($tender->date_close)->isPast())
              <small>({{ __('front.expired') }})</small>
            @elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7)
              <small>({{ __('front.closing_soon') }})</small>
            @endif
          </span>
        </div>
        <div class="tender-item">
          <a href="{{ route('tenders.show', $tender->id) }}" class="tender-btn">{{ __('front.details') }}</a>
        </div>
      </div>

      <div class="tender-footer">
        @if($tender->pdf)
          <a href="{{ route('tenders.download', $tender->id) }}" class="tender-download">
            <i class="fa fa-download"></i> {{ __('front.download_documents') }}
          </a>
        @endif
        @if($tender->pdf_file && count(json_decode($tender->pdf_file)) > 0)
          <a href="{{ route('tenders.download-files', $tender->id) }}" class="tender-download">
            <i class="fa fa-download"></i> {{ __('front.download_files') }}
          </a>
        @endif
      </div>
    </div>
  @empty
    <div class="no-tenders">
      <p>{{ __('front.no_tenders_found') }}</p>
    </div>
  @endforelse

  @if($tenders->hasPages())
    <div class="tender-pagination-wrapper">
      <div class="tender-pagination-info">
        {{ __('front.showing') }} {{ $tenders->firstItem() }}-{{ $tenders->lastItem() }} {{ __('front.of') }} {{ $tenders->total() }} {{ __('front.results') }}
      </div>
      <div class="tender-pagination">
        @if($tenders->hasMorePages())
          <a href="{{ $tenders->nextPageUrl() }}" class="tender-page">{{ __('front.next') }}</a>
        @endif
        
        @foreach($tenders->getUrlRange(max(1, $tenders->currentPage() - 2), min($tenders->lastPage(), $tenders->currentPage() + 2)) as $page => $url)
          <a href="{{ $url }}" class="tender-page {{ $page == $tenders->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        
        @if($tenders->onFirstPage() == false)
          <a href="{{ $tenders->previousPageUrl() }}" class="tender-page">{{ __('front.previous') }}</a>
        @endif
      </div>
    </div>
  @endif
</section>

<section class="guidelines-section">
  <h2 class="guidelines-title">{{ __('front.submission_guidelines') }}</h2>
  
  <div class="guideline-item">
    <div class="guideline-icon">
      <span class="icon-guideline">📝</span>
    </div>
    <div class="guideline-text">
      <h4 class="guideline-heading">{{ __('front.required_documents') }}</h4>
      <p class="guideline-description">
        {{ __('front.required_documents_description') }}
      </p>
    </div>
  </div>

  <div class="guideline-item">
    <div class="guideline-icon">
      <span class="icon-guideline">🕒</span>
    </div>
    <div class="guideline-text">
      <h4 class="guideline-heading">{{ __('front.final_submission_deadline') }}</h4>
      <p class="guideline-description">
        {{ __('front.submission_deadline_description') }}
      </p>
    </div>
  </div>

  <div class="guideline-item">
    <div class="guideline-icon">
      <span class="icon-guideline">✅</span>
    </div>
    <div class="guideline-text">
      <h4 class="guideline-heading">{{ __('front.compliance') }}</h4>
      <p class="guideline-description">
        {{ __('front.compliance_description') }}
      </p>
    </div>
  </div>
</section>

<script>
function updateSort(sortValue) {
  const url = new URL(window.location);
  url.searchParams.set('sort', sortValue);
  window.location.href = url.toString();
}

// Auto-submit search form on input
document.querySelector('.tenders-search').addEventListener('input', function() {
  setTimeout(() => {
    document.getElementById('filter-form').submit();
  }, 500);
});
</script>


@endsection