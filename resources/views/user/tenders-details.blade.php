@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('tenders.index') }}">{{ __('front.tenders_bids') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.tender_details') }}</a>
  </div>
</div>

<section class="section-project-details">
  <div class="project-details-wrapper">
    <div class="project-main-content">
      <h2 class="project-title">{{ app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en }}</h2>
      <p class="project-description">
        {{ app()->getLocale() == 'ar' ? $tender->description_ar : $tender->description_en }}
      </p>
      @if($tender->pdf)
        <a href="{{ route('tenders.download', $tender->id) }}" class="agreement-link">{{ __('front.tender_agreement') }}</a>
      @endif

      <div class="project-tabs">
        <span class="tab active" onclick="showTab('steps')">{{ __('front.steps') }}</span>
        <span class="tab" onclick="showTab('documents')">{{ __('front.required_documents') }}</span>
        <span class="tab" onclick="showTab('conditions')">{{ __('front.conditions') }}</span>
      </div>

      @if($tender->tenderDetails && $tender->tenderDetails->video)
        <div class="project-video-box">
          <iframe src="{{ $tender->tenderDetails->video }}" frameborder="0" allowfullscreen style="width: 100%; height: 300px; border-radius: 8px;"></iframe>
        </div>
      @else
        <div class="project-video-box">
          <div class="video-placeholder">
            <span class="video-icon">▶</span>
          </div>
        </div>
      @endif

      <!-- Content Tabs -->
      <div id="steps-content" class="tab-content active">
        @if($tender->tenderDetails && $tender->tenderDetails->description_ar)
          <div class="tender-description">
            {{ app()->getLocale() == 'ar' ? $tender->tenderDetails->description_ar : $tender->tenderDetails->description_en }}
          </div>
        @else
          <ul class="project-steps-list">
            <li>{{ __('front.tender_step_1') }}</li>
            <li>{{ __('front.tender_step_2') }}</li>
            <li>{{ __('front.tender_step_3') }}</li>
            <li>{{ __('front.tender_step_4') }}</li>
            <li>{{ __('front.tender_step_5') }}</li>
            <li>{{ __('front.tender_step_6') }}</li>
            <li>{{ __('front.tender_step_7') }}</li>
          </ul>
        @endif
      </div>

      <div id="documents-content" class="tab-content">
        @if($tender->tenderDetails && $tender->tenderDetails->required_file)
          <div class="documents-text">
            {!! nl2br(e($tender->tenderDetails->required_file)) !!}
          </div>
        @else
          <div class="documents-text">
            <p>{{ __('front.no_documents_specified') }}</p>
          </div>
        @endif
      </div>

      <div id="conditions-content" class="tab-content">
        @if($tender->tenderDetails && $tender->tenderDetails->condition)
          <div class="conditions-text">
            {!! nl2br(e($tender->tenderDetails->condition)) !!}
          </div>
        @else
          <div class="conditions-text">
            <p>{{ __('front.no_conditions_available') }}</p>
          </div>
        @endif
      </div>
    </div>

    <aside class="project-sidebar-box">
      <div class="sidebar-item">
        <div class="project-label">{{ __('front.reference_number') }}:</div>
        <div class="project-value">{{ $tender->number }}</div>
      </div>
      
      <div class="sidebar-item">
        <div class="project-label">{{ __('front.value') }}</div>
        <div class="project-value">{{ $tender->cost }}</div>
      </div>
      
      <div class="sidebar-item">
        <div class="project-label">{{ __('front.publish_date') }}</div>
        <div class="project-value">{{ Carbon\Carbon::parse($tender->date_publish)->format('d M Y') }}</div>
      </div>
      
      <div class="sidebar-item">
        <div class="project-label">{{ __('front.closing_date') }}</div>
        <div class="project-value closing-date 
          @if(Carbon\Carbon::parse($tender->date_close)->isPast()) expired
          @elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7) urgent
          @endif">
          {{ Carbon\Carbon::parse($tender->date_close)->format('d M Y') }}
          @if(Carbon\Carbon::parse($tender->date_close)->isPast())
            <br><small style="color: #dc3545;">({{ __('front.expired') }})</small>
          @elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7)
            <br><small style="color: #fd7e14;">({{ Carbon\Carbon::parse($tender->date_close)->diffInDays() }} {{ __('front.days_left') }})</small>
          @endif
        </div>
      </div>

      @if($tender->photo)
        <div class="sidebar-item">
          <img src="{{ asset('storage/' . $tender->photo) }}" alt="{{ app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en }}" style="width: 100%; border-radius: 8px; margin: 1rem 0;">
        </div>
      @endif
      
      @if($tender->pdf)
        <div class="sidebar-item download-docs">
          <a href="{{ route('tenders.download', $tender->id) }}" class="download-link">{{ __('front.download_documents') }}</a>
        </div>
      @endif

      @if($tender->pdf_file && count(json_decode($tender->pdf_file)) > 0)
        <div class="sidebar-item download-docs">
          <a href="{{ route('tenders.download-files', $tender->id) }}" class="download-link">{{ __('front.download_additional_files') }}</a>
        </div>
      @endif
      
      <div class="sidebar-item faq-link">
        <a href="#">{{ __('front.ministry_faq_page') }}</a>
      </div>
      
      <div class="sidebar-item contact-phone">
        <div class="project-label">{{ __('front.phone') }}</div>
        <div class="project-value">{{$setting->phone}}</div>
      </div>  
      
      <div class="sidebar-item contact-email">
        <div class="project-label">{{ __('front.email') }}</div>
        <div class="project-value">{{$setting->email}}</div>
      </div>
      
      <div class="sidebar-item download-guide">
        @if($tender->pdf)
          <a href="{{ route('tenders.download', $tender->id) }}" class="btn-guide">{{ __('front.download_user_guide') }}</a>
        @else
          <button class="btn-guide" disabled>{{ __('front.no_guide_available') }}</button>
        @endif
      </div>

      <div class="sidebar-item back-to-tenders">
        <a href="{{ route('tenders.index') }}" class="btn-back">{{ __('front.back_to_tenders') }}</a>
      </div>
    </aside>
  </div>
</section>

<script>
function showTab(tabName) {
  // Hide all tab contents
  const contents = document.querySelectorAll('.tab-content');
  contents.forEach(content => {
    content.classList.remove('active');
  });
  
  // Remove active class from all tabs
  const tabs = document.querySelectorAll('.tab');
  tabs.forEach(tab => {
    tab.classList.remove('active');
  });
  
  // Show selected tab content
  document.getElementById(tabName + '-content').classList.add('active');
  
  // Add active class to clicked tab
  event.target.classList.add('active');
}
</script>



@endsection