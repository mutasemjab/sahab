<?php $__env->startSection('title', __('messages.listen_sessions')); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><?php echo e(__('messages.listen_sessions')); ?></h4>
                    <a href="<?php echo e(route('new-listen-sessions.create')); ?>" class="btn btn-primary">
                        <?php echo e(__('messages.add_new_session')); ?>

                    </a>
                </div>
                
                <div class="card-body">

                    <?php if($sessions->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('messages.photo')); ?></th>
                                        <th><?php echo e(__('messages.title')); ?></th>
                                        <th><?php echo e(__('messages.description')); ?></th>
                                        <th><?php echo e(__('messages.created_at')); ?></th>
                                        <th><?php echo e(__('messages.actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php if($session->photo_url): ?>
                                                    <img src="<?php echo e($session->photo_url); ?>" alt="<?php echo e($session->title); ?>" 
                                                         class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                                <?php else: ?>
                                                    <span class="text-muted"><?php echo e(__('messages.no_image')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(Str::limit($session->title, 30)); ?></td>
                                            <td><?php echo e(Str::limit($session->description, 50)); ?></td>
                                            <td><?php echo e($session->created_at->format('Y-m-d')); ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo e(route('new-listen-sessions.show', $session)); ?>" 
                                                       class="btn btn-info btn-sm">
                                                        <?php echo e(__('messages.view')); ?>

                                                    </a>
                                                    <a href="<?php echo e(route('new-listen-sessions.edit', $session)); ?>" 
                                                       class="btn btn-warning btn-sm">
                                                        <?php echo e(__('messages.edit')); ?>

                                                    </a>
                                                    <form action="<?php echo e(route('new-listen-sessions.destroy', $session)); ?>" 
                                                          method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                                                            <?php echo e(__('messages.delete')); ?>

                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <?php echo e($sessions->links()); ?>

                    <?php else: ?>
                        <div class="text-center">
                            <p class="text-muted"><?php echo e(__('messages.no_sessions_found')); ?></p>
                            <a href="<?php echo e(route('new-listen-sessions.create')); ?>" class="btn btn-primary">
                                <?php echo e(__('messages.add_first_session')); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/new_listen_sessions/index.blade.php ENDPATH**/ ?>