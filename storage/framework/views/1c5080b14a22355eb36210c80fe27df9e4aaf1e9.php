<?php $__env->startSection('title', __('messages.PublicSessions')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.PublicSessions')); ?></h1>
    <a href="<?php echo e(route('public-sessions.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if($publicSessions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('messages.date_of_event')); ?></th>
                            <th><?php echo e(__('messages.title_en')); ?></th>
                            <th><?php echo e(__('messages.title_ar')); ?></th>
                            <th><?php echo e(__('messages.type')); ?></th>
                            <th><?php echo e(__('messages.time')); ?></th>
                            <th><?php echo e(__('messages.actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $publicSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($session->id); ?></td>
                            <td><?php echo e($session->date_of_event); ?></td>
                            <td><?php echo e(Str::limit($session->title_en, 30)); ?></td>
                            <td><?php echo e(Str::limit($session->title_ar, 30)); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($session->type == 1 ? 'success' : 'warning'); ?>">
                                    <?php echo e($session->type == 1 ? __('messages.open') : __('messages.soon')); ?>

                                </span>
                            </td>
                            <td>  
                                
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
                            
                            </td>
                            <td>
                                <a href="<?php echo e(route('public-sessions.edit', $session->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('public-sessions.destroy', $session->id)); ?>" method="POST" class="d-inline">
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
                <p class="text-muted">No public sessions found.</p>
                <a href="<?php echo e(route('public-sessions.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <?php echo e(__('messages.create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/public_sessions/index.blade.php ENDPATH**/ ?>