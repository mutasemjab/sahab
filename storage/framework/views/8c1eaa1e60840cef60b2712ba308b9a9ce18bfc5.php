<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('wbsiteTenders.index')); ?>" class="active"><?php echo e(__('front.tenders_bids')); ?></a>
  </div>
</div>

<section class="tenders-page">
  <div class="tenders-header">
    <h2><?php echo e(__('front.tenders_bids')); ?></h2>
    <p><?php echo e(__('front.tenders_description')); ?></p>
  </div>

  <div class="tenders-filters">
    <div class="filters-right">
      <form method="GET" id="filter-form">
        <input type="search" name="search" class="tenders-search" placeholder="<?php echo e(__('front.search_tenders')); ?>" value="<?php echo e(request('search')); ?>">
        <select name="category" class="tenders-category" onchange="document.getElementById('filter-form').submit()">
          <option value=""><?php echo e(__('front.all_categories')); ?></option>
          <!-- Add categories when needed -->
        </select>
      </form>
    </div>
    <div class="filters-left">
      <select name="sort" onchange="updateSort(this.value)" class="filter-sort">
        <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>><?php echo e(__('front.newest_first')); ?></option>
        <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>><?php echo e(__('front.oldest_first')); ?></option>
        <option value="closing_soon" <?php echo e(request('sort') == 'closing_soon' ? 'selected' : ''); ?>><?php echo e(__('front.closing_soon')); ?></option>
        <option value="value_high" <?php echo e(request('sort') == 'value_high' ? 'selected' : ''); ?>><?php echo e(__('front.highest_value')); ?></option>
        <option value="value_low" <?php echo e(request('sort') == 'value_low' ? 'selected' : ''); ?>><?php echo e(__('front.lowest_value')); ?></option>
      </select>
    </div>
  </div>

  <?php $__empty_1 = true; $__currentLoopData = $tenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="tender-box">
      <div class="tender-header">
        <span class="tender-category"><?php echo e(__('front.tender_category')); ?></span>
        <h3 class="tender-title"><?php echo e(app()->getLocale() == 'ar' ? $tender->title_ar : $tender->title_en); ?></h3>
        <p class="tender-desc"><?php echo e(Str::limit(app()->getLocale() == 'ar' ? $tender->description_ar : $tender->description_en, 100)); ?></p>
      </div>

      <div class="tender-details-grid">
        <div class="tender-item">
          <span class="tender-label"><?php echo e(__('front.reference_number')); ?></span>
          <span class="tender-value"><?php echo e($tender->number); ?></span>
        </div>
        <div class="tender-item">
          <span class="tender-label"><?php echo e(__('front.value')); ?></span>
          <span class="tender-value"><?php echo e($tender->cost); ?></span>
        </div>
        <div class="tender-item">
          <span class="tender-label"><?php echo e(__('front.publish_date')); ?></span>
          <span class="tender-value"><?php echo e(Carbon\Carbon::parse($tender->date_publish)->locale('ar')->translatedFormat('j F Y')); ?></span>
        </div>
        <div class="tender-item">
          <span class="tender-label"><?php echo e(__('front.closing_date')); ?></span>
          <span class="tender-value tender-close-date 
            <?php if(Carbon\Carbon::parse($tender->date_close)->isPast()): ?> expired
            <?php elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7): ?> urgent
            <?php endif; ?>">
            <?php echo e(Carbon\Carbon::parse($tender->date_close)->locale('ar')->translatedFormat('j F Y')); ?>

            <?php if(Carbon\Carbon::parse($tender->date_close)->isPast()): ?>
              <small>(<?php echo e(__('front.expired')); ?>)</small>
            <?php elseif(Carbon\Carbon::parse($tender->date_close)->diffInDays() <= 7): ?>
              <small>(<?php echo e(__('front.closing_soon')); ?>)</small>
            <?php endif; ?>
          </span>
        </div>
        <div class="tender-item">
          <a href="<?php echo e(route('wbsiteTenders.show', $tender->id)); ?>" class="tender-btn"><?php echo e(__('front.details')); ?></a>
        </div>
      </div>

      <div class="tender-footer">
        <?php if($tender->pdf): ?>
          <a href="<?php echo e(route('tenders.download', $tender->id)); ?>" class="tender-download">
            <i class="fa fa-download"></i> <?php echo e(__('front.download_documents')); ?>

          </a>
        <?php endif; ?>
        <?php if($tender->pdf_file && count(json_decode($tender->pdf_file)) > 0): ?>
          <a href="<?php echo e(route('tenders.download-files', $tender->id)); ?>" class="tender-download">
            <i class="fa fa-download"></i> <?php echo e(__('front.download_files')); ?>

          </a>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="no-tenders">
      <p><?php echo e(__('front.no_tenders_found')); ?></p>
    </div>
  <?php endif; ?>

  <?php if($tenders->hasPages()): ?>
    <div class="tender-pagination-wrapper">
      <div class="tender-pagination-info">
        <?php echo e(__('front.showing')); ?> <?php echo e($tenders->firstItem()); ?>-<?php echo e($tenders->lastItem()); ?> <?php echo e(__('front.of')); ?> <?php echo e($tenders->total()); ?> <?php echo e(__('front.results')); ?>

      </div>
      <div class="tender-pagination">
        <?php if($tenders->hasMorePages()): ?>
          <a href="<?php echo e($tenders->nextPageUrl()); ?>" class="tender-page"><?php echo e(__('front.next')); ?></a>
        <?php endif; ?>
        
        <?php $__currentLoopData = $tenders->getUrlRange(max(1, $tenders->currentPage() - 2), min($tenders->lastPage(), $tenders->currentPage() + 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e($url); ?>" class="tender-page <?php echo e($page == $tenders->currentPage() ? 'active' : ''); ?>"><?php echo e($page); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($tenders->onFirstPage() == false): ?>
          <a href="<?php echo e($tenders->previousPageUrl()); ?>" class="tender-page"><?php echo e(__('front.previous')); ?></a>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</section>

<section class="guidelines-section">
  <h2 class="guidelines-title"><?php echo e(__('front.submission_guidelines')); ?></h2>
  
  <div class="guideline-item">
    <div class="guideline-icon">
      <span class="icon-guideline">📝</span>
    </div>
    <div class="guideline-text">
      <h4 class="guideline-heading"><?php echo e(__('front.required_documents')); ?></h4>
      <p class="guideline-description">
        <?php echo e(__('front.required_documents_description')); ?>

      </p>
    </div>
  </div>

  <div class="guideline-item">
    <div class="guideline-icon">
      <span class="icon-guideline">🕒</span>
    </div>
    <div class="guideline-text">
      <h4 class="guideline-heading"><?php echo e(__('front.final_submission_deadline')); ?></h4>
      <p class="guideline-description">
        <?php echo e(__('front.submission_deadline_description')); ?>

      </p>
    </div>
  </div>

  <div class="guideline-item">
    <div class="guideline-icon">
      <span class="icon-guideline">✅</span>
    </div>
    <div class="guideline-text">
      <h4 class="guideline-heading"><?php echo e(__('front.compliance')); ?></h4>
      <p class="guideline-description">
        <?php echo e(__('front.compliance_description')); ?>

      </p>
    </div>
  </div>
</section>

<script>
function updateSort(sortValue) {
  const url = new URL(window.location);
  url.searchParams.set('sort', sortValue);
  window.location.href = url.toString();
}

// Auto-submit search form on input
document.querySelector('.tenders-search').addEventListener('input', function() {
  setTimeout(() => {
    document.getElementById('filter-form').submit();
  }, 500);
});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/tenders.blade.php ENDPATH**/ ?>