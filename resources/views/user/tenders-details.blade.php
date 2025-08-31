@extends('layouts.front')

@section('content')

<style>
  .tab-content { display: none;!important }
  .tab-content.active { display: block;!important }
  .tab.active { font-weight: 700; }
</style>


<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('wbsiteTenders.index') }}">{{ __('front.tenders_bids') }}</a>
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

<aside class="project-sidebar-box" style="background:#fff;border:1px solid #e6e6e6;border-radius:8px;padding:16px;">

  <!-- رقم المرجع -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <i class="fas fa-user" style="color:#065f46; margin-left:6px;"></i>
    <div style="display:inline-block;">
      <div style="font-weight:700; color:#333;">{{ __('front.reference_number') }}:</div>
      <strong style="color:#2b2b2b; display:block; margin-top:2px;">{{ $tender->number }}</strong>
    </div>
  </div>

  <!-- القيمة -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <i class="fas fa-money-bill-wave" style="color:#065f46; margin-left:6px;"></i>
    <div style="display:inline-block;">
      <div style="font-weight:700; color:#333;">{{ __('front.value') }}</div>
      <strong style="color:#2b2b2b; display:block; margin-top:2px;">{{ $tender->cost }}</strong>
    </div>
  </div>

  <!-- تاريخ النشر -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <i class="fas fa-calendar-day" style="color:#065f46; margin-left:6px;"></i>
    <div style="display:inline-block;">
      <div style="font-weight:700; color:#333;">{{ __('front.publish_date') }}</div>
      <strong style="color:#2b2b2b; display:block; margin-top:2px;">
        {{ Carbon\Carbon::parse($tender->date_publish)->format('d M Y') }}
      </strong>
    </div>
  </div>

  <!-- تاريخ الإغلاق -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <i class="fas fa-calendar-check" style="color:#065f46; margin-left:6px;"></i>
    <div style="display:inline-block;">
      <div style="font-weight:700; color:#333;">{{ __('front.closing_date') }}</div>
      <strong class="project-value" style="display:block; margin-top:2px;
        @if(Carbon\Carbon::parse($tender->date_close)->isPast()) color:#dc3545;
        @elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7) color:#fd7e14;
        @else color:#2b2b2b; @endif">
        {{ Carbon\Carbon::parse($tender->date_close)->format('d M Y') }}
      </strong>
      @if(Carbon\Carbon::parse($tender->date_close)->isPast())
        <small style="color:#dc3545; display:block;">({{ __('front.expired') }})</small>
      @elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7)
        <small style="color:#fd7e14; display:block;">({{ Carbon\Carbon::parse($tender->date_close)->diffInDays() }} {{ __('front.days_left') }})</small>
      @endif
    </div>
  </div>

  @if($tender->photo)
    <div class="sidebar-item" style="margin:10px 0;">
      <img src="{{ asset('storage/' . $tender->photo) }}" alt="{{ app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en }}" style="width:100%;border-radius:8px;">
    </div>
  @endif

  @if($tender->pdf)
    <div class="sidebar-item" style="margin:12px 0;">
      <i class="fas fa-file-download" style="color:#065f46; margin-left:6px;"></i>
      <a href="{{ route('tenders.download', $tender->id) }}" style="color:#065f46; text-decoration:none; font-weight:600;">
        {{ __('front.download_documents') }}
      </a>
    </div>
  @endif

  @if($tender->pdf_file && count(json_decode($tender->pdf_file)) > 0)
    <div class="sidebar-item" style="margin:12px 0;">
      <i class="fas fa-folder-open" style="color:#065f46; margin-left:6px;"></i>
      <a href="{{ route('tenders.download-files', $tender->id) }}" style="color:#065f46; text-decoration:none; font-weight:600;">
        {{ __('front.download_additional_files') }}
      </a>
    </div>
  @endif

  <hr style="margin:16px 0; border:none; border-top:1px solid #eee;">

  <!-- الأسئلة الشائعة -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <div style="font-weight:700; color:#333;">{{ __('front.frequently_asked_questions') }}</div>
    <i class="fas fa-link" style="color:#065f46; margin-left:6px;"></i>
    <a href="#" style="color:#065f46; text-decoration:none;">{{ __('front.ministry_faq_page') }}</a>
  </div>

  <!-- الهاتف -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <i class="fas fa-phone-alt" style="color:#065f46; margin-left:6px;"></i>
    <div style="display:inline-block;">
      <div style="font-weight:700; color:#333;">{{ __('front.phone') }}</div>
      <strong style="color:#065f46; display:block; margin-top:2px;">{{$setting->phone}}</strong>
    </div>
  </div>

  <!-- البريد الإلكتروني -->
  <div class="sidebar-item" style="margin-bottom:10px;">
    <i class="fas fa-envelope" style="color:#065f46; margin-left:6px;"></i>
    <div style="display:inline-block;">
      <div style="font-weight:700; color:#333;">{{ __('front.email') }}</div>
      <strong style="color:#065f46; display:block; margin-top:2px;">{{$setting->email}}</strong>
    </div>
  </div>

  <!-- دليل المستخدم -->
  <div class="sidebar-item" style="margin-top:12px;">
    @if($tender->pdf)
      <a href="{{ route('tenders.download', $tender->id) }}" 
         style="display:block;text-align:center;padding:10px;border-radius:6px;background:#f1f1f1;color:#333;text-decoration:none;">
        {{ __('front.download_user_guide') }}
      </a>
    @else
      <button disabled style="width:100%;padding:10px;border-radius:6px;background:#f1f1f1;color:#777;border:none;">
        {{ __('front.no_guide_available') }}
      </button>
    @endif
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