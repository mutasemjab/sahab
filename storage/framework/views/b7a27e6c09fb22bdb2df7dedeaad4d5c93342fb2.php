<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('about')); ?>" class="active"><?php echo e(__('front.about_sahab')); ?></a>
  </div>
</div>


<section class="about-sahab-section">
  <div class="about-sahab-container">
    <div class="about-sahab-content">
      <h2><?php echo e(__('front.about_sahab_municipality')); ?></h2>
      <?php if($about): ?>
        <p>
          <?php echo e($locale == 'ar' ? $about->description_ar : $about->description_en); ?>

        </p>
      <?php endif; ?>

      <div class="about-stats">
        <div class="stat-box">
          <strong>+100,000</strong>
          <span><?php echo e(__('front.population')); ?></span>
        </div>
        <div class="stat-box">
          <strong>150 <?php echo e(__('front.km2')); ?></strong>
          <span><?php echo e(__('front.area')); ?></span>
        </div>
        <div class="stat-box">
          <strong>12</strong>
          <span><?php echo e(__('front.regions')); ?></span>
        </div>
        <div class="stat-box">
          <strong>1825</strong>
          <span><?php echo e(__('front.established')); ?></span>
        </div>
      </div>

      <a href="#" class="services-btn"><?php echo e(__('front.learn_more')); ?></a>
    </div>
    <div class="about-sahab-image">
      <?php if($about): ?>
        <img src="<?php echo e(asset('assets/admin/uploads/' . $about->photo)); ?>" alt="<?php echo e(__('front.sahab_municipality')); ?>">
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="about-municipality">
  <h2><?php echo e(__('front.about_municipality')); ?></h2>
  <div class="cards">
    <?php $__currentLoopData = $completeAbouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $completeAbout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="card">
        <div class="<?php echo $completeAbout->icon; ?>" style="color: #1b7b63;"></div>
        <h3><?php echo e($locale == 'ar' ? $completeAbout->title_ar : $completeAbout->title_en); ?></h3>
        <p><?php echo $locale == 'ar' ? $completeAbout->description_ar : $completeAbout->description_en; ?></p>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<section class="organization-structure">
  <h2><?php echo e(__('front.organization_structure')); ?></h2>
  <div class="org-chart">
    <div class="level-1"><?php echo e(__('front.president')); ?></div>
    <div class="level-2">
      <div class="box"><?php echo e(__('front.financial_affairs')); ?></div>
      <div class="box"><?php echo e(__('front.technical_affairs')); ?></div>
      <div class="box"><?php echo e(__('front.administrative_affairs')); ?></div>
    </div>
  </div>
</section>


<section class="sections-area">
  <h2 class="section-title"><?php echo e(__('front.our_departments')); ?></h2>
  <div class="sections-grid">
    <?php $__currentLoopData = $ourParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="section-box">
        <i class="<?php echo e($ourPart->icon); ?>"></i>
        <h3><?php echo e($locale == 'ar' ? $ourPart->title_ar : $ourPart->title_en); ?></h3>
        <p><?php echo e($locale == 'ar' ? $ourPart->description_ar : $ourPart->description_en); ?></p>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>


<section class="municipal-council">
  <h2 class="section-title"><?php echo e(__('front.municipal_council')); ?></h2>
  <div class="council-grid">
    <?php $__currentLoopData = $municipalCouncils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="member-box">
        <img src="<?php echo e(asset('assets/admin/uploads/' . $member->icon)); ?>" alt="<?php echo e($locale == 'ar' ? $member->title_ar : $member->title_en); ?>">
        <h4><?php echo e($locale == 'ar' ? $member->title_ar : $member->title_en); ?></h4>
        <p><?php echo $locale == 'ar' ? $member->description_ar : $member->description_en; ?></p>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<section class="laws-section">
  <h2 class="section-title"><?php echo e(__('front.laws_regulations')); ?></h2>
  <div class="laws-grid">
    <?php $__currentLoopData = $laws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $law): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="law-card">
        <div class="law-icon">📄</div>
        <div class="law-content">
          <h3 class="law-title"><?php echo e($locale == 'ar' ? $law->title_ar : $law->title_en); ?></h3>
          <p class="law-desc"><?php echo $locale == 'ar' ? $law->description_ar : $law->description_en; ?></p>
          <a href="<?php echo e(asset('assets/admin/uploads/' . $law->pdf)); ?>" class="law-download" download><?php echo e(__('front.download')); ?> <span>PDF</span> 📥</a>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/about.blade.php ENDPATH**/ ?>