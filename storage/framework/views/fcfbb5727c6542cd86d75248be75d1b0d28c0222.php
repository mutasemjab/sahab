<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('important-links.index')); ?>" class="active"><?php echo e(__('front.important_links')); ?></a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title"><?php echo e(__('front.important_links')); ?></h2>
    <p class="mutasem-subtitle"><?php echo e(__('front.important_links_subtitle')); ?></p>
  </div>
</section>



<section class="mutasem-orgs-wrapper" id="linksContainer">
  <?php $__empty_1 = true; $__currentLoopData = $groupedLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <div class="mutasem-orgs-group" data-group="<?php echo e($group['class']); ?>">
    <h3 class="mutasem-orgs-title"><?php echo e($group['title']); ?></h3>
    <div class="mutasem-orgs-grid">
      <?php $__currentLoopData = $group['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e($link->link); ?>" 
         class="mutasem-orgs-card" 
         <?php echo e($link->is_external ? 'target="_blank" rel="noopener noreferrer"' : ''); ?>

         data-link-id="<?php echo e($link->id); ?>">
        <div class="mutasem-orgs-icon">
          <?php echo $link->icon_html; ?>

        </div>
        <div class="mutasem-orgs-text">
          <h4><?php echo e($link->title); ?></h4>
          <p><?php echo e($link->description); ?></p>
        </div>
        <?php if($link->is_external): ?>
        <div class="external-link-indicator">
          <i class="fas fa-external-link-alt"></i>
        </div>
        <?php endif; ?>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div class="no-links">
    <div class="mutasem-container">
      <div class="no-links-content">
        <div class="no-links-icon">🔗</div>
        <h3><?php echo e(__('front.no_links_available')); ?></h3>
        <p><?php echo e(__('front.no_links_message')); ?></p>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/important-link.blade.php ENDPATH**/ ?>