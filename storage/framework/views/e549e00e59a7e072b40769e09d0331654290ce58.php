<?php $__env->startSection('content'); ?>

<div class="mutasem-error-page">
  <h1 class="mutasem-error-code">404</h1>
  <h2 class="mutasem-error-title">حدث خطأ ما</h2>
  <p class="mutasem-error-text">عذرًا، لا يمكننا العثور على الصفحة التي تبحث عنها.</p>
  <a href="<?php echo e(route('home')); ?>" class="mutasem-error-button">العودة إلى الصفحة الرئيسية</a>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/not-found.blade.php ENDPATH**/ ?>