@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{route('home')}}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('complaints.index') }}" class="active">{{ __('front.complaints') }}</a>
  </div>
</div>

<section class="complaint-section">
  <div class="container">
    <h2 class="section-title">{{ __('front.complaints') }}</h2>
    <p class="section-subtitle">
      {{ __('front.complaint_description') }}
    </p>
    <div class="complaint-buttons">
      <a href="#complaint-form" class="submit-btn" onclick="scrollToForm()">
        <i class="icon">+</i>
        {{ __('front.submit_complaint') }}
      </a>
      @if($setting && $setting->video)
        <a href="{{ $setting->video }}" target="_blank" class="video-btn">
          <i class="icon">◀</i>
          {{ __('front.watch_video') }}
        </a>
      @endif
    </div>
  </div>
</section>

<section class="mutasem-propose-guidelines">
        <h2 class="section-title">ارشادات التقديم</h2>
<div class="mutasem-container mutasem-guideline-grid">

  <!-- Fill Form -->
  <div class="mutasem-guideline-box" style="text-align:center;">
    <div class="mutasem-guideline-icon" style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
        <path d="M12 20h9" />
        <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
      </svg>
    </div>
    <h4>{{ __('front.fill_form') }}</h4>
    <p>{{ __('front.provide_detailed_info_complaint') }}</p>
  </div>

  <!-- Submit -->
  <div class="mutasem-guideline-box" style="text-align:center;">
    <div class="mutasem-guideline-icon" style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
        <path d="M22 2 11 13" />
        <path d="m22 2-7 20-4-9-9-4 20-7z" />
      </svg>
    </div>
    <h4>قدم</h4>
    <p>{{ __('front.review_by_team_complaint') }}</p>
  </div>

  <!-- Follow Up -->
  <div class="mutasem-guideline-box" style="text-align:center;">
    <div class="mutasem-guideline-icon" style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
        <circle cx="12" cy="12" r="10" />
        <path d="M12 6v6l4 2" />
      </svg>
    </div>
    <h4>{{ __('front.follow_up') }}</h4>
    <p>{{ __('front.track_submission_status') }}</p>
  </div>

</div>

</section>

<section class="suggestion-form-section" id="complaint-form">
  <div class="container">
    <h3 class="form-title">{{ __('front.submit_complaint_request') }}</h3>
    
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
<div class="form-progress" style="display:flex; align-items:center; justify-content:center; gap:25px;">

  <div class="step" style="display:flex; flex-direction:column; align-items:center;">
    <div class="circle active" id="step1-circle"
         style="width:30px; height:30px; border-radius:50%; background:#076046; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">
      1
    </div>
    <div class="label" style="margin-top:6px; font-size:14px; color:#076046;">
      {{ __('front.personal_information') }}
    </div>
  </div>

  <div style="width:60px; height:2px; background:#ccc;"></div>

  <div class="step" style="display:flex; flex-direction:column; align-items:center;">
    <div class="circle" id="step2-circle"
         style="width:30px; height:30px; border-radius:50%; background:#fff; color:#555; border:2px solid #ccc; display:flex; align-items:center; justify-content:center; font-weight:bold;">
      2
    </div>
    <div class="label" style="margin-top:6px; font-size:14px; color:#555;">
      {{ __('front.complaint_information') }}
    </div>
  </div>

  <div style="width:60px; height:2px; background:#ccc;"></div>

  <div class="step" style="display:flex; flex-direction:column; align-items:center;">
    <div class="circle" id="step3-circle"
         style="width:30px; height:30px; border-radius:50%; background:#fff; color:#555; border:2px solid #ccc; display:flex; align-items:center; justify-content:center; font-weight:bold;">
      3
    </div>
    <div class="label" style="margin-top:6px; font-size:14px; color:#555;">
      {{ __('front.detailed_address') }}
    </div>
  </div>

</div>

    
    <div class="form-box">
      <form id="complaint-form-main" action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Step 1: Personal Information -->
        <div class="form-step active" id="step1">
          <h4 class="form-heading">{{ __('front.personal_information') }}</h4>
          <p class="form-alert">
            <span class="icon">ℹ️</span>
            {{ __('front.data_privacy_notice') }}
          </p>
          
          <div class="form-group">
            <label>{{ __('front.full_name') }}</label>
            <input type="text" name="name" placeholder="{{ __('front.full_name') }}" value="{{ old('name') }}" required>
          </div>
          
          <div class="form-group">
            <label>{{ __('front.contact_number') }}</label>
            <input type="text" name="phone" placeholder="{{ __('front.contact_number') }}" value="{{ old('phone') }}" required>
          </div>
          
          <div class="form-group">
            <label>{{ __('front.choose_age') }}</label>
            <select name="age" required>
              <option value="" disabled {{ old('age') ? '' : 'selected' }}>{{ __('front.choose_age') }}</option>
              <option value="18-25" {{ old('age') == '18-25' ? 'selected' : '' }}>18-25</option>
              <option value="26-35" {{ old('age') == '26-35' ? 'selected' : '' }}>26-35</option>
              <option value="36-45" {{ old('age') == '36-45' ? 'selected' : '' }}>36-45</option>
              <option value="46-55" {{ old('age') == '46-55' ? 'selected' : '' }}>46-55</option>
              <option value="56-65" {{ old('age') == '56-65' ? 'selected' : '' }}>56-65</option>
              <option value="65+" {{ old('age') == '65+' ? 'selected' : '' }}>65+</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>{{ __('front.gender') }}</label>
            <select name="gender" required>
              <option value="" disabled {{ old('gender') ? '' : 'selected' }}>{{ __('front.choose_gender') }}</option>
              <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>{{ __('front.male') }}</option>
              <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>{{ __('front.female') }}</option>
            </select>
          </div>

          <div class="form-group">
            <label>{{ __('front.hide_personal_info') }}</label>
            <select name="hide_information" required>
              <option value="" disabled {{ old('hide_information') ? '' : 'selected' }}>{{ __('front.choose_option') }}</option>
              <option value="1" {{ old('hide_information') == '1' ? 'selected' : '' }}>{{ __('front.yes_hide') }}</option>
              <option value="2" {{ old('hide_information') == '2' ? 'selected' : '' }}>{{ __('front.no_show') }}</option>
            </select>
          </div>
          
          <div class="form-group" style="margin-top:8px;">
              <label style="display:flex; align-items:center; gap:8px;">
                <input type="checkbox" name="hide_identity" value="1" style="width:16px; height:16px;">
                {{ __('front.hide_my_identity') }}
              </label>
            </div>


      <div style="display:flex; justify-content:center; margin-top:16px;">
          <button type="button" id="nextBtn"
                  style="display:none; width:20%; background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;"
                  onclick="nextStep(1)">
            {{ __('front.next') }} ←
          </button>
        </div>

        </div>
        
        <!-- Step 2: Complaint Information -->
        <div class="form-step" id="step2">
          <h4 class="complaint-form-heading">{{ __('front.complaint_information') }}</h4>
          
          <div class="form-group">
            <label for="isUrgent">{{ __('front.is_complaint_urgent') }}</label>
            <select name="is_complaint_emergency" id="isUrgent" required>
              <option value="" disabled {{ old('is_complaint_emergency') ? '' : 'selected' }}>{{ __('front.choose') }}</option>
              <option value="1" {{ old('is_complaint_emergency') == '1' ? 'selected' : '' }}>{{ __('front.yes') }}</option>
              <option value="2" {{ old('is_complaint_emergency') == '2' ? 'selected' : '' }}>{{ __('front.no') }}</option>
            </select>
          </div>

          <div class="form-group">
            <label for="serviceType">{{ __('front.choose_main_service') }}</label>
            <select name="service_id" id="serviceType" required>
              <option value="" disabled {{ old('service_id') ? '' : 'selected' }}>{{ __('front.service') }}</option>
              @foreach($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                  {{ $locale == 'ar' ? $service->title_ar : $service->title_en }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="complaintDetails">{{ __('front.complaint_details') }}</label>
            <textarea name="complaint_details" id="complaintDetails" rows="5" placeholder="{{ __('front.complaint_details') }}" required>{{ old('complaint_details') }}</textarea>
          </div>

          <div class="form-upload-group">
            <label>{{ __('front.attach_complaint_copy') }} <span class="note">(png,jpg,jpeg,gif.)</span></label>
            <div class="upload-box">
              <input type="file" name="photo[]" multiple accept=".png,.jpg,.jpeg,.gif" required style="display: none;" id="photo-upload">
              <div class="upload-icon" onclick="document.getElementById('photo-upload').click()">📤</div>
              <p onclick="document.getElementById('photo-upload').click()">{{ __('front.drag_drop_files') }}</p>
              <small>{{ __('front.max_file_size') }}</small>
              <div id="photo-preview"></div>
            </div>
          </div>

          <div class="form-upload-group">
            <label>{{ __('front.other_attachments') }} <span class="note">({{ __('front.optional') }})</span> <span class="note">(png,jpg,jpeg,gif.)</span></label>
            <div class="upload-box">
              <input type="file" name="another_photo[]" multiple accept=".png,.jpg,.jpeg,.gif" style="display: none;" id="another-photo-upload">
              <div class="upload-icon" onclick="document.getElementById('another-photo-upload').click()">📤</div>
              <p onclick="document.getElementById('another-photo-upload').click()">{{ __('front.drag_drop_files') }}</p>
              <small>{{ __('front.max_file_size') }}</small>
              <div id="another-photo-preview"></div>
            </div>
          </div>

<div class="form-nav-buttons" style="display:flex; gap:10px; justify-content:center; margin-top:16px;">
  <button type="button"
          style="background:#fff; color:#076046; border:2px solid #076046; padding:9px 16px; border-radius:8px; cursor:pointer; font-size:14px; display:inline-flex; align-items:center; gap:6px;"
          onclick="prevStep(2)">
    → {{ __('front.previous') }}
  </button>
  <button type="button"
          style="background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;"
          onclick="nextStep(2)">
    {{ __('front.next') }} ←
  </button>
</div>

</div>

        
        <!-- Step 3: Detailed Address -->
        <div class="form-step" id="step3">
          <h4 class="address-form-heading">{{ __('front.detailed_address') }}</h4>
          
          <div class="form-group">
            <label for="region">{{ __('front.choose_region') }}</label>
            <select name="place_complaint_id" id="region" required>
              <option value="" disabled {{ old('place_complaint_id') ? '' : 'selected' }}>{{ __('front.choose_region') }}</option>
              @foreach($placeComplaints as $place)
                <option value="{{ $place->id }}" {{ old('place_complaint_id') == $place->id ? 'selected' : '' }}>
                  {{ $locale == 'ar' ? $place->name_ar : $place->name_en }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="addressDetails">{{ __('front.address_details') }}</label>
            <textarea name="address_details" id="addressDetails" rows="4" placeholder="{{ __('front.address_placeholder') }}">{{ old('address_details') }}</textarea>
          </div>

          <div class="form-group">
            <label>{{ __('front.location_coordinates') }}</label>
            <div class="coordinates-group">
              <input type="number" name="lat" step="any" placeholder="{{ __('front.latitude') }}" value="{{ old('lat') }}" required>
              <input type="number" name="lng" step="any" placeholder="{{ __('front.longitude') }}" value="{{ old('lng') }}" required>
              <button type="button" onclick="getCurrentLocation()" 
                    class="location-btn" 
                    style="background:#076046; color:#fff; border:none; padding:10px 18px; 
                           border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; 
                           display:inline-flex; align-items:center; gap:6px; transition:0.3s ease;">
              📍 {{ __('front.get_current_location') }}
            </button>

            </div>
          </div>

<div class="form-nav-buttons" style="display:flex; gap:10px; justify-content:center; margin-top:16px;">
  <button type="button"
          style="background:#fff; color:#076046; border:2px solid #076046; padding:9px 16px; border-radius:8px; cursor:pointer; font-size:14px; display:inline-flex; align-items:center; gap:6px;"
          onclick="prevStep(3)">
    → {{ __('front.previous') }}
  </button>
  <button type="submit"
          style="background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;">
    {{ __('front.submit_complaint') }} ←
  </button>
</div>

        </div>
        
      </form>
    </div>

    
  </div>
</section>

<section class="complaints-list-section">
  <div class="container">
    <ul class="complaints-tabs">
      <li class="tab-btn {{ request('status') == '' ? 'active' : '' }}" data-status="">{{ __('front.all_complaints') }}</li>
      <li class="tab-btn {{ request('status') == '4' ? 'active' : '' }}" data-status="4">{{ __('front.complaints_outside_jurisdiction') }}</li>
      <li class="tab-btn {{ request('status') == '2' ? 'active' : '' }}" data-status="2">{{ __('front.complaints_under_processing') }}</li>
      <li class="tab-btn {{ request('status') == '3' ? 'active' : '' }}" data-status="3">{{ __('front.resolved_complaints') }}</li>
    </ul>

    <div class="complaints-grid">
      @forelse($complaints as $complaint)
        <div class="complaint-card">
          <div class="status-dotd">
            <h3>{{ Str::limit($complaint->complaint_details, 50) }}</h3>
            <span class="status-dot 
              @if($complaint->status == 1) yellow
              @elseif($complaint->status == 2) blue  
              @elseif($complaint->status == 3) green
              @elseif($complaint->status == 4) orange
              @else red
              @endif"></span>
          </div>
          <p>{{ Str::limit($complaint->complaint_details, 100) }}</p>
          <div class="complaint-meta">
            <small>{{ __('front.complaint_number') }}: #{{ $complaint->number }}</small>
            <small>{{ $complaint->created_at->diffForHumans() }}</small>
          </div>
          <div class="card-actions">
            <a href="{{ route('complaints.show', $complaint->id) }}" class="follow-btn">{{ __('front.follow') }}</a>
            @if($complaint->hide_information == 2)
              <span class="submitter-name">{{ $complaint->name }}</span>
            @endif
          </div>
        </div>
      @empty
        <div class="no-complaints">
          <p>{{ __('front.no_complaints_found') }}</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<script>
(function () {
  let currentStep = 1;

  // ===== Helpers =====
  function isFieldFilled(input) {
    if (!input || input.disabled) return true;
    if (input.type === 'file') return !!(input.files && input.files.length > 0);
    if (input.tagName === 'SELECT') return !!(input.value && input.value !== '');
    return !!String(input.value || '').trim();
  }

  function $ (sel, root=document) { return root.querySelector(sel); }
  function $$ (sel, root=document) { return Array.from(root.querySelectorAll(sel)); }

  // ===== Progress Bar Coloring =====
  function setProgress(activeStep) {
    const progress = $('.form-progress');
    if (!progress) return;

    const circles = [
      $('#step1-circle'),
      $('#step2-circle'),
      $('#step3-circle')
    ].filter(Boolean);

    const labels = $$('.step .label', progress);
    // أي عنصر مباشر داخل .form-progress ليس .step نعتبره خط واصل
    const connectors = Array.from(progress.children).filter(el => !el.classList.contains('step'));

    circles.forEach((c, i) => {
      const stepIndex = i + 1;
      if (stepIndex < activeStep) {
        c.style.background = '#fff';
        c.style.color = '#076046';
        c.style.border = '2px solid #076046';
      } else if (stepIndex === activeStep) {
        c.style.background = '#076046';
        c.style.color = '#fff';
        c.style.border = 'none';
      } else {
        c.style.background = '#fff';
        c.style.color = '#555';
        c.style.border = '2px solid #ccc';
      }
    });

    labels.forEach((l, i) => {
      l.style.color = (i + 1 <= activeStep) ? '#076046' : '#555';
    });

    connectors.forEach((line, i) => {
      // الخط الذي يسبق الخطوة النشطة أو المكتملة يكون أخضر
      line.style.background = (i + 1 < activeStep) ? '#076046' : '#ccc';
      line.style.height = line.style.height || '2px';
      line.style.width  = line.style.width  || '60px';
    });
  }

  // ===== Steps Visibility =====
  function showOnlyActiveStep() {
    $$('.form-step').forEach(step => {
      step.style.display = step.classList.contains('active') ? 'block' : 'none';
    });
  }

  function goToStep(stepNum) {
    currentStep = stepNum;
    showOnlyActiveStep();
    setProgress(stepNum);
  }

  // ===== Step 1: control Next button visibility =====
  function isStep1Valid() {
    const step = $('#step1');
    if (!step) return false;
    const required = $$('#step1 input[required], #step1 select[required], #step1 textarea[required]');
    return required.every(isFieldFilled);
  }

  function refreshStep1NextBtn() {
    const btn = $('#nextBtn') || $('#step1 .next-btn');
    if (!btn) return;
    if (isStep1Valid()) {
      btn.style.display = 'inline-block';
      btn.style.width = '20%';
    } else {
      btn.style.display = 'none';
    }
  }

  // ===== Navigation (Next / Prev) with validation per step =====
  function validateCurrentStep(stepNum) {
    const stepEl = $('#step' + stepNum);
    if (!stepEl) return false;
    const req = $$('input[required], select[required], textarea[required]', stepEl);
    let ok = true;
    req.forEach(input => {
      const filled = isFieldFilled(input);
      if (!filled) {
        ok = false;
        input.style.borderColor = '#e74c3c';
      } else {
        input.style.borderColor = '';
      }
    });
    return ok;
  }

  window.nextStep = function (stepNum) {
    if (!validateCurrentStep(stepNum)) {
      alert('{{ __("front.please_fill_required_fields") }}');
      return;
    }
    const cur = $('#step' + stepNum);
    const nxt = $('#step' + (stepNum + 1));
    if (cur) cur.classList.remove('active');
    if (nxt) nxt.classList.add('active');
    goToStep(stepNum + 1);
  };

  window.prevStep = function (stepNum) {
    const cur = $('#step' + stepNum);
    const prv = $('#step' + (stepNum - 1));
    if (cur) cur.classList.remove('active');
    if (prv) prv.classList.add('active');
    goToStep(stepNum - 1);
  };

  // ===== Misc (scroll, location, file preview, tabs) =====
  window.scrollToForm = function () {
    const el = $('#complaint-form');
    if (el) el.scrollIntoView({ behavior: 'smooth' });
  };

  window.getCurrentLocation = function () {
    if (!navigator.geolocation) {
      alert('{{ __("front.geolocation_not_supported") }}');
      return;
    }
    navigator.geolocation.getCurrentPosition(function (pos) {
      const lat = $('input[name="lat"]');
      const lng = $('input[name="lng"]');
      if (lat) lat.value = pos.coords.latitude;
      if (lng) lng.value = pos.coords.longitude;
    });
  };

  function showFilePreview(files, previewId) {
    const preview = $('#' + previewId);
    if (!preview) return;
    preview.innerHTML = '';
    Array.from(files || []).forEach(file => {
      const row = document.createElement('div');
      row.textContent = file.name;
      row.style.padding = '5px';
      row.style.backgroundColor = '#f8f9fa';
      row.style.margin = '2px';
      row.style.borderRadius = '4px';
      preview.appendChild(row);
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    // إظهار الخطوة 1 فقط وتلوين الشريط
    goToStep(1);

    // مراقبة حقول الخطوة الأولى لإظهار زر "التالي"
    const step1Required = $$('#step1 input[required], #step1 select[required], #step1 textarea[required]');
    step1Required.forEach(el => {
      ['input','change','keyup','blur'].forEach(evt => el.addEventListener(evt, refreshStep1NextBtn));
    });
    // دعم الـ autofill
    refreshStep1NextBtn();
    setTimeout(refreshStep1NextBtn, 0);

    // ربط رفع الملفات للمعاينة
    const photo = $('#photo-upload');
    if (photo) photo.addEventListener('change', e => showFilePreview(e.target.files, 'photo-preview'));
    const another = $('#another-photo-upload');
    if (another) another.addEventListener('change', e => showFilePreview(e.target.files, 'another-photo-preview'));

    // تبويبات القائمة
    $$('.tab-btn').forEach(tab => {
      tab.addEventListener('click', function () {
        const status = this.getAttribute('data-status');
        const url = new URL(window.location);
        if (status) url.searchParams.set('status', status);
        else url.searchParams.delete('status');
        window.location.href = url.toString();
      });
    });
  });
})();
</script>

@endsection