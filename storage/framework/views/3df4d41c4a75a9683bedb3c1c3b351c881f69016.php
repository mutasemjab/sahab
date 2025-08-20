<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('contact.index')); ?>" class="active"><?php echo e(__('front.contact_us')); ?></a>
  </div>
</div>

<section class="municipal-services">
  <h2 class="section-title">اتصل بنا</h2>
  <p class="section-desc">
    نحن هنا للمساعدة والإجابة على أي اسئلة قد تكون لديك
  </p>
</section>

<section class="contact-section">
  <div class="container contact-grid">
    <div class="contact-form">
      <h3><?php echo e(__('front.send_us_message')); ?></h3>
      
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

      <form action="<?php echo e(route('contact.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label><?php echo e(__('front.full_name')); ?></label>
        <input type="text" name="name" placeholder="<?php echo e(__('front.your_full_name')); ?>" value="<?php echo e(old('name')); ?>" required />
        
        <label><?php echo e(__('front.email_address')); ?></label>
        <input type="email" name="email" placeholder="<?php echo e(__('front.email_placeholder')); ?>" value="<?php echo e(old('email')); ?>" required />
        
        <label><?php echo e(__('front.subject')); ?></label>
        <input type="text" name="subject" placeholder="<?php echo e(__('front.subject_placeholder')); ?>" value="<?php echo e(old('subject')); ?>" required />
        
        <label><?php echo e(__('front.message')); ?></label>
        <textarea name="message" placeholder="<?php echo e(__('front.message_placeholder')); ?>" rows="5" required><?php echo e(old('message')); ?></textarea>
        
        <button type="submit"><?php echo e(__('front.send_message')); ?></button>
      </form>
    </div>
    
    <div class="contact-info">
      <h3><?php echo e(__('front.contact_information')); ?></h3>
      <?php if($setting): ?>
        <p><i class="fas fa-map-marker-alt"></i> <?php echo e(__('front.address')); ?>: <?php echo e($locale == 'ar' ? $setting->address_ar : $setting->address_en); ?></p>
        <p><i class="fas fa-phone-alt"></i> <?php echo e(__('front.phone')); ?>: <?php echo e($setting->phone); ?></p>
        <p><i class="fas fa-envelope"></i> <?php echo e(__('front.email')); ?>: <?php echo e($setting->email); ?></p>
      <?php endif; ?>
      
      <h3><?php echo e(__('front.our_location')); ?></h3>
     <div class="map-container">
        <?php if($setting && $setting->google_map): ?>
            <?php
                $fixedUrl = str_replace('https://maps.google.com/embed', 'https://www.google.com/maps/embed', $setting->google_map);
            ?>
            <iframe 
                src="<?php echo e($fixedUrl); ?>"
                width="100%" 
                height="250" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        <?php endif; ?>
    </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/contactUs.blade.php ENDPATH**/ ?>