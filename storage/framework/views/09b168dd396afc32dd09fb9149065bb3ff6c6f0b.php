

<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('newListen.index')); ?>" class="active"><?php echo e(__('front.listen_sessions')); ?></a>
  </div>
</div>


 <div class="project-content">
    <h3><?php echo e($newListen->title); ?></h3>
    <p><?php echo e($newListen->description); ?></p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/newListensDetails.blade.php ENDPATH**/ ?>