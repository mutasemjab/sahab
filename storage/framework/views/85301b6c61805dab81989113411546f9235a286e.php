<?php $__env->startSection('title', __('messages.Projects')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.Projects')); ?></h1>
    <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($projects->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.title_en')); ?></th>
                            <th><?php echo e(__('messages.title_ar')); ?></th>
                            <th><?php echo e(__('messages.photo')); ?></th>
                            <th><?php echo e(__('messages.type')); ?></th>
                            <th><?php echo e(__('messages.time')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($project->id); ?></td>
                            <td><?php echo e(Str::limit($project->title_en, 30)); ?></td>
                            <td><?php echo e(Str::limit($project->title_ar, 30)); ?></td>
                            <td>
                                <?php if($project->photo): ?>
                                    <img src="<?php echo e(asset('assets/admin/uploads/' . $project->photo)); ?>" alt="Project" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($project->type == 1): ?>
                                    <span class="badge bg-success"><?php echo e(__('messages.done')); ?></span>
                                <?php elseif($project->type == 2): ?>
                                    <span class="badge bg-warning"><?php echo e(__('messages.on_going')); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-info"><?php echo e(__('messages.planned')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($project->time ?? 'N/A'); ?></td>
                            <td>
                                <a href="<?php echo e(route('projects.edit', $project->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('projects.destroy', $project->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> <?php echo e(__('messages.delete')); ?>

                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Links -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing <?php echo e($projects->firstItem()); ?> to <?php echo e($projects->lastItem()); ?> of <?php echo e($projects->total()); ?> results
                </div>
                <div>
                    <?php echo e($projects->links()); ?>

                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-4">
                <p class="text-muted">No projects found.</p>
                <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/projects/index.blade.php ENDPATH**/ ?>