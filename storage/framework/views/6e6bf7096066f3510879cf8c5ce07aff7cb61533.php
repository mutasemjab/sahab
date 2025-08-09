<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('services.index')); ?>"><?php echo e(__('front.services')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active"><?php echo e(__('front.service_details')); ?></a>
  </div>
</div>

<div class="permit-page">
  <div class="permit-header">
    <h2><?php echo e($locale == 'ar' ? $service->title_ar : $service->title_en); ?></h2>
    <p>
      <?php echo e($locale == 'ar' ? $service->description_ar : $service->description_en); ?>

    </p>
    <?php if($service->pdf): ?>
      <a href="<?php echo e(asset('storage/' . $service->pdf)); ?>" target="_blank" class="permit-link">📄 <?php echo e(__('front.service_level_agreement')); ?></a>
    <?php endif; ?>
  </div>

  <div class="permit-layout">

    <!-- العمود الرئيسي -->
    <div class="permit-content">
      <div class="tabs">
        <span class="tab active" onclick="showTab('steps')"><?php echo e(__('front.steps')); ?></span>
        <span class="tab" onclick="showTab('conditions')"><?php echo e(__('front.conditions')); ?></span>
        <span class="tab" onclick="showTab('documents')"><?php echo e(__('front.required_documents')); ?></span>
      </div>

      <?php if($service->serviceDetails && $service->serviceDetails->video): ?>
        <!-- فيديو / صورة -->
        <div class="video-preview">
          <iframe src="<?php echo e($service->serviceDetails->video); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
      <?php else: ?>
        <div class="video-preview">
          <div class="video-icon">▶️</div>
        </div>
      <?php endif; ?>

      <!-- Content Tabs -->
      <div id="steps-content" class="tab-content active">
        <?php if($service->serviceDetails): ?>
          <div class="service-description">
            <?php echo e($locale == 'ar' ? $service->serviceDetails->description_ar : $service->serviceDetails->description_en); ?>

          </div>
        <?php else: ?>
          <ol class="steps">
            <li><?php echo e(__('front.default_step_1')); ?></li>
            <li><?php echo e(__('front.default_step_2')); ?></li>
            <li><?php echo e(__('front.default_step_3')); ?></li>
            <li><?php echo e(__('front.default_step_4')); ?></li>
            <li><?php echo e(__('front.default_step_5')); ?></li>
            <li><?php echo e(__('front.default_step_6')); ?></li>
          </ol>
        <?php endif; ?>
      </div>

      <div id="conditions-content" class="tab-content">
        <?php if($service->serviceDetails && $service->serviceDetails->condition): ?>
          <div class="conditions-text">
            <?php echo nl2br(e($service->serviceDetails->condition)); ?>

          </div>
        <?php else: ?>
          <div class="conditions-text">
            <p><?php echo e(__('front.no_conditions_available')); ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div id="documents-content" class="tab-content">
        <?php if($service->serviceDetails && $service->serviceDetails->required_file): ?>
          <div class="documents-text">
            <?php echo nl2br(e($service->serviceDetails->required_file)); ?>

          </div>
        <?php else: ?>
          <div class="documents-text">
            <p><?php echo e(__('front.no_documents_specified')); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- العمود الأيسر -->
    <div class="permit-sidebar">
      <ul class="info-list">
        <li><span>👥</span> <?php echo e(__('front.target_audience')); ?>: <br> <strong><?php echo e($service->target_audience ?? __('front.all_citizens')); ?></strong></li>
        <li><span>⏱️</span> <?php echo e(__('front.service_duration')); ?>: <br> <strong><?php echo e($service->duration_service ?? __('front.not_specified')); ?></strong></li>
        <li><span>🖥️</span> <?php echo e(__('front.service_channels')); ?>: <br> <strong><?php echo e($service->service_channel ?? __('front.online')); ?></strong></li>
        <li><span>💰</span> <?php echo e(__('front.service_cost')); ?>: <br> <strong><?php echo e($service->service_cost ?? __('front.free')); ?></strong></li>
      </ul>

      <div class="faq-section">
        <h4><?php echo e(__('front.frequently_asked_questions')); ?></h4>
        <p><a href="#">📎 <?php echo e(__('front.ministry_faq_page')); ?></a></p>
        <p>📞 <?php echo e($setting->phone); ?></p>
        <p>📧 <?php echo e($setting->email); ?></p>
        <?php if($service->pdf): ?>
          <a href="<?php echo e(asset('assets/admin/uploads/' . $service->pdf)); ?>" download class="download-btn"><?php echo e(__('front.download_user_guide')); ?></a>
        <?php else: ?>
          <button class="download-btn" disabled><?php echo e(__('front.no_guide_available')); ?></button>
        <?php endif; ?>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/service-details.blade.php ENDPATH**/ ?>