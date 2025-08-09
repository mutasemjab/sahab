@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{route('suggestions.index')}}" class="active">{{ __('front.suggestions') }}</a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title">{{ __('front.help_us_improve_services') }}</h2>
    <p class="mutasem-subtitle">{{ __('front.we_value_your_initiatives') }}</p>
  </div>
</section>

<section class="suggestion-form-section-white">
  <div class="container">
    <h3 class="form-title">{{ __('front.send_feedback_request') }}</h3>
    
    <div class="form-progress">
      <div class="step" data-step="1">
        <div class="circle active">1</div>
        <div class="label">{{ __('front.personal_information') }}</div>
      </div>
      <div class="step" data-step="2">
        <div class="circle">2</div>
        <div class="label">{{ __('front.service_evaluation') }}</div>
      </div>
      <div class="step" data-step="3">
        <div class="circle">3</div>
        <div class="label">{{ __('front.detailed_feedback') }}</div>
      </div>
    </div>

    <form id="suggestionForm" action="{{ route('helpus.store') }}" method="POST">
      @csrf
      
      <!-- Step 1: Personal Information -->
      <div class="form-box step-content" id="step1">
        <h4 class="form-heading">{{ __('front.personal_information') }}</h4>
        <p class="form-alert">
          <span class="icon">ℹ️</span>
          {{ __('front.privacy_notice') }}
        </p>
        
        <div class="form-group">
          <label>{{ __('front.full_name') }}</label>
          <input type="text" name="name" placeholder="{{ __('front.full_name') }}" required value="{{ old('name') }}">
          @error('name')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.contact_number') }}</label>
          <input type="text" name="phone" placeholder="{{ __('front.contact_number') }}" required value="{{ old('phone') }}">
          @error('phone')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.choose_age') }}</label>
          <select name="age" required>
            <option selected disabled>{{ __('front.choose_age') }}</option>
            <option value="18-25" {{ old('age') == '18-25' ? 'selected' : '' }}>18-25</option>
            <option value="26-35" {{ old('age') == '26-35' ? 'selected' : '' }}>26-35</option>
            <option value="36-45" {{ old('age') == '36-45' ? 'selected' : '' }}>36-45</option>
            <option value="46-55" {{ old('age') == '46-55' ? 'selected' : '' }}>46-55</option>
            <option value="56+" {{ old('age') == '56+' ? 'selected' : '' }}>56+</option>
          </select>
          @error('age')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.gender') }}</label>
          <select name="gender" required>
            <option selected disabled>{{ __('front.choose_gender') }}</option>
            <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>{{ __('front.male') }}</option>
            <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>{{ __('front.female') }}</option>
          </select>
          @error('gender')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>
            <input type="checkbox" name="hide_information" value="1" {{ old('hide_information') ? 'checked' : '' }}>
            {{ __('front.hide_personal_information') }}
          </label>
        </div>

        <button type="button" class="next-btn" onclick="nextStep(2)">{{ __('front.next') }} ←</button>
      </div>

      <!-- Step 2: Service Evaluation -->
      <div class="form-box step-content" id="step2" style="display: none;">
        <h4 class="form-heading">{{ __('front.service_evaluation') }}</h4>
        
        <div class="form-group">
          <label>{{ __('front.choose_service_department') }}</label>
          <select name="service_id" required>
            <option selected disabled>{{ __('front.choose_service') }}</option>
            @foreach($services as $service)
              <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                {{$locale == 'ar' ? $service->title_ar :  $service->title_en }}
              </option>
            @endforeach
          </select>
          @error('service_id')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.satisfaction_rating') }}</label>
          <div class="form-radio-horizontal">
            <label><input type="radio" name="opinion" value="1" {{ old('opinion') == '1' ? 'checked' : '' }}> {{ __('front.very_unsatisfied') }}</label>
            <label><input type="radio" name="opinion" value="2" {{ old('opinion') == '2' ? 'checked' : '' }}> {{ __('front.unsatisfied') }}</label>
            <label><input type="radio" name="opinion" value="3" {{ old('opinion') == '3' ? 'checked' : '' }}> {{ __('front.neutral') }}</label>
            <label><input type="radio" name="opinion" value="4" {{ old('opinion') == '4' ? 'checked' : '' }}> {{ __('front.satisfied') }}</label>
            <label><input type="radio" name="opinion" value="5" {{ old('opinion') == '5' ? 'checked' : '' }}> {{ __('front.very_satisfied') }}</label>
          </div>
          @error('opinion')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.additional_question') }}</label>
          <input type="text" name="question" placeholder="{{ __('front.question_placeholder') }}" required value="{{ old('question') }}">
          @error('question')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.service_usage_frequency') }}</label>
          <div class="form-radio-vertical">
            <label><input type="radio" name="how_much_use_this_service" value="1" {{ old('how_much_use_this_service') == '1' ? 'checked' : '' }}> {{ __('front.weekly') }}</label>
            <label><input type="radio" name="how_much_use_this_service" value="2" {{ old('how_much_use_this_service') == '2' ? 'checked' : '' }}> {{ __('front.monthly') }}</label>
            <label><input type="radio" name="how_much_use_this_service" value="3" {{ old('how_much_use_this_service') == '3' ? 'checked' : '' }}> {{ __('front.quarterly') }}</label>
            <label><input type="radio" name="how_much_use_this_service" value="4" {{ old('how_much_use_this_service') == '4' ? 'checked' : '' }}> {{ __('front.yearly') }}</label>
          </div>
          @error('how_much_use_this_service')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>{{ __('front.accessibility_needs') }}</label>
          <div class="form-checkbox-list">
            <label><input type="checkbox" name="Do_you_need_accessibility[]" value="1" {{ in_array('1', old('Do_you_need_accessibility', [])) ? 'checked' : '' }}> {{ __('front.screen_reader_support') }}</label>
            <label><input type="checkbox" name="Do_you_need_accessibility[]" value="2" {{ in_array('2', old('Do_you_need_accessibility', [])) ? 'checked' : '' }}> {{ __('front.large_text') }}</label>
            <label><input type="checkbox" name="Do_you_need_accessibility[]" value="3" {{ in_array('3', old('Do_you_need_accessibility', [])) ? 'checked' : '' }}> {{ __('front.color_contrast') }}</label>
            <label><input type="checkbox" name="Do_you_need_accessibility[]" value="4" {{ in_array('4', old('Do_you_need_accessibility', [])) ? 'checked' : '' }}> {{ __('front.no_accessibility_needed') }}</label>
          </div>
          @error('Do_you_need_accessibility')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-nav-buttons">
          <button type="button" class="btn-secondary" onclick="previousStep(1)">→ {{ __('front.previous') }}</button>
          <button type="button" class="btn-primary" onclick="nextStep(3)">{{ __('front.next') }} ←</button>
        </div>
      </div>

      <!-- Step 3: Detailed Feedback -->
      <div class="form-box step-content" id="step3" style="display: none;">
        <h4 class="form-heading">{{ __('front.detailed_feedback') }}</h4>
        
        <div class="form-group">
          <label for="note">{{ __('front.additional_feedback_question') }}</label>
          <textarea id="note" name="note" rows="5" placeholder="{{ __('front.share_your_thoughts') }}">{{ old('note') }}</textarea>
          @error('note')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-nav-buttons">
          <button type="button" class="btn-secondary" onclick="previousStep(2)">→ {{ __('front.previous') }}</button>
          <button type="submit" class="btn-primary">{{ __('front.submit') }} ←</button>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
function nextStep(step) {
  // Validate current step before proceeding
  if (step === 2) {
    if (!validateStep1()) return;
  } else if (step === 3) {
    if (!validateStep2()) return;
  }

  // Hide all steps
  document.querySelectorAll('.step-content').forEach(el => el.style.display = 'none');
  
  // Show target step
  document.getElementById('step' + step).style.display = 'block';
  
  // Update progress indicators
  updateProgress(step);
}

function previousStep(step) {
  // Hide all steps
  document.querySelectorAll('.step-content').forEach(el => el.style.display = 'none');
  
  // Show target step
  document.getElementById('step' + step).style.display = 'block';
  
  // Update progress indicators
  updateProgress(step);
}

function updateProgress(currentStep) {
  document.querySelectorAll('.step').forEach((step, index) => {
    const circle = step.querySelector('.circle');
    const stepNumber = index + 1;
    
    if (stepNumber < currentStep) {
      circle.classList.remove('active');
      circle.classList.add('done');
    } else if (stepNumber === currentStep) {
      circle.classList.remove('done');
      circle.classList.add('active');
    } else {
      circle.classList.remove('active', 'done');
    }
  });
}

function validateStep1() {
  const name = document.querySelector('input[name="name"]').value;
  const phone = document.querySelector('input[name="phone"]').value;
  const age = document.querySelector('select[name="age"]').value;
  const gender = document.querySelector('select[name="gender"]').value;
  
  if (!name || !phone || !age || !gender) {
    alert('{{ __("front.please_fill_required_fields") }}');
    return false;
  }
  return true;
}

function validateStep2() {
  const service = document.querySelector('select[name="service_id"]').value;
  const opinion = document.querySelector('input[name="opinion"]:checked');
  const question = document.querySelector('input[name="question"]').value;
  const usage = document.querySelector('input[name="how_much_use_this_service"]:checked');
  const accessibility = document.querySelectorAll('input[name="Do_you_need_accessibility[]"]:checked');
  
  if (!service || !opinion || !question || !usage || accessibility.length === 0) {
    alert('{{ __("front.please_fill_required_fields") }}');
    return false;
  }
  return true;
}

// Handle accessibility checkbox exclusivity
document.addEventListener('DOMContentLoaded', function() {
  const accessibilityCheckboxes = document.querySelectorAll('input[name="Do_you_need_accessibility[]"]');
  const noNeedCheckbox = document.querySelector('input[name="Do_you_need_accessibility[]"][value="4"]');
  
  accessibilityCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      if (this.value === '4' && this.checked) {
        // Uncheck all other checkboxes if "no need" is checked
        accessibilityCheckboxes.forEach(cb => {
          if (cb.value !== '4') cb.checked = false;
        });
      } else if (this.checked && this.value !== '4') {
        // Uncheck "no need" if any other checkbox is checked
        noNeedCheckbox.checked = false;
      }
    });
  });
});
</script>

@endsection