<?php $__env->startSection('title', __('messages.Galleries')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.Galleries')); ?></h1>
    <a href="<?php echo e(route('galleries.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($galleries->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.photos')); ?></th>
                            <th><?php echo e(__('messages.videos')); ?></th>
                            <th><?php echo e(__('messages.created_at')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($gallery->id); ?></td>
                            <td>
                                <?php $photos = json_decode($gallery->photo, true); ?>
                                <?php if($photos && count($photos) > 0): ?>
                                    <span class="badge bg-primary"><?php echo e(count($photos)); ?> Photos</span>
                                    <div class="mt-1">
                                        <?php $__currentLoopData = array_slice($photos, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img src="<?php echo e(asset('assets/admin/uploads/'.$photo)); ?>" alt="Gallery" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($photos) > 3): ?>
                                            <span class="text-muted">+<?php echo e(count($photos) - 3); ?> more</span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">No photos</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $videos = json_decode($gallery->video, true); ?>
                                <?php if($videos && count($videos) > 0): ?>
                                    <span class="badge bg-success"><?php echo e(count($videos)); ?> Videos</span>
                                <?php else: ?>
                                    <span class="text-muted">No videos</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($gallery->created_at); ?></td>
                            <td>
                                <a href="<?php echo e(route('galleries.edit', $gallery->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('galleries.destroy', $gallery->id)); ?>" method="POST" class="d-inline">
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
                <p class="text-muted">No galleries found.</p>
                <a href="<?php echo e(route('galleries.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/galleries/index.blade.php ENDPATH**/ ?>