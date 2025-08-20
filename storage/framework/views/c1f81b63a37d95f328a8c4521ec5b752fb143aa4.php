<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('complaints.index')); ?>"><?php echo e(__('front.complaints')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active"><?php echo e(__('front.complaint_details')); ?></a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
  <h2 class="section-title"><?php echo e(__('front.complaint_details')); ?></h2>
  <p class="section-subtitle">
    <?php echo e(__('front.complaint_summary_description')); ?>

  </p>
  </div>
</section>

<section class="complaints-summary-section">


  <div class="filters-bar">
    <div class="filters-tabs">
      <button class="tab-filter <?php echo e(request('status') == '' ? 'active' : ''); ?>" data-status=""><?php echo e(__('front.all_complaints')); ?></button>
      <button class="tab-filter <?php echo e(request('status') == '1' ? 'active' : ''); ?>" data-status="1"><?php echo e(__('front.unprocessed_complaints')); ?></button>
      <button class="tab-filter <?php echo e(request('status') == '3' ? 'active' : ''); ?>" data-status="3"><?php echo e(__('front.resolved_complaints')); ?></button>
      <button class="tab-filter <?php echo e(request('status') == '4' ? 'active' : ''); ?>" data-status="4"><?php echo e(__('front.complaints_outside_jurisdiction')); ?></button>
    </div>

    <div class="filters-controls">
      <form method="GET" id="filter-form">
        <select name="service_id" onchange="submitFilter()">
          <option value=""><?php echo e(__('front.all_categories')); ?></option>
          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($service->id); ?>" <?php echo e(request('service_id') == $service->id ? 'selected' : ''); ?>>
              <?php echo e($locale == 'ar' ? $service->title_ar : $service->title_en); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="date_range" onchange="submitFilter()">
          <option value="30" <?php echo e(request('date_range') == '30' ? 'selected' : ''); ?>><?php echo e(__('front.last_30_days')); ?></option>
          <option value="7" <?php echo e(request('date_range') == '7' ? 'selected' : ''); ?>><?php echo e(__('front.last_7_days')); ?></option>
          <option value="month" <?php echo e(request('date_range') == 'month' ? 'selected' : ''); ?>><?php echo e(__('front.this_month')); ?></option>
        </select>

        <input type="text" name="search" placeholder="<?php echo e(__('front.search_complaints')); ?>" value="<?php echo e(request('search')); ?>">
        <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
        <button type="submit" class="btn-search"><?php echo e(__('front.search')); ?></button>
      </form>
    </div>
  </div>

  <div class="complaints-list">
    <?php $__empty_1 = true; $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="complaint-card">
        <div class="status-dot 
          <?php if($complaint->status == 1): ?> red
          <?php elseif($complaint->status == 2): ?> orange  
          <?php elseif($complaint->status == 3): ?> green
          <?php elseif($complaint->status == 4): ?> black
          <?php else: ?> red
          <?php endif; ?>"></div>
        <div class="complaint-info">
          <h4><?php echo e(Str::limit($complaint->complaint_details, 60)); ?></h4>
          <p><?php echo e(Str::limit($complaint->complaint_details, 120)); ?></p>
          <span class="date"><?php echo e($complaint->created_at->format('Y-m-d')); ?></span>
          <div class="complaint-meta-info">
            <small><strong><?php echo e(__('front.complaint_number')); ?>:</strong> #<?php echo e($complaint->number); ?></small>
            <small><strong><?php echo e(__('front.service')); ?>:</strong> <?php echo e($locale == 'ar' ? $complaint->service->title_ar : $complaint->service->title_en); ?></small>
            <?php if($complaint->is_complaint_emergency == 1): ?>
              <span class="emergency-tag"><?php echo e(__('front.emergency')); ?></span>
            <?php endif; ?>
          </div>
        </div>
        <a href="<?php echo e(route('complaint-details-two', $complaint->id)); ?>" class="btn-details"><?php echo e(__('front.view_details')); ?></a>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="no-complaints">
        <p><?php echo e(__('front.no_complaints_found')); ?></p>
      </div>
    <?php endif; ?>
  </div>

  <?php if($complaints->hasPages()): ?>
    <div class="nav-buttons">
      <?php if($complaints->onFirstPage()): ?>
        <button class="btn-secondary" disabled>→ <?php echo e(__('front.previous')); ?></button>
      <?php else: ?>
        <a href="<?php echo e($complaints->previousPageUrl()); ?>" class="btn-secondary">→ <?php echo e(__('front.previous')); ?></a>
      <?php endif; ?>
      
      <?php if($complaints->hasMorePages()): ?>
        <a href="<?php echo e($complaints->nextPageUrl()); ?>" class="btn-primary"><?php echo e(__('front.next')); ?> ←</a>
      <?php else: ?>
        <button class="btn-primary" disabled><?php echo e(__('front.next')); ?> ←</button>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</section>

<script>
// Tab filtering
document.querySelectorAll('.tab-filter').forEach(tab => {
    tab.addEventListener('click', function() {
        const status = this.getAttribute('data-status');
        const form = document.getElementById('filter-form');
        const statusInput = form.querySelector('input[name="status"]');
        statusInput.value = status;
        form.submit();
    });
});

function submitFilter() {
    document.getElementById('filter-form').submit();
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/complaints-details.blade.php ENDPATH**/ ?>