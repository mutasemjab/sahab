<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('community.index')); ?>" class="active"><?php echo e(__('front.community')); ?></a>
  </div>
</div>

<section class="mutasem-community-section">
  <div class="mutasem-container">
    <h2 class="mutasem-title"><?php echo e(__('front.shape_community_future')); ?></h2>
    <p class="mutasem-subtitle"><?php echo e(__('front.community_participation_description')); ?></p>

    <!-- المبادرات المجتمعية -->
    <div class="mutasem-block">
      <h3 class="mutasem-heading"><?php echo e(__('front.community_initiatives')); ?></h3>
      <div class="mutasem-cards-row">
        <?php $__empty_1 = true; $__currentLoopData = $initiatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $initiative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="mutasem-card">
            <div class="mutasem-card-header">
              <h4><?php echo e(app()->getLocale() == 'ar' ? $initiative->title_ar : $initiative->title_en); ?></h4>
              <p><?php echo e(Str::limit(app()->getLocale() == 'ar' ? $initiative->description_ar : $initiative->description_en, 100)); ?></p>
            </div>
            <div class="mutasem-card-progress">
              <span class="supporter-count-<?php echo e($initiative->id); ?>"><?php echo e($initiative->supporting_users_count); ?> <?php echo e(__('front.supporters')); ?></span>
              <?php if($initiative->date_finish): ?>
                <span><?php echo e(__('front.ends_on')); ?> <?php echo e(Carbon\Carbon::parse($initiative->date_finish)->locale('ar')->translatedFormat('j F Y')); ?></span>
              <?php endif; ?>
              <?php
                $supportCount = $initiative->supporting_users_count;
                $progressPercentage = min(($supportCount / 100) * 100, 100); // Assuming 100 is the target
              ?>
              <div class="mutasem-progress-bar">
                <div class="progress-fill-<?php echo e($initiative->id); ?>" style="width: <?php echo e($progressPercentage); ?>%;"></div>
              </div>
              <?php if(auth()->guard()->check()): ?>
                <?php if($initiative->isSupportedByUser(Auth::id())): ?>
                  <button class="support-initiative-btn supported" disabled>
                    <?php echo e(__('front.supported')); ?> ✓
                  </button>
                <?php else: ?>
                  <button class="support-initiative-btn" data-id="<?php echo e($initiative->id); ?>">
                    <?php echo e(__('front.support_initiative')); ?>

                  </button>
                <?php endif; ?>
              <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="support-initiative-btn">
                  <?php echo e(__('front.login_to_support')); ?>

                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="no-initiatives">
            <p><?php echo e(__('front.no_initiatives_available')); ?></p>
          </div>
        <?php endif; ?>
      </div>
      <button class="mutasem-add-btn">+ <?php echo e(__('front.start_initiative')); ?></button>
    </div>

    <!-- الجلسات العامة القادمة -->
    <div class="mutasem-block">
      <h3 class="mutasem-heading"><?php echo e(__('front.upcoming_public_sessions')); ?></h3>
      <div class="mutasem-cards-row">
        <?php $__empty_1 = true; $__currentLoopData = $publicSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="mutasem-session-card">
            <span class="mutasem-status <?php echo e($session->type == 1 ? 'open' : ''); ?>">
              <?php echo e($session->type == 1 ? __('front.open') : __('front.coming_soon')); ?>

            </span>
            <h4><?php echo e(app()->getLocale() == 'ar' ? $session->title_ar : $session->title_en); ?></h4>
            <p><?php echo e(Str::limit(app()->getLocale() == 'ar' ? $session->description_ar : $session->description_en, 100)); ?></p>
              <p class="mutasem-time">
               <?php if($session->from_time): ?>
                            <?php
                                \Carbon\Carbon::setLocale('ar');
                                $fromTime = \Carbon\Carbon::parse($session->from_time);
                                $toTime = \Carbon\Carbon::parse($session->to_time);
                            ?>
                            <div class="session-time">
                                <i class="fas fa-clock"></i> 
                                <?php echo e($fromTime->format('g:i')); ?> <?php echo e($fromTime->format('A') == 'AM' ? 'صباحا' : 'مساء'); ?> - 
                                <?php echo e($toTime->format('g:i')); ?> <?php echo e($toTime->format('A') == 'AM' ? 'صباحا' : 'مساء'); ?>

                            </div>
                        <?php endif; ?>
              </p>
         
            <?php if($session->type == 1): ?>
             <a href="<?php echo e(route('sessions.show', $session->id)); ?>" class="mutasem-primary-btn">
                  <?php echo e(__('front.join_session')); ?>

              </a>

            <?php else: ?>
              <button class="mutasem-light-btn"><?php echo e(__('front.vote_on_discussion_topics')); ?></button>
            <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="no-sessions">
            <p><?php echo e(__('front.no_sessions_available')); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- التصويت على مواضيع النقاش -->
    <div class="mutasem-block">
      <h3 class="mutasem-heading"><?php echo e(__('front.vote_on_discussion_topics')); ?></h3>
      <div class="mutasem-cards-row">
        <!-- Sample static voting topics -->
        <div class="mutasem-vote-card">
          <h4><?php echo e(__('front.public_safety')); ?></h4>
          <p><?php echo e(__('front.public_safety_desc')); ?></p>
          <button class="mutasem-vote-btn"><?php echo e(__('front.vote')); ?> ↑</button>
          <div class="mutasem-progress-bar small"><div style="width: 60%;"></div></div>
          <span class="mutasem-vote-count"><?php echo e(__('front.current_votes')); ?>: 98</span>
        </div>

        <div class="mutasem-vote-card">
          <h4><?php echo e(__('front.waste_management')); ?></h4>
          <p><?php echo e(__('front.waste_management_desc')); ?></p>
          <button class="mutasem-vote-btn"><?php echo e(__('front.vote')); ?> ↑</button>
          <div class="mutasem-progress-bar small"><div style="width: 80%;"></div></div>
          <span class="mutasem-vote-count"><?php echo e(__('front.current_votes')); ?>: 134</span>
        </div>

        <div class="mutasem-vote-card">
          <h4><?php echo e(__('front.road_infrastructure')); ?></h4>
          <p><?php echo e(__('front.road_infrastructure_desc')); ?></p>
          <button class="mutasem-vote-btn"><?php echo e(__('front.vote')); ?> ↑</button>
          <div class="mutasem-progress-bar small"><div style="width: 90%;"></div></div>
          <span class="mutasem-vote-count"><?php echo e(__('front.current_votes')); ?>: 156</span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if(session('success')): ?>
  <div class="alert alert-success">
    <?php echo e(session('success')); ?>

  </div>
<?php endif; ?>

<script>
// Support Initiative
document.querySelectorAll('.support-initiative-btn:not(.supported)').forEach(button => {
  button.addEventListener('click', function() {
    const initiativeId = this.getAttribute('data-id');
    const button = this;
    
    fetch(`/community/support-initiative/${initiativeId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update button
        button.textContent = '<?php echo e(__("front.supported")); ?> ✓';
        button.classList.add('supported');
        button.disabled = true;
        
        // Update supporter count
        document.querySelector(`.supporter-count-${initiativeId}`).textContent = 
          `${data.new_count} <?php echo e(__('front.supporters')); ?>`;
        
        // Update progress bar
        const progressPercentage = Math.min((data.new_count / 100) * 100, 100);
        document.querySelector(`.progress-fill-${initiativeId}`).style.width = 
          `${progressPercentage}%`;
        
        // Show success message
        alert(data.message);
      } else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('<?php echo e(__("front.error_occurred")); ?>');
    });
  });
});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/community.blade.php ENDPATH**/ ?>