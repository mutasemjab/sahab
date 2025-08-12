<?php $__env->startSection('title', __('messages.Laws')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.Laws')); ?></h1>
    <a href="<?php echo e(route('laws.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($laws->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.title_en')); ?></th>
                            <th><?php echo e(__('messages.title_ar')); ?></th>
                            <th><?php echo e(__('messages.description_en')); ?></th>
                            <th><?php echo e(__('messages.pdf')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $laws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $law): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($law->id); ?></td>
                            <td><?php echo e(Str::limit($law->title_en, 30)); ?></td>
                            <td><?php echo e(Str::limit($law->title_ar, 30)); ?></td>
                            <td><?php echo e(Str::limit(strip_tags($law->description_en), 30)); ?></td>
                            <td>
                                <?php if($law->pdf): ?>
                                    <a href="<?php echo e(asset('assets/admin/uploads/'.$law->pdf)); ?>" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('laws.edit', $law->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('laws.destroy', $law->id)); ?>" method="POST" class="d-inline">
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
                <p class="text-muted">No laws found.</p>
                <a href="<?php echo e(route('laws.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/laws/index.blade.php ENDPATH**/ ?>