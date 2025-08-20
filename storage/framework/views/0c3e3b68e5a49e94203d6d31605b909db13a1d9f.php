<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('projects')); ?>"><?php echo e(__('front.projects')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <span class="active"><?php echo e($locale == 'ar' ? $project->title_ar : $project->title_en); ?></span>
  </div>
</div>

<section class="project-details-section">
  <div class="container">
    <!-- Project Header -->
    <div class="project-header">
      <div class="project-meta">
        <span class="project-status 
          <?php if($project->type == 1): ?> completed
          <?php elseif($project->type == 2): ?> ongoing
          <?php else: ?> planned
          <?php endif; ?>">
          <?php if($project->type == 1): ?>
            <?php echo e(__('front.completed')); ?>

          <?php elseif($project->type == 2): ?>
            <?php echo e(__('front.ongoing')); ?>

          <?php else: ?>
            <?php echo e(__('front.planned')); ?>

          <?php endif; ?>
        </span>
        <?php if($project->time): ?>
          <span class="project-time"><?php echo e(__('front.starting_from')); ?>: <?php echo e($project->time); ?></span>
        <?php endif; ?>
      </div>
      <h1 class="project-title"><?php echo e($locale == 'ar' ? $project->title_ar : $project->title_en); ?></h1>
    </div>

    <!-- Project Image -->
    <div class="project-image">
      <img src="<?php echo e(asset('assets/admin/uploads/' . $project->photo)); ?>" alt="<?php echo e($locale == 'ar' ? $project->title_ar : $project->title_en); ?>">
    </div>

    <!-- Project Content -->
    <div class="project-content">
      <div class="project-description">
        <h2><?php echo e(__('front.project_description')); ?></h2>
        <div class="description-text">
          <?php echo $locale == 'ar' ? $project->description_ar : $project->description_en; ?>

        </div>
      </div>

      <!-- Project Details Grid -->
      <div class="project-details-grid">
        <div class="detail-card">
          <div class="detail-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div class="detail-content">
            <h3><?php echo e(__('front.project_timeline')); ?></h3>
            <p>
              <?php if($project->type == 1): ?>
                <?php echo e(__('front.completed_project')); ?>

              <?php elseif($project->type == 2): ?>
                <?php echo e(__('front.ongoing_project')); ?>

              <?php else: ?>
                <?php echo e(__('front.planned_project')); ?>

              <?php endif; ?>
            </p>
            <?php if($project->time): ?>
              <small><?php echo e(__('front.start_date')); ?>: <?php echo e($project->time); ?></small>
            <?php endif; ?>
          </div>
        </div>

        <div class="detail-card">
          <div class="detail-icon">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="detail-content">
            <h3><?php echo e(__('front.project_status')); ?></h3>
            <p>
              <?php if($project->type == 1): ?>
                <?php echo e(__('front.project_completed_desc')); ?>

              <?php elseif($project->type == 2): ?>
                <?php echo e(__('front.project_ongoing_desc')); ?>

              <?php else: ?>
                <?php echo e(__('front.project_planned_desc')); ?>

              <?php endif; ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="project-navigation">
      <a href="<?php echo e(route('projects')); ?>" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i>
        <?php echo e(__('front.back_to_projects')); ?>

      </a>
      
      <!-- Optional: Next/Previous project navigation -->
      <div class="project-nav-arrows">
        <?php
          $prevProject = \App\Models\Projects::where('id', '<', $project->id)->orderBy('id', 'desc')->first();
          $nextProject = \App\Models\Projects::where('id', '>', $project->id)->orderBy('id', 'asc')->first();
        ?>
        
        <?php if($prevProject): ?>
          <a href="<?php echo e(route('projects.show', $prevProject->id)); ?>" class="nav-arrow prev" title="<?php echo e(__('front.previous_project')); ?>">
            <i class="fas fa-chevron-left"></i>
            <span><?php echo e(__('front.previous')); ?></span>
          </a>
        <?php endif; ?>
        
        <?php if($nextProject): ?>
          <a href="<?php echo e(route('projects.show', $nextProject->id)); ?>" class="nav-arrow next" title="<?php echo e(__('front.next_project')); ?>">
            <span><?php echo e(__('front.next')); ?></span>
            <i class="fas fa-chevron-right"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/project-details.blade.php ENDPATH**/ ?>