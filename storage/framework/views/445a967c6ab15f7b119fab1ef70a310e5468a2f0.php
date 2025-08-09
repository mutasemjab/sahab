<?php $__env->startSection('title', __('messages.About')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.About')); ?></h1>
    <a href="<?php echo e(route('abouts.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($abouts->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.description_en')); ?></th>
                            <th><?php echo e(__('messages.description_ar')); ?></th>
                            <th><?php echo e(__('messages.photo')); ?></th>
                            <th><?php echo e(__('messages.created_at')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($about->id); ?></td>
                            <td><?php echo e(Str::limit(strip_tags($about->description_en), 50)); ?></td>
                            <td><?php echo e(Str::limit(strip_tags($about->description_ar), 50)); ?></td>
                            <td>
                                <?php if($about->photo): ?>
                                    <img src="<?php echo e(asset('assets/admin/uploads/' . $about->photo)); ?>" alt="About" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($about->created_at); ?></td>
                            <td>
                                <a href="<?php echo e(route('complete_abouts.index')); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-add"></i> <?php echo e(__('messages.complete_abouts')); ?>

                                </a>
                                <a href="<?php echo e(route('abouts.edit', $about->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('abouts.destroy', $about->id)); ?>" method="POST" class="d-inline">
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
        <?php else: ?>
            <div class="text-center py-4">
                <p class="text-muted">No about records found.</p>
                <a href="<?php echo e(route('abouts.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/abouts/index.blade.php ENDPATH**/ ?>