@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{route('suggestions.index')}}" class="active">{{ __('front.suggest_initiative') }}</a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title">{{ __('front.suggest_initiative') }}</h2>
    <p class="mutasem-subtitle">{{ __('front.appreciate_initiatives') }}</p>
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
      <p>{{ __('front.provide_detailed_info') }}</p>
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
      <p>{{ __('front.review_by_team') }}</p>
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

<section class="suggestion-form-section">
  <div class="container">
    <h3 class="form-title">{{ __('front.submit_suggestion_request') }}</h3>
    
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
        <div class="label">{{ __('front.suggestion_information') }}</div>
      </div>
    </div>
    
    <div class="form-box">
      <form id="suggestion-form" action="{{ route('suggestions.store') }}" method="POST">
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
          
          <button type="button" class="next-btn" onclick="nextStep()">{{ __('front.next') }} ←</button>
        </div>
        
        <!-- Step 2: Suggestion Information -->
        <div class="form-step" id="step2">
          <h4 class="form-heading">{{ __('front.suggestion_information') }}</h4>
          
          <div class="form-group">
            <label>{{ __('front.suggestion_details') }}</label>
            <textarea name="note" placeholder="{{ __('front.describe_suggestion') }}" rows="6" required>{{ old('note') }}</textarea>
          </div>
          
          <div class="form-group">
            <label>{{ __('front.hide_personal_info') }}</label>
            <select name="hide_information" required>
              <option value="" disabled {{ old('hide_information') ? '' : 'selected' }}>{{ __('front.choose_option') }}</option>
              <option value="1" {{ old('hide_information') == '1' ? 'selected' : '' }}>{{ __('front.yes_hide') }}</option>
              <option value="2" {{ old('hide_information') == '2' ? 'selected' : '' }}>{{ __('front.no_show') }}</option>
            </select>
          </div>
          
          <div class="form-buttons">
            <button type="button" class="prev-btn" onclick="prevStep()">← {{ __('front.previous') }}</button>
            <button type="submit" class="submit-btn">{{ __('front.submit_suggestion') }}</button>
          </div>
        </div>
        
      </form>
    </div>
    
    
  </div>
</section>

<script>
let currentStep = 1;

function nextStep() {
    // Validate current step
    const step1Inputs = document.querySelectorAll('#step1 input[required], #step1 select[required]');
    let isValid = true;
    
    step1Inputs.forEach(input => {
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
    
    // Move to step 2
    document.getElementById('step1').classList.remove('active');
    document.getElementById('step2').classList.add('active');
    document.getElementById('step1-circle').classList.remove('active');
    document.getElementById('step1-circle').classList.add('done');
    document.getElementById('step2-circle').classList.add('active');
    currentStep = 2;
}

function prevStep() {
    // Move to step 1
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step1').classList.add('active');
    document.getElementById('step2-circle').classList.remove('active');
    document.getElementById('step1-circle').classList.remove('done');
    document.getElementById('step1-circle').classList.add('active');
    currentStep = 1;
}

// Show only active step
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.form-step');
    steps.forEach((step, index) => {
        if (index !== 0) {
            step.style.display = 'none';
        }
    });
});

// Handle step visibility
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

// Update visibility when moving between steps
document.querySelectorAll('.next-btn, .prev-btn').forEach(btn => {
    btn.addEventListener('click', updateStepVisibility);
});
</script>

@endsection