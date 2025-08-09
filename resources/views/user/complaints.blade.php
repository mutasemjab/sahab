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
  <div class="mutasem-container mutasem-guideline-grid">
    
    <!-- Fill Form -->
    <div class="mutasem-guideline-box">
      <div class="mutasem-guideline-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
          <path d="M12 20h9" />
          <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
        </svg>
      </div>
      <h4>{{ __('front.fill_form') }}</h4>
      <p>{{ __('front.provide_detailed_info_complaint') }}</p>
    </div>
    
    <!-- Submit -->
    <div class="mutasem-guideline-box">
      <div class="mutasem-guideline-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
          <path d="M22 2 11 13" />
          <path d="m22 2-7 20-4-9-9-4 20-7z" />
        </svg>
      </div>
      <h4>{{ __('front.submit') }}</h4>
      <p>{{ __('front.review_by_team_complaint') }}</p>
    </div>
    
    <!-- Follow Up -->
    <div class="mutasem-guideline-box">
      <div class="mutasem-guideline-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
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
    
    <div class="form-progress">
      <div class="step">
        <div class="circle active" id="step1-circle">1</div>
        <div class="label">{{ __('front.personal_information') }}</div>
      </div>
      <div class="step">
        <div class="circle" id="step2-circle">2</div>
        <div class="label">{{ __('front.complaint_information') }}</div>
      </div>
      <div class="step">
        <div class="circle" id="step3-circle">3</div>
        <div class="label">{{ __('front.detailed_address') }}</div>
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
          
          <button type="button" class="next-btn" onclick="nextStep(1)">{{ __('front.next') }} ←</button>
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

          <div class="form-nav-buttons">
            <button type="button" class="btn-secondary" onclick="prevStep(2)">→ {{ __('front.previous') }}</button>
            <button type="button" class="btn-primary" onclick="nextStep(2)">{{ __('front.next') }} ←</button>
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
              <button type="button" onclick="getCurrentLocation()" class="location-btn">{{ __('front.get_current_location') }}</button>
            </div>
          </div>

          <div class="form-nav-buttons">
            <button type="button" class="btn-secondary" onclick="prevStep(3)">→ {{ __('front.previous') }}</button>
            <button type="submit" class="btn-primary">{{ __('front.submit_complaint') }} ←</button>
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
let currentStep = 1;

function nextStep(step) {
    // Validate current step
    const currentStepElement = document.getElementById(`step${step}`);
    const requiredInputs = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    requiredInputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.style.borderColor = '#e74c3c';
        } else {
            input.style.borderColor = '';
        }
    });
    
    if (!isValid) {
        alert('{{ __("front.please_fill_required_fields") }}');
        return;
    }
    
    // Move to next step
    document.getElementById(`step${step}`).classList.remove('active');
    document.getElementById(`step${step + 1}`).classList.add('active');
    document.getElementById(`step${step}-circle`).classList.remove('active');
    document.getElementById(`step${step}-circle`).classList.add('done');
    document.getElementById(`step${step + 1}-circle`).classList.add('active');
    currentStep = step + 1;
    updateStepVisibility();
}

function prevStep(step) {
    // Move to previous step
    document.getElementById(`step${step}`).classList.remove('active');
    document.getElementById(`step${step - 1}`).classList.add('active');
    document.getElementById(`step${step}-circle`).classList.remove('active');
    document.getElementById(`step${step - 1}-circle`).classList.remove('done');
    document.getElementById(`step${step - 1}-circle`).classList.add('active');
    currentStep = step - 1;
    updateStepVisibility();
}

function updateStepVisibility() {
    const steps = document.querySelectorAll('.form-step');
    steps.forEach((step, index) => {
        if (step.classList.contains('active')) {
            step.style.display = 'block';
        } else {
            step.style.display = 'none';
        }
    });
}

function scrollToForm() {
    document.getElementById('complaint-form').scrollIntoView({
        behavior: 'smooth'
    });
}

function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.querySelector('input[name="lat"]').value = position.coords.latitude;
            document.querySelector('input[name="lng"]').value = position.coords.longitude;
        });
    } else {
        alert('{{ __("front.geolocation_not_supported") }}');
    }
}

// File upload preview
document.getElementById('photo-upload').addEventListener('change', function(e) {
    showFilePreview(e.target.files, 'photo-preview');
});

document.getElementById('another-photo-upload').addEventListener('change', function(e) {
    showFilePreview(e.target.files, 'another-photo-preview');
});

function showFilePreview(files, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    
    Array.from(files).forEach(file => {
        const div = document.createElement('div');
        div.textContent = file.name;
        div.style.padding = '5px';
        div.style.backgroundColor = '#f8f9fa';
        div.style.margin = '2px';
        div.style.borderRadius = '4px';
        preview.appendChild(div);
    });
}

// Tab functionality
document.querySelectorAll('.tab-btn').forEach(tab => {
    tab.addEventListener('click', function() {
        const status = this.getAttribute('data-status');
        const url = new URL(window.location);
        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }
        window.location.href = url.toString();
    });
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateStepVisibility();
});
</script>

@endsection