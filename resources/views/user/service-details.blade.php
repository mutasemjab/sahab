@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('services.index') }}">{{ __('front.services') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.service_details') }}</a>
  </div>
</div>

<div class="permit-page">
  <div class="permit-header">
    <h2>{{ $locale == 'ar' ? $service->title_ar : $service->title_en }}</h2>
    <p>
      {{ $locale == 'ar' ? $service->description_ar : $service->description_en }}
    </p>
    @if($service->pdf)
      <a href="{{ asset('storage/' . $service->pdf) }}" target="_blank" class="permit-link">📄 {{ __('front.service_level_agreement') }}</a>
    @endif
  </div>

  <div class="permit-layout">

    <!-- العمود الرئيسي -->
    <div class="permit-content">
      <div class="tabs">
        <span class="tab active" onclick="showTab('steps')">{{ __('front.steps') }}</span>
        <span class="tab" onclick="showTab('conditions')">{{ __('front.conditions') }}</span>
        <span class="tab" onclick="showTab('documents')">{{ __('front.required_documents') }}</span>
      </div>

      @if($service->serviceDetails && $service->serviceDetails->video)
        <!-- فيديو / صورة -->
        <div class="video-preview">
          <iframe src="{{ $service->serviceDetails->video }}" frameborder="0" allowfullscreen></iframe>
        </div>
      @else
        <div class="video-preview">
          <div class="video-icon">▶️</div>
        </div>
      @endif

      <!-- Content Tabs -->
      <div id="steps-content" class="tab-content active">
        @if($service->serviceDetails)
          <div class="service-description">
            {{ $locale == 'ar' ? $service->serviceDetails->description_ar : $service->serviceDetails->description_en }}
          </div>
        @else
          <ol class="steps">
            <li>{{ __('front.default_step_1') }}</li>
            <li>{{ __('front.default_step_2') }}</li>
            <li>{{ __('front.default_step_3') }}</li>
            <li>{{ __('front.default_step_4') }}</li>
            <li>{{ __('front.default_step_5') }}</li>
            <li>{{ __('front.default_step_6') }}</li>
          </ol>
        @endif
      </div>

      <div id="conditions-content" class="tab-content">
        @if($service->serviceDetails && $service->serviceDetails->condition)
          <div class="conditions-text">
            {!! nl2br(e($service->serviceDetails->condition)) !!}
          </div>
        @else
          <div class="conditions-text">
            <p>{{ __('front.no_conditions_available') }}</p>
          </div>
        @endif
      </div>

      <div id="documents-content" class="tab-content">
        @if($service->serviceDetails && $service->serviceDetails->required_file)
          <div class="documents-text">
            {!! nl2br(e($service->serviceDetails->required_file)) !!}
          </div>
        @else
          <div class="documents-text">
            <p>{{ __('front.no_documents_specified') }}</p>
          </div>
        @endif
      </div>
    </div>

    <!-- العمود الأيسر -->
    <div class="permit-sidebar">
      <ul class="info-list">
        <li><span>👥</span> {{ __('front.target_audience') }}: <br> <strong>{{ $service->target_audience ?? __('front.all_citizens') }}</strong></li>
        <li><span>⏱️</span> {{ __('front.service_duration') }}: <br> <strong>{{ $service->duration_service ?? __('front.not_specified') }}</strong></li>
        <li><span>🖥️</span> {{ __('front.service_channels') }}: <br> <strong>{{ $service->service_channel ?? __('front.online') }}</strong></li>
        <li><span>💰</span> {{ __('front.service_cost') }}: <br> <strong>{{ $service->service_cost ?? __('front.free') }}</strong></li>
      </ul>

      <div class="faq-section">
        <h4>{{ __('front.frequently_asked_questions') }}</h4>
        <p><a href="#">📎 {{ __('front.ministry_faq_page') }}</a></p>
        <p>📞 {{$setting->phone}}</p>
        <p>📧 {{$setting->email}}</p>
        @if($service->pdf)
          <a href="{{ asset('assets/admin/uploads/' . $service->pdf) }}" download class="download-btn">{{ __('front.download_user_guide') }}</a>
        @else
          <button class="download-btn" disabled>{{ __('front.no_guide_available') }}</button>
        @endif
      </div>
    </div>
  </div>
</div>

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