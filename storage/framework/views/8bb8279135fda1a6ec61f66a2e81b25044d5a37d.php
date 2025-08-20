

<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('newListen.index')); ?>" class="active"><?php echo e(__('front.listen_sessions')); ?></a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title"><?php echo e(__('front.listen_sessions')); ?></h2>
  </div>
</section>

<section class="news-section">
  <div class="projects-grid">
    <?php $__empty_1 = true; $__currentLoopData = $newListens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newListen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="project-card">
      <div class="project-image">
        <img src="<?php echo e($newListen->photo_url); ?>" alt="<?php echo e($newListen->title); ?>">
      </div>
      <div class="project-content">
        <h3><?php echo e($newListen->title); ?></h3>
        <p><?php echo e(Str::limit($newListen->description, 100)); ?></p>
        <a href="<?php echo e(route('newListen.show', $newListen->id)); ?>" class="project-link">
         <?php echo e(__('front.read_more')); ?>

         <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="no-data">
      <p><?php echo e(__('front.listen_sessions')); ?></p>
    </div>
    <?php endif; ?>
  </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/newListens.blade.php ENDPATH**/ ?>