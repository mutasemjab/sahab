<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('suggestions.index')); ?>" class="active"><?php echo e(__('front.suggest_initiative')); ?></a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title"><?php echo e(__('front.suggest_initiative')); ?></h2>
    <p class="mutasem-subtitle"><?php echo e(__('front.appreciate_initiatives')); ?></p>
  </div>
</section>

<section class="mutasem-propose-guidelines">
    <h2 class="mutasem-title">ارشادات التقديم</h2>
  <div class="mutasem-container mutasem-guideline-grid">
    
    <!-- Fill Form -->
<div class="mutasem-guideline-box" style="text-align:center;">
  <div class="mutasem-guideline-icon" 
       style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" 
         viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
      <path d="M12 20h9" />
      <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
    </svg>
  </div>
  <h4 style="margin:8px 0; font-size:16px; font-weight:600; color:#333;">
    <?php echo e(__('front.fill_form')); ?>

  </h4>
  <p style="font-size:14px; color:#555; margin:0;">
    <?php echo e(__('front.provide_detailed_info')); ?>

  </p>
</div>

    
<!-- Submit -->
<div class="mutasem-guideline-box" style="text-align:center;">
  <div class="mutasem-guideline-icon" 
       style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" 
         viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
      <path d="M22 2 11 13" />
      <path d="m22 2-7 20-4-9-9-4 20-7z" />
    </svg>
  </div>
  <h4 style="margin:8px 0; font-size:16px; font-weight:600; color:#333;">
    <?php echo e(__('front.submit')); ?>

  </h4>
  <p style="font-size:14px; color:#555; margin:0;">
    <?php echo e(__('front.review_by_team')); ?>

  </p>
</div>

<!-- Follow Up -->
<div class="mutasem-guideline-box" style="text-align:center;">
  <div class="mutasem-guideline-icon" 
       style="background-color:#076046; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" 
         viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
      <circle cx="12" cy="12" r="10" />
      <path d="M12 6v6l4 2" />
    </svg>
  </div>
  <h4 style="margin:8px 0; font-size:16px; font-weight:600; color:#333;">
    <?php echo e(__('front.follow_up')); ?>

  </h4>
  <p style="font-size:14px; color:#555; margin:0;">
    <?php echo e(__('front.track_submission_status')); ?>

  </p>
</div>

    
  </div>
</section>

<section class="suggestion-form-section">
  <div class="container">
    <h3 class="form-title"><?php echo e(__('front.submit_suggestion_request')); ?></h3>
    
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
    
 <div class="form-progress" style="display:flex; align-items:center; justify-content:center; gap:30px;">

  <!-- Step 1 -->
  <div class="step" style="display:flex; flex-direction:column; align-items:center;">
    <div id="step1-circle"
         style="width:30px; height:30px; border-radius:50%; background:#076046; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">
      1
    </div>
    <div class="label" style="margin-top:6px; font-size:14px; color:#076046;">
      <?php echo e(__('front.personal_information')); ?>

    </div>
  </div>

  <!-- الخط -->
  <div style="width:60px; height:2px; background:#ccc;"></div>

  <!-- Step 2 -->
  <div class="step" style="display:flex; flex-direction:column; align-items:center;">
    <div id="step2-circle"
         style="width:30px; height:30px; border-radius:50%; background:#fff; color:#555; border:2px solid #ccc; display:flex; align-items:center; justify-content:center; font-weight:bold;">
      2
    </div>
    <div class="label" style="margin-top:6px; font-size:14px; color:#555;">
      <?php echo e(__('front.suggestion_information')); ?>

    </div>
  </div>

</div>

    
    <div class="form-box">
      <form id="suggestion-form" action="<?php echo e(route('suggestions.store')); ?>" method="POST">
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
          
                    <div class="form-group" style="margin-top:8px;">
              <label style="display:flex; align-items:center; gap:8px;">
                <input type="checkbox" name="hide_identity" value="1" style="width:16px; height:16px;">
                <?php echo e(__('front.hide_my_identity')); ?>

              </label>
            </div>
          
<div style="text-align:center; margin-top:16px;">
  <button type="button" id="nextBtn" class="next-btn"
          style="display:none; background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;width: 15%"
          onclick="goNext()">
    <?php echo e(__('front.next')); ?> ←
  </button>
</div>


        </div>
        
        <!-- Step 2: Suggestion Information -->
<div class="form-step" id="step2">
  <h4 class="form-heading"><?php echo e(__('front.suggestion_information')); ?></h4>

  
  <div class="form-group">
    <label><?php echo e(__('front.category')); ?></label>
    <select name="category" required>
      <option value="" disabled <?php echo e(old('category') ? '' : 'selected'); ?>><?php echo e(__('front.choose_category')); ?></option>
      <option value="1" <?php echo e(old('category') == '1' ? 'selected' : ''); ?>><?php echo e(__('front.category_1')); ?></option>
      <option value="2" <?php echo e(old('category') == '2' ? 'selected' : ''); ?>><?php echo e(__('front.category_2')); ?></option>
      <option value="3" <?php echo e(old('category') == '3' ? 'selected' : ''); ?>><?php echo e(__('front.category_3')); ?></option>
    </select>
  </div>

  
  <div class="form-group">
    <label><?php echo e(__('front.subject')); ?></label>
    <input type="text" name="subject" placeholder="<?php echo e(__('front.subject')); ?>" value="<?php echo e(old('subject')); ?>" required>
  </div>

  
  <div class="form-group">
    <label><?php echo e(__('front.description')); ?></label>
    <textarea name="note" placeholder="<?php echo e(__('front.describe_suggestion')); ?>" rows="6" required><?php echo e(old('note')); ?></textarea>
  </div>

  
  <div class="form-group">
    <label style="display:block; margin-bottom:8px;">
      <?php echo e(__('front.attach_primary_complaint')); ?> <span style="color:#777;">(png, jpg, jpeg, gif)</span>
    </label>

    <div id="dropArea"
         style="border:2px dashed #cbd5d1; background:#fafafa; border-radius:10px; padding:20px; text-align:center; cursor:pointer;">
      <div style="font-size:28px; line-height:1; color:#9aa2a6;">☁️</div>
      <div style="margin-top:6px; color:#333;"><?php echo e(__('front.drag_drop_or_click')); ?></div>
      <div style="margin-top:4px; color:#888; font-size:12px;"><?php echo e(__('front.max_file_size')); ?>: 10MB</div>
      <input id="fileInput" name="attachments[]" type="file" multiple accept=".png,.jpg,.jpeg,.gif"
             style="display:none;">
    </div>

    <div id="fileList" style="margin-top:10px; font-size:13px; color:#444;"></div>
  </div>


<div class="form-buttons" style="display:flex; gap:10px; justify-content:center; margin-top:16px;">
  <button type="button" class="prev-btn"
          style="background:#fff; color:#076046; border:2px solid #076046; padding:9px 16px; border-radius:8px; cursor:pointer; font-size:14px; display:inline-flex; align-items:center; gap:6px;"
          onclick="goPrev()">
    ← <?php echo e(__('front.previous')); ?>

  </button>
  <button type="submit" class="submit-btn"
          style="background:#076046; color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; font-size:14px;width: 20%">
    <?php echo e(__('front.submit_suggestion')); ?>

  </button>
</div>

</div>

        
      </form>
    </div>
    
    
  </div>
</section>
<script>
(function () {
  const stepEl = {
    1: document.getElementById('step1'),
    2: document.getElementById('step2')
  };
  const circleEl = {
    1: document.getElementById('step1-circle'),
    2: document.getElementById('step2-circle')
  };
  const labelEl = {
    1: document.querySelector('.form-progress .step:nth-child(1) .label'),
    2: document.querySelector('.form-progress .step:nth-child(3) .label') // بعد عنصر الخط
  };

  function setProgress(activeStep) {
    if (activeStep === 1) {
      // دائرة 1 خضراء
      circleEl[1].style.background = '#076046';
      circleEl[1].style.color = '#fff';
      circleEl[1].style.border = 'none';
      if (labelEl[1]) labelEl[1].style.color = '#076046';

      // دائرة 2 بيضاء
      circleEl[2].style.background = '#fff';
      circleEl[2].style.color = '#555';
      circleEl[2].style.border = '2px solid #ccc';
      if (labelEl[2]) labelEl[2].style.color = '#555';
    } else {
      // دائرة 1 "تم"
      circleEl[1].style.background = '#fff';
      circleEl[1].style.color = '#076046';
      circleEl[1].style.border = '2px solid #076046';
      if (labelEl[1]) labelEl[1].style.color = '#555';

      // دائرة 2 خضراء
      circleEl[2].style.background = '#076046';
      circleEl[2].style.color = '#fff';
      circleEl[2].style.border = 'none';
      if (labelEl[2]) labelEl[2].style.color = '#076046';
    }
  }

  function show(stepNum) {
    stepEl[1].style.display = (stepNum === 1 ? 'block' : 'none');
    stepEl[2].style.display = (stepNum === 2 ? 'block' : 'none');
    setProgress(stepNum);
  }

  function isStep1Valid() {
    const name   = document.querySelector('#step1 input[name="name"]');
    const phone  = document.querySelector('#step1 input[name="phone"]');
    const age    = document.querySelector('#step1 select[name="age"]');
    const gender = document.querySelector('#step1 select[name="gender"]');
    return !!(name?.value.trim() && phone?.value.trim() && age?.value && gender?.value);
  }

  function refreshNextBtn() {
    const btn = document.getElementById('nextBtn');
    if (!btn) return;
    btn.style.display = isStep1Valid() ? 'inline-block' : 'none';
  }

  // نجعل الدوال متاحة للزرار
  window.goNext = function () {
    if (!isStep1Valid()) {
      alert('<?php echo e(__("front.please_fill_required_fields")); ?>');
      return;
    }
    stepEl[1].classList.remove('active');
    stepEl[2].classList.add('active');
    show(2);
  };

  window.goPrev = function () {
    stepEl[2].classList.remove('active');
    stepEl[1].classList.add('active');
    show(1);
  };

  document.addEventListener('DOMContentLoaded', function () {
    // اعرض الخطوة الأولى فقط
    show(1);

    // اربط الأحداث على الخانات المطلوبة لإظهار/إخفاء زر "التالي"
    document.querySelectorAll('#step1 input[required], #step1 select[required]').forEach(el => {
      ['input','change','keyup','blur'].forEach(evt => el.addEventListener(evt, refreshNextBtn));
    });

    // دعم الأوتوفيل
    refreshNextBtn();
    setTimeout(refreshNextBtn, 0);

  });
})();
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/suggest.blade.php ENDPATH**/ ?>