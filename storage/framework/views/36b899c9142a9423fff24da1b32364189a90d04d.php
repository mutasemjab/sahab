<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('community.index')); ?>"><?php echo e(__('front.community')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active"><?php echo e(__('front.session_details')); ?></a>
  </div>
</div>

<section class="mutasem-sessionview-wrapper">
  <div class="mutasem-sessionview-container">
    <div class="mutasem-sessionview-header">
      <h2 class="mutasem-sessionview-title"><?php echo e($locale == 'ar' ? $session->title_ar : $session->title_en); ?></h2>
      <p class="mutasem-sessionview-desc">
        <?php echo e($locale == 'ar' ? $session->description_ar : $session->description_en); ?>

      </p>
    </div>

<div class="mutasem-sessionview-details">

  <?php if($session->time): ?>
    <div class="mutasem-sessionview-info-box">
      <strong>
        <i class="far fa-clock" style="color:#1b7b63; margin-left:6px;"></i>
        <?php echo e(__('front.time')); ?>

      </strong>
      <div><?php echo e($session->time); ?></div>
    </div>
  <?php endif; ?>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="far fa-calendar-alt" style="color:#1b7b63; margin-left:6px;"></i>
      <?php echo e(__('front.date')); ?>

    </strong>
    <div><?php echo e(Carbon\Carbon::parse($session->date_of_event)->format('l, d F Y')); ?></div>
  </div>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="fas fa-map-marker-alt" style="color:#1b7b63; margin-left:6px;"></i>
      <?php echo e(__('front.location')); ?>

    </strong>
    <div><?php echo e(__('front.online_via_zoom')); ?></div>
  </div>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="fas fa-video" style="color:#1b7b63; margin-left:6px;"></i>
      <?php echo e(__('front.platform')); ?>

    </strong>
    <div><?php echo e(__('front.zoom_platform')); ?></div>
  </div>

  <div class="mutasem-sessionview-info-box">
    <strong>
      <i class="fas fa-info-circle" style="color:#1b7b63; margin-left:6px;"></i>
      <?php echo e(__('front.status')); ?>

    </strong>
    <div class="session-status <?php echo e($session->type == 1 ? 'open' : 'soon'); ?>">
      <?php echo e($session->type == 1 ? __('front.open_for_registration') : __('front.coming_soon')); ?>

    </div>
  </div>

</div>


    <div class="mutasem-sessionview-content">
      <?php if($session->video): ?>
        <div class="mutasem-sessionview-video">
          <h3 class="mutasem-sessionview-subtitle"><?php echo e(__('front.session_video')); ?></h3>
          <div class="mutasem-sessionview-video-box">
            <iframe src="<?php echo e($session->video); ?>" frameborder="0" allowfullscreen style="width: 100%; height: 300px; border-radius: 8px;"></iframe>
          </div>
        </div>
      <?php else: ?>
        <div class="mutasem-sessionview-video">
          <h3 class="mutasem-sessionview-subtitle"><?php echo e(__('front.session_video')); ?></h3>
          <div class="mutasem-sessionview-video-box">
            <span class="mutasem-sessionview-play">▶</span>
            <p><?php echo e(__('front.video_will_be_available')); ?></p>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="mutasem-sessionview-expect">
      <h3 class="mutasem-sessionview-subtitle"><?php echo e(__('front.what_to_expect')); ?></h3>
      <?php if($session->what_expect): ?>
        <div class="session-expectations">
          <?php echo nl2br(e($session->what_expect)); ?>

        </div>
      <?php else: ?>
        <ul class="mutasem-sessionview-list">
          <li><?php echo e(__('front.expect_1')); ?></li>
          <li><?php echo e(__('front.expect_2')); ?></li>
          <li><?php echo e(__('front.expect_3')); ?></li>
          <li><?php echo e(__('front.expect_4')); ?></li>
        </ul>
      <?php endif; ?>
    </div>


  </div>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/public-sessions-details.blade.php ENDPATH**/ ?>