<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('wbsiteTenders.index')); ?>"><?php echo e(__('front.tenders_bids')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active"><?php echo e(__('front.tender_details')); ?></a>
  </div>
</div>

<section class="section-project-details">
  <div class="project-details-wrapper">
    <div class="project-main-content">
      <h2 class="project-title"><?php echo e(app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en); ?></h2>
      <p class="project-description">
        <?php echo e(app()->getLocale() == 'ar' ? $tender->description_ar : $tender->description_en); ?>

      </p>
      <?php if($tender->pdf): ?>
        <a href="<?php echo e(route('tenders.download', $tender->id)); ?>" class="agreement-link"><?php echo e(__('front.tender_agreement')); ?></a>
      <?php endif; ?>

      <div class="project-tabs">
        <span class="tab active" onclick="showTab('steps')"><?php echo e(__('front.steps')); ?></span>
        <span class="tab" onclick="showTab('documents')"><?php echo e(__('front.required_documents')); ?></span>
        <span class="tab" onclick="showTab('conditions')"><?php echo e(__('front.conditions')); ?></span>
      </div>

      <?php if($tender->tenderDetails && $tender->tenderDetails->video): ?>
        <div class="project-video-box">
          <iframe src="<?php echo e($tender->tenderDetails->video); ?>" frameborder="0" allowfullscreen style="width: 100%; height: 300px; border-radius: 8px;"></iframe>
        </div>
      <?php else: ?>
        <div class="project-video-box">
          <div class="video-placeholder">
            <span class="video-icon">▶</span>
          </div>
        </div>
      <?php endif; ?>

      <!-- Content Tabs -->
      <div id="steps-content" class="tab-content active">
        <?php if($tender->tenderDetails && $tender->tenderDetails->description_ar): ?>
          <div class="tender-description">
            <?php echo e(app()->getLocale() == 'ar' ? $tender->tenderDetails->description_ar : $tender->tenderDetails->description_en); ?>

          </div>
        <?php else: ?>
          <ul class="project-steps-list">
            <li><?php echo e(__('front.tender_step_1')); ?></li>
            <li><?php echo e(__('front.tender_step_2')); ?></li>
            <li><?php echo e(__('front.tender_step_3')); ?></li>
            <li><?php echo e(__('front.tender_step_4')); ?></li>
            <li><?php echo e(__('front.tender_step_5')); ?></li>
            <li><?php echo e(__('front.tender_step_6')); ?></li>
            <li><?php echo e(__('front.tender_step_7')); ?></li>
          </ul>
        <?php endif; ?>
      </div>

      <div id="documents-content" class="tab-content">
        <?php if($tender->tenderDetails && $tender->tenderDetails->required_file): ?>
          <div class="documents-text">
            <?php echo nl2br(e($tender->tenderDetails->required_file)); ?>

          </div>
        <?php else: ?>
          <div class="documents-text">
            <p><?php echo e(__('front.no_documents_specified')); ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div id="conditions-content" class="tab-content">
        <?php if($tender->tenderDetails && $tender->tenderDetails->condition): ?>
          <div class="conditions-text">
            <?php echo nl2br(e($tender->tenderDetails->condition)); ?>

          </div>
        <?php else: ?>
          <div class="conditions-text">
            <p><?php echo e(__('front.no_conditions_available')); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <aside class="project-sidebar-box">
      <div class="sidebar-item">
        <div class="project-label"><?php echo e(__('front.reference_number')); ?>:</div>
        <div class="project-value"><?php echo e($tender->number); ?></div>
      </div>
      
      <div class="sidebar-item">
        <div class="project-label"><?php echo e(__('front.value')); ?></div>
        <div class="project-value"><?php echo e($tender->cost); ?></div>
      </div>
      
      <div class="sidebar-item">
        <div class="project-label"><?php echo e(__('front.publish_date')); ?></div>
        <div class="project-value"><?php echo e(Carbon\Carbon::parse($tender->date_publish)->format('d M Y')); ?></div>
      </div>
      
      <div class="sidebar-item">
        <div class="project-label"><?php echo e(__('front.closing_date')); ?></div>
        <div class="project-value closing-date 
          <?php if(Carbon\Carbon::parse($tender->date_close)->isPast()): ?> expired
          <?php elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7): ?> urgent
          <?php endif; ?>">
          <?php echo e(Carbon\Carbon::parse($tender->date_close)->format('d M Y')); ?>

          <?php if(Carbon\Carbon::parse($tender->date_close)->isPast()): ?>
            <br><small style="color: #dc3545;">(<?php echo e(__('front.expired')); ?>)</small>
          <?php elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7): ?>
            <br><small style="color: #fd7e14;">(<?php echo e(Carbon\Carbon::parse($tender->date_close)->diffInDays()); ?> <?php echo e(__('front.days_left')); ?>)</small>
          <?php endif; ?>
        </div>
      </div>

      <?php if($tender->photo): ?>
        <div class="sidebar-item">
          <img src="<?php echo e(asset('storage/' . $tender->photo)); ?>" alt="<?php echo e(app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en); ?>" style="width: 100%; border-radius: 8px; margin: 1rem 0;">
        </div>
      <?php endif; ?>
      
      <?php if($tender->pdf): ?>
        <div class="sidebar-item download-docs">
          <a href="<?php echo e(route('tenders.download', $tender->id)); ?>" class="download-link"><?php echo e(__('front.download_documents')); ?></a>
        </div>
      <?php endif; ?>

      <?php if($tender->pdf_file && count(json_decode($tender->pdf_file)) > 0): ?>
        <div class="sidebar-item download-docs">
          <a href="<?php echo e(route('tenders.download-files', $tender->id)); ?>" class="download-link"><?php echo e(__('front.download_additional_files')); ?></a>
        </div>
      <?php endif; ?>
      
      <div class="sidebar-item faq-link">
        <a href="#"><?php echo e(__('front.ministry_faq_page')); ?></a>
      </div>
      
      <div class="sidebar-item contact-phone">
        <div class="project-label"><?php echo e(__('front.phone')); ?></div>
        <div class="project-value"><?php echo e($setting->phone); ?></div>
      </div>  
      
      <div class="sidebar-item contact-email">
        <div class="project-label"><?php echo e(__('front.email')); ?></div>
        <div class="project-value"><?php echo e($setting->email); ?></div>
      </div>
      
      <div class="sidebar-item download-guide">
        <?php if($tender->pdf): ?>
          <a href="<?php echo e(route('tenders.download', $tender->id)); ?>" class="btn-guide"><?php echo e(__('front.download_user_guide')); ?></a>
        <?php else: ?>
          <button class="btn-guide" disabled><?php echo e(__('front.no_guide_available')); ?></button>
        <?php endif; ?>
      </div>

      <div class="sidebar-item back-to-tenders">
        <a href="<?php echo e(route('wbsiteTenders.index')); ?>" class="btn-back"><?php echo e(__('front.back_to_tenders')); ?></a>
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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/tenders-details.blade.php ENDPATH**/ ?>