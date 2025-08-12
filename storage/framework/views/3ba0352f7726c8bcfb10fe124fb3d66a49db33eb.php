<?php $__env->startSection('title', __('messages.news')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.news')); ?></h1>
    <a href="<?php echo e(route('news.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($news->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.date_of_news')); ?></th>
                            <th><?php echo e(__('messages.title_en')); ?></th>
                            <th><?php echo e(__('messages.title_ar')); ?></th>
                            <th><?php echo e(__('messages.photo')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($new->id); ?></td>
                            <td><?php echo e($new->date_of_news); ?></td>
                            <td><?php echo e(Str::limit($new->title_en, 30)); ?></td>
                            <td><?php echo e(Str::limit($new->title_ar, 30)); ?></td>
                            <td>
                                <?php if($new->photo): ?>
                                    <img src="<?php echo e(asset('assets/admin/uploads/'.$new->photo)); ?>" alt="new" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('news.edit', $new->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('news.destroy', $new->id)); ?>" method="POST" class="d-inline">
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
                <p class="text-muted">No News found.</p>
                <a href="<?php echo e(route('news.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/news/index.blade.php ENDPATH**/ ?>