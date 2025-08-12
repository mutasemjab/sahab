<?php $__env->startSection('title', __('messages.TenderDetails')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.TenderDetails')); ?></h1>
    <a href="<?php echo e(route('tender-details.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($tenderDetails->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.tender_id')); ?></th>
                            <th><?php echo e(__('messages.video')); ?></th>
                            <th><?php echo e(__('messages.description_en')); ?></th>
                            <th><?php echo e(__('messages.condition')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tenderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($detail->id); ?></td>
                            <td><?php echo e($detail->tender_title); ?></td>
                            <td>
                                <a href="<?php echo e($detail->video); ?>" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-play"></i> Watch
                                </a>
                            </td>
                            <td><?php echo e(Str::limit(strip_tags($detail->description_en), 30)); ?></td>
                            <td><?php echo e(Str::limit(strip_tags($detail->condition), 30)); ?></td>
                            <td>
                                <a href="<?php echo e(route('tender-details.edit', $detail->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('tender-details.destroy', $detail->id)); ?>" method="POST" class="d-inline">
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
                <p class="text-muted">No tender details found.</p>
                <a href="<?php echo e(route('tender-details.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/tender_details/index.blade.php ENDPATH**/ ?>