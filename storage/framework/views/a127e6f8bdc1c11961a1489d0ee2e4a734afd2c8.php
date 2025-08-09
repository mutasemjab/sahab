<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('services.index')); ?>" class="active"><?php echo e(__('front.services')); ?></a>
  </div>
</div>

<section class="municipal-services">
  <h2 class="section-title"><?php echo e(__('front.municipal_services')); ?></h2>
  <p class="section-desc">
    <?php echo e(__('front.municipal_services_description')); ?>

  </p>
</section>

<section class="service-cards">
  <h3 class="cards-title"><?php echo e(__('front.municipal_services')); ?></h3>
  <div class="cards-grid">
    <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="card">
      <div class="service-icon">
                         <i class="<?php echo e($service->icon); ?>"></i>
       </div>
        <h4><?php echo e($locale == 'ar' ? $service->title_ar : $service->title_en); ?></h4>
        <p><?php echo Str::limit($locale == 'ar' ? $service->description_ar : $service->description_en, 80); ?></p>
        <a href="<?php echo e(route('services.show', $service->id)); ?>"><?php echo e(__('front.learn_more')); ?> ←</a>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="no-services">
        <p><?php echo e(__('front.no_services_available')); ?></p>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="service-request">
  <div class="request-box">
    <h3><?php echo e(__('front.submit_service_request')); ?></h3>
    
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
    
    <form action="<?php echo e(route('services.form.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label><?php echo e(__('front.service_type')); ?></label>
        <select name="service_id" required>
          <option value="" selected disabled><?php echo e(__('front.choose_service')); ?></option>
          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id') == $service->id ? 'selected' : ''); ?>>
              <?php echo e($locale == 'ar' ? $service->title_ar : $service->title_en); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="form-group">
        <label><?php echo e(__('front.full_name')); ?></label>
        <input type="text" name="name" placeholder="<?php echo e(__('front.full_name')); ?>" value="<?php echo e(old('name')); ?>" required />
      </div>

      <div class="form-group">
        <label><?php echo e(__('front.email_address')); ?></label>
        <input type="email" name="email" placeholder="<?php echo e(__('front.email_address')); ?>" value="<?php echo e(old('email')); ?>" required />
      </div>

      <div class="form-group">
        <label><?php echo e(__('front.request_details')); ?></label>
        <textarea name="message" placeholder="<?php echo e(__('front.request_details')); ?>" required><?php echo e(old('message')); ?></textarea>
      </div>

      <button type="submit" class="submit-btn"><?php echo e(__('front.submit_request')); ?></button>
    </form>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/services.blade.php ENDPATH**/ ?>