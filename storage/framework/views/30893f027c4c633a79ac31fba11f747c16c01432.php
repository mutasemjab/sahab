<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('complaints.index')); ?>" class="active"><?php echo e(__('front.complaints')); ?></a>
  </div>
</div>

<section class="complaint-section">
  <div class="container">
    <h2 class="section-title"><?php echo e(__('front.complaints')); ?></h2>
    <p class="section-subtitle">
      <?php echo e(__('front.complaint_description')); ?>

    </p>
    <div class="complaint-buttons">
      <a href="#complaint-form" class="submit-btn" onclick="scrollToForm()">
        <i class="icon">+</i>
        <?php echo e(__('front.submit_complaint')); ?>

      </a>
      <?php if($setting && $setting->video): ?>
        <a href="<?php echo e($setting->video); ?>" target="_blank" class="video-btn">
          <i class="icon">◀</i>
          <?php echo e(__('front.watch_video')); ?>

        </a>
      <?php endif; ?>
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
      <h4><?php echo e(__('front.fill_form')); ?></h4>
      <p><?php echo e(__('front.provide_detailed_info_complaint')); ?></p>
    </div>
    
    <!-- Submit -->
    <div class="mutasem-guideline-box">
      <div class="mutasem-guideline-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
          <path d="M22 2 11 13" />
          <path d="m22 2-7 20-4-9-9-4 20-7z" />
        </svg>
      </div>
      <h4><?php echo e(__('front.submit')); ?></h4>
      <p><?php echo e(__('front.review_by_team_complaint')); ?></p>
    </div>
    
    <!-- Follow Up -->
    <div class="mutasem-guideline-box">
      <div class="mutasem-guideline-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
          <circle cx="12" cy="12" r="10" />
          <path d="M12 6v6l4 2" />
        </svg>
      </div>
      <h4><?php echo e(__('front.follow_up')); ?></h4>
      <p><?php echo e(__('front.track_submission_status')); ?></p>
    </div>
    
  </div>
</section>

<section class="suggestion-form-section" id="complaint-form">
  <div class="container">
    <h3 class="form-title"><?php echo e(__('front.submit_complaint_request')); ?></h3>
    
    <?php if(session('success')): ?>
      <div class="alert alert-success">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>
    
    <div class="form-progress">
      <div class="step">
        <div class="circle active" id="step1-circle">1</div>
        <div class="label"><?php echo e(__('front.personal_information')); ?></div>
      </div>
      <div class="step">
        <div class="circle" id="step2-circle">2</div>
        <div class="label"><?php echo e(__('front.complaint_information')); ?></div>
      </div>
      <div class="step">
        <div class="circle" id="step3-circle">3</div>
        <div class="label"><?php echo e(__('front.detailed_address')); ?></div>
      </div>
    </div>
    
    <div class="form-box">
      <form id="complaint-form-main" action="<?php echo e(route('complaints.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <!-- Step 1: Personal Information -->
        <div class="form-step active" id="step1">
          <h4 class="form-heading"><?php echo e(__('front.personal_information')); ?></h4>
          <p class="form-alert">
            <span class="icon">ℹ️</span>
            <?php echo e(__('front.data_privacy_notice')); ?>

          </p>
          
          <div class="form-group">
            <label><?php echo e(__('front.full_name')); ?></label>
            <input type="text" name="name" placeholder="<?php echo e(__('front.full_name')); ?>" value="<?php echo e(old('name')); ?>" required>
          </div>
          
          <div class="form-group">
            <label><?php echo e(__('front.contact_number')); ?></label>
            <input type="text" name="phone" placeholder="<?php echo e(__('front.contact_number')); ?>" value="<?php echo e(old('phone')); ?>" required>
          </div>
          
          <div class="form-group">
            <label><?php echo e(__('front.choose_age')); ?></label>
            <select name="age" required>
              <option value="" disabled <?php echo e(old('age') ? '' : 'selected'); ?>><?php echo e(__('front.choose_age')); ?></option>
              <option value="18-25" <?php echo e(old('age') == '18-25' ? 'selected' : ''); ?>>18-25</option>
              <option value="26-35" <?php echo e(old('age') == '26-35' ? 'selected' : ''); ?>>26-35</option>
              <option value="36-45" <?php echo e(old('age') == '36-45' ? 'selected' : ''); ?>>36-45</option>
              <option value="46-55" <?php echo e(old('age') == '46-55' ? 'selected' : ''); ?>>46-55</option>
              <option value="56-65" <?php echo e(old('age') == '56-65' ? 'selected' : ''); ?>>56-65</option>
              <option value="65+" <?php echo e(old('age') == '65+' ? 'selected' : ''); ?>>65+</option>
            </select>
          </div>
          
          <div class="form-group">
            <label><?php echo e(__('front.gender')); ?></label>
            <select name="gender" required>
              <option value="" disabled <?php echo e(old('gender') ? '' : 'selected'); ?>><?php echo e(__('front.choose_gender')); ?></option>
              <option value="1" <?php echo e(old('gender') == '1' ? 'selected' : ''); ?>><?php echo e(__('front.male')); ?></option>
              <option value="2" <?php echo e(old('gender') == '2' ? 'selected' : ''); ?>><?php echo e(__('front.female')); ?></option>
            </select>
          </div>

          <div class="form-group">
            <label><?php echo e(__('front.hide_personal_info')); ?></label>
            <select name="hide_information" required>
              <option value="" disabled <?php echo e(old('hide_information') ? '' : 'selected'); ?>><?php echo e(__('front.choose_option')); ?></option>
              <option value="1" <?php echo e(old('hide_information') == '1' ? 'selected' : ''); ?>><?php echo e(__('front.yes_hide')); ?></option>
              <option value="2" <?php echo e(old('hide_information') == '2' ? 'selected' : ''); ?>><?php echo e(__('front.no_show')); ?></option>
            </select>
          </div>
          
          <button type="button" class="next-btn" onclick="nextStep(1)"><?php echo e(__('front.next')); ?> ←</button>
        </div>
        
        <!-- Step 2: Complaint Information -->
        <div class="form-step" id="step2">
          <h4 class="complaint-form-heading"><?php echo e(__('front.complaint_information')); ?></h4>
          
          <div class="form-group">
            <label for="isUrgent"><?php echo e(__('front.is_complaint_urgent')); ?></label>
            <select name="is_complaint_emergency" id="isUrgent" required>
              <option value="" disabled <?php echo e(old('is_complaint_emergency') ? '' : 'selected'); ?>><?php echo e(__('front.choose')); ?></option>
              <option value="1" <?php echo e(old('is_complaint_emergency') == '1' ? 'selected' : ''); ?>><?php echo e(__('front.yes')); ?></option>
              <option value="2" <?php echo e(old('is_complaint_emergency') == '2' ? 'selected' : ''); ?>><?php echo e(__('front.no')); ?></option>
            </select>
          </div>

          <div class="form-group">
            <label for="serviceType"><?php echo e(__('front.choose_main_service')); ?></label>
            <select name="service_id" id="serviceType" required>
              <option value="" disabled <?php echo e(old('service_id') ? '' : 'selected'); ?>><?php echo e(__('front.service')); ?></option>
              <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id') == $service->id ? 'selected' : ''); ?>>
                  <?php echo e($locale == 'ar' ? $service->title_ar : $service->title_en); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="form-group">
            <label for="complaintDetails"><?php echo e(__('front.complaint_details')); ?></label>
            <textarea name="complaint_details" id="complaintDetails" rows="5" placeholder="<?php echo e(__('front.complaint_details')); ?>" required><?php echo e(old('complaint_details')); ?></textarea>
          </div>

          <div class="form-upload-group">
            <label><?php echo e(__('front.attach_complaint_copy')); ?> <span class="note">(png,jpg,jpeg,gif.)</span></label>
            <div class="upload-box">
              <input type="file" name="photo[]" multiple accept=".png,.jpg,.jpeg,.gif" required style="display: none;" id="photo-upload">
              <div class="upload-icon" onclick="document.getElementById('photo-upload').click()">📤</div>
              <p onclick="document.getElementById('photo-upload').click()"><?php echo e(__('front.drag_drop_files')); ?></p>
              <small><?php echo e(__('front.max_file_size')); ?></small>
              <div id="photo-preview"></div>
            </div>
          </div>

          <div class="form-upload-group">
            <label><?php echo e(__('front.other_attachments')); ?> <span class="note">(<?php echo e(__('front.optional')); ?>)</span> <span class="note">(png,jpg,jpeg,gif.)</span></label>
            <div class="upload-box">
              <input type="file" name="another_photo[]" multiple accept=".png,.jpg,.jpeg,.gif" style="display: none;" id="another-photo-upload">
              <div class="upload-icon" onclick="document.getElementById('another-photo-upload').click()">📤</div>
              <p onclick="document.getElementById('another-photo-upload').click()"><?php echo e(__('front.drag_drop_files')); ?></p>
              <small><?php echo e(__('front.max_file_size')); ?></small>
              <div id="another-photo-preview"></div>
            </div>
          </div>

          <div class="form-nav-buttons">
            <button type="button" class="btn-secondary" onclick="prevStep(2)">→ <?php echo e(__('front.previous')); ?></button>
            <button type="button" class="btn-primary" onclick="nextStep(2)"><?php echo e(__('front.next')); ?> ←</button>
          </div>
        </div>
        
        <!-- Step 3: Detailed Address -->
        <div class="form-step" id="step3">
          <h4 class="address-form-heading"><?php echo e(__('front.detailed_address')); ?></h4>
          
          <div class="form-group">
            <label for="region"><?php echo e(__('front.choose_region')); ?></label>
            <select name="place_complaint_id" id="region" required>
              <option value="" disabled <?php echo e(old('place_complaint_id') ? '' : 'selected'); ?>><?php echo e(__('front.choose_region')); ?></option>
              <?php $__currentLoopData = $placeComplaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($place->id); ?>" <?php echo e(old('place_complaint_id') == $place->id ? 'selected' : ''); ?>>
                  <?php echo e($locale == 'ar' ? $place->name_ar : $place->name_en); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="form-group">
            <label for="addressDetails"><?php echo e(__('front.address_details')); ?></label>
            <textarea name="address_details" id="addressDetails" rows="4" placeholder="<?php echo e(__('front.address_placeholder')); ?>"><?php echo e(old('address_details')); ?></textarea>
          </div>

          <div class="form-group">
            <label><?php echo e(__('front.location_coordinates')); ?></label>
            <div class="coordinates-group">
              <input type="number" name="lat" step="any" placeholder="<?php echo e(__('front.latitude')); ?>" value="<?php echo e(old('lat')); ?>" required>
              <input type="number" name="lng" step="any" placeholder="<?php echo e(__('front.longitude')); ?>" value="<?php echo e(old('lng')); ?>" required>
              <button type="button" onclick="getCurrentLocation()" class="location-btn"><?php echo e(__('front.get_current_location')); ?></button>
            </div>
          </div>

          <div class="form-nav-buttons">
            <button type="button" class="btn-secondary" onclick="prevStep(3)">→ <?php echo e(__('front.previous')); ?></button>
            <button type="submit" class="btn-primary"><?php echo e(__('front.submit_complaint')); ?> ←</button>
          </div>
        </div>
        
      </form>
    </div>

    
  </div>
</section>

<section class="complaints-list-section">
  <div class="container">
    <ul class="complaints-tabs">
      <li class="tab-btn <?php echo e(request('status') == '' ? 'active' : ''); ?>" data-status=""><?php echo e(__('front.all_complaints')); ?></li>
      <li class="tab-btn <?php echo e(request('status') == '4' ? 'active' : ''); ?>" data-status="4"><?php echo e(__('front.complaints_outside_jurisdiction')); ?></li>
      <li class="tab-btn <?php echo e(request('status') == '2' ? 'active' : ''); ?>" data-status="2"><?php echo e(__('front.complaints_under_processing')); ?></li>
      <li class="tab-btn <?php echo e(request('status') == '3' ? 'active' : ''); ?>" data-status="3"><?php echo e(__('front.resolved_complaints')); ?></li>
    </ul>

    <div class="complaints-grid">
      <?php $__empty_1 = true; $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="complaint-card">
          <div class="status-dotd">
            <h3><?php echo e(Str::limit($complaint->complaint_details, 50)); ?></h3>
            <span class="status-dot 
              <?php if($complaint->status == 1): ?> yellow
              <?php elseif($complaint->status == 2): ?> blue  
              <?php elseif($complaint->status == 3): ?> green
              <?php elseif($complaint->status == 4): ?> orange
              <?php else: ?> red
              <?php endif; ?>"></span>
          </div>
          <p><?php echo e(Str::limit($complaint->complaint_details, 100)); ?></p>
          <div class="complaint-meta">
            <small><?php echo e(__('front.complaint_number')); ?>: #<?php echo e($complaint->number); ?></small>
            <small><?php echo e($complaint->created_at->diffForHumans()); ?></small>
          </div>
          <div class="card-actions">
            <a href="<?php echo e(route('complaints.show', $complaint->id)); ?>" class="follow-btn"><?php echo e(__('front.follow')); ?></a>
            <?php if($complaint->hide_information == 2): ?>
              <span class="submitter-name"><?php echo e($complaint->name); ?></span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="no-complaints">
          <p><?php echo e(__('front.no_complaints_found')); ?></p>
        </div>
      <?php endif; ?>
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
        alert('<?php echo e(__("front.please_fill_required_fields")); ?>');
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
        alert('<?php echo e(__("front.geolocation_not_supported")); ?>');
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/complaints.blade.php ENDPATH**/ ?>