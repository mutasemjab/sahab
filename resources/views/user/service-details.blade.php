@extends('layouts.front')

@section('content')

<style>
  .tab-content { display: none;!important }
  .tab-content.active { display: block;!important }
  .tab.active { font-weight: 700; }
</style>


<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
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
      <a href="{{ asset('assets/admin/uploads/' . $service->pdf) }}" target="_blank" class="permit-link">📄 {{ __('front.service_level_agreement') }}</a>
    @endif
  </div>

  <div class="permit-layout">

    <!-- العمود الرئيسي -->
    <div class="permit-content">
    <div class="tabs">
      <span class="tab active" onclick="showTab(event,'steps')">{{ __('front.steps') }}</span>
      <span class="tab" onclick="showTab(event,'conditions')">{{ __('front.conditions') }}</span>
      <span class="tab" onclick="showTab(event,'documents')">{{ __('front.required_documents') }}</span>
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
              {!! nl2br(e($service->serviceDetails->steps)) !!}
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
    <ul class="info-list" style="list-style:none; padding:0; margin:0; display:grid; gap:3px;">
      <li style="display:flex; align-items:flex-start; gap:10px; font-size:15px; color:#333;">
        <i class="fas fa-users" style="color:#065f46; font-size:18px; margin-top:2px;"></i>
        <div>
          {{ __('front.target_audience') }}: <br>
          <strong>{{ $service->target_audience ?? __('front.all_citizens') }}</strong>
        </div>
      </li>
      
      <li style="display:flex; align-items:flex-start; gap:10px; font-size:15px; color:#333;">
        <i class="fas fa-clock" style="color:#065f46; font-size:18px; margin-top:2px;"></i>
        <div>
          {{ __('front.service_duration') }}: <br>
          <strong>{{ $service->duration_service ?? __('front.not_specified') }}</strong>
        </div>
      </li>
      
      <li style="display:flex; align-items:flex-start; gap:10px; font-size:15px; color:#333;">
        <i class="fas fa-desktop" style="color:#065f46; font-size:18px; margin-top:2px;"></i>
        <div>
          {{ __('front.service_channels') }}: <br>
          <strong>{{ $service->service_channel ?? __('front.online') }}</strong>
        </div>
      </li>
      
      <li style="display:flex; align-items:flex-start; gap:10px; font-size:15px; color:#333;">
        <i class="fas fa-money-bill-wave" style="color:#065f46; font-size:18px; margin-top:2px;"></i>
        <div>
          {{ __('front.service_cost') }}: <br>
          <strong>{{ $service->service_cost ?? __('front.free') }}</strong>
        </div>
      </li>
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
function showTab(evt, tabName) {
  const contents = document.querySelectorAll('.tab-content');
  contents.forEach(c => c.classList.remove('active'));

  const tabs = document.querySelectorAll('.tab');
  tabs.forEach(t => t.classList.remove('active'));

  const target = document.getElementById(tabName + '-content');
  if (target) target.classList.add('active');

  if (evt && evt.currentTarget) {
    evt.currentTarget.classList.add('active');
  }
}
</script>



@endsection