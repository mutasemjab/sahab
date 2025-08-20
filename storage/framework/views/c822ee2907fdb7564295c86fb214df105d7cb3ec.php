<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('projects')); ?>" class="active"><?php echo e(__('front.projects')); ?></a>
  </div>
</div>

<section class="projects-section">
  <div class="container">
    <h2 class="section-title"><?php echo e(__('front.projects')); ?></h2>
    <p class="section-description"><?php echo e(__('front.projects_description')); ?></p>

    <div class="projects-filters">
      <div class="status-buttons">
        <button class="filter-btn <?php echo e(request('type') == '' ? 'active' : ''); ?>" data-type=""><?php echo e(__('front.all_projects')); ?></button>
        <button class="filter-btn <?php echo e(request('type') == '1' ? 'active' : ''); ?>" data-type="1"><?php echo e(__('front.completed')); ?></button>
        <button class="filter-btn <?php echo e(request('type') == '2' ? 'active' : ''); ?>" data-type="2"><?php echo e(__('front.ongoing')); ?></button>
        <button class="filter-btn <?php echo e(request('type') == '3' ? 'active' : ''); ?>" data-type="3"><?php echo e(__('front.planned')); ?></button>
      </div>
      <div class="search-sort">
        <form id="search-form" method="GET">
          <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
            <input type="text" name="search" placeholder="&#128269; <?php echo e(__('front.search_projects')); ?>">
          <select name="sort" onchange="document.getElementById('search-form').submit()">
            <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>><?php echo e(__('front.newest_first')); ?></option>
            <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>><?php echo e(__('front.oldest_first')); ?></option>
          </select>
        </form>
      </div>
    </div>

    <div class="projects-grid">
      <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="project-card">
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
          <img src="<?php echo e(asset('assets/admin/uploads/' . $project->photo)); ?>" alt="<?php echo e($locale == 'ar' ? $project->title_ar : $project->title_en); ?>">
          <div class="project-content">
            <h3><?php echo e($locale == 'ar' ? $project->title_ar : $project->title_en); ?></h3>
            <p><?php echo Str::limit($locale == 'ar' ? $project->description_ar : $project->description_en, 100); ?></p>
            <?php if($project->time): ?>
              <p class="start-date"><?php echo e(__('front.starting_from')); ?>: <?php echo e($project->time); ?></p>
            <?php endif; ?>
            <a href="<?php echo e(route('projects.show', $project->id)); ?>"><?php echo e(__('front.learn_more')); ?> ←</a>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="no-projects">
          <p><?php echo e(__('front.no_projects_found')); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const searchForm = document.getElementById('search-form');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const typeInput = searchForm.querySelector('input[name="type"]');
            typeInput.value = type;
            searchForm.submit();
        });
    });

    // Submit form on search input
    const searchInput = searchForm.querySelector('input[name="search"]');
    searchInput.addEventListener('input', function() {
        setTimeout(() => {
            searchForm.submit();
        }, 500);
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/projects.blade.php ENDPATH**/ ?>