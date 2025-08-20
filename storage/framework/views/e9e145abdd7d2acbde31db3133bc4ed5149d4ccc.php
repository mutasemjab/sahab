<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('complaints.index')); ?>" class="active"><?php echo e(__('front.track_your_complaint')); ?></a>
  </div>
</div>

<section class="track-complaint-section">
  <div class="track-heading">
    <h2 class="section-title"><?php echo e(__('front.track_your_complaint')); ?></h2>
    <p class="section-subtitle"><?php echo e(__('front.enter_complaint_number_or_phone')); ?></p>
  </div>
  
  <?php if(session('error')): ?>
    <div class="alert alert-danger">
      <?php echo e(session('error')); ?>

    </div>
  <?php endif; ?>

  <div class="track-box">
    <form class="track-form" action="<?php echo e(route('complaints.track')); ?>" method="GET">
      <input
        type="text"
        name="search_term"
        class="track-input"
        placeholder="<?php echo e(__('front.complaint_number_or_phone_placeholder')); ?>"
        value="<?php echo e(request('search_term')); ?>"
        required
      />
      <button class="track-submit" type="submit">← <?php echo e(__('front.submit')); ?></button>
    </form>
  </div>

  <?php if(isset($complaints)): ?>
    <div class="track-results">
      <?php if($complaints->count() > 0): ?>
        <h3 class="results-title"><?php echo e(__('front.search_results')); ?></h3>
        <div class="complaints-track-list">
          <?php $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="complaint-track-card">
              <div class="complaint-track-header">
                <div class="complaint-track-number">
                  <strong><?php echo e(__('front.complaint_number')); ?>: #<?php echo e($complaint->number); ?></strong>
                  <?php if($complaint->is_complaint_emergency == 1): ?>
                    <span class="emergency-badge"><?php echo e(__('front.emergency')); ?></span>
                  <?php endif; ?>
                </div>
                <div class="complaint-track-date">
                  <?php echo e($complaint->created_at->format('Y-m-d')); ?>

                </div>
              </div>
              
              <div class="complaint-track-content">
                <?php if($complaint->hide_information == 2): ?>
                  <div class="complaint-submitter">
                    <i class="fas fa-user"></i>
                    <?php echo e($complaint->name); ?>

                  </div>
                <?php endif; ?>
                
                <div class="complaint-service">
                  <i class="fas fa-cog"></i>
                  <strong><?php echo e(__('front.service')); ?>:</strong>
                  <?php echo e($locale == 'ar' ? $complaint->service->title_ar : $complaint->service->title_en); ?>

                </div>
                
                <div class="complaint-location">
                  <i class="fas fa-map-marker-alt"></i>
                  <strong><?php echo e(__('front.location')); ?>:</strong>
                  <?php echo e($locale == 'ar' ? $complaint->placeComplaint->name_ar : $complaint->placeComplaint->name_en); ?>

                </div>
                
                <div class="complaint-details">
                  <strong><?php echo e(__('front.complaint_details')); ?>:</strong>
                  <?php echo e(Str::limit($complaint->complaint_details, 150)); ?>

                </div>
              </div>
              
              <div class="complaint-track-footer">
                <div class="complaint-status">
                  <span class="status-badge-track 
                    <?php if($complaint->status == 1): ?> pending
                    <?php elseif($complaint->status == 2): ?> working
                    <?php elseif($complaint->status == 3): ?> done
                    <?php elseif($complaint->status == 4): ?> outside-jurisdiction
                    <?php else: ?> not-solved
                    <?php endif; ?>">
                    <i class="fas fa-circle status-icon"></i>
                    <?php if($complaint->status == 1): ?>
                      <?php echo e(__('front.status_pending')); ?>

                    <?php elseif($complaint->status == 2): ?>
                      <?php echo e(__('front.status_working')); ?>

                    <?php elseif($complaint->status == 3): ?>
                      <?php echo e(__('front.status_done')); ?>

                    <?php elseif($complaint->status == 4): ?>
                      <?php echo e(__('front.status_outside_jurisdiction')); ?>

                    <?php else: ?>
                      <?php echo e(__('front.status_not_solved')); ?>

                    <?php endif; ?>
                  </span>
                </div>
                
                <div class="complaint-actions">
                  <span class="time-ago"><?php echo e($complaint->created_at->diffForHumans()); ?></span>
                  <a href="<?php echo e(route('complaints-details-two', $complaint->id)); ?>" class="view-details-btn">
                    <?php echo e(__('front.view_full_details')); ?>

                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
          <h4><?php echo e(__('front.need_help')); ?></h4>
          <div class="action-buttons">
            <a href="<?php echo e(route('complaints.index')); ?>" class="action-btn primary">
              <i class="fas fa-plus"></i>
              <?php echo e(__('front.submit_new_complaint')); ?>

            </a>
            <a href="<?php echo e(route('contact.index')); ?>" class="action-btn secondary">
              <i class="fas fa-phone"></i>
              <?php echo e(__('front.contact_support')); ?>

            </a>
          </div>
        </div>
        
      <?php else: ?>
        <div class="no-results">
          <div class="no-results-icon">
            <i class="fas fa-search"></i>
          </div>
          <h3><?php echo e(__('front.no_complaints_found')); ?></h3>
          <p><?php echo e(__('front.no_complaints_found_message')); ?></p>
          <div class="no-results-actions">
            <a href="<?php echo e(route('complaints.index')); ?>" class="btn-primary">
              <?php echo e(__('front.submit_new_complaint')); ?>

            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/follow-complaints.blade.php ENDPATH**/ ?>