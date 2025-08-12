

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(__('messages.service_details')); ?> - <?php echo e($service->title_en); ?></h3>
                    <div class="card-tools">
                        <a href="<?php echo e(route('services.details.create', $service->id)); ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> <?php echo e(__('messages.add_details')); ?>

                        </a>
                        <a href="<?php echo e(route('services.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> <?php echo e(__('messages.back')); ?>

                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($serviceDetails->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(__('messages.video')); ?></th>
                                        <th><?php echo e(__('messages.description_en')); ?></th>
                                        <th><?php echo e(__('messages.description_ar')); ?></th>
                                        <th><?php echo e(__('messages.created_at')); ?></th>
                                        <th><?php echo e(__('messages.actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $serviceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(Str::limit($detail->video, 30)); ?></td>
                                        <td><?php echo e(Str::limit($detail->description_en, 50)); ?></td>
                                        <td><?php echo e(Str::limit($detail->description_ar, 50)); ?></td>
                                        <td><?php echo e(date('Y-m-d', strtotime($detail->created_at))); ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Edit Detail Button -->
                                                <a href="<?php echo e(route('services.details.edit', [$service->id, $detail->id])); ?>" 
                                                   class="btn btn-warning btn-sm" 
                                                   title="<?php echo e(__('messages.edit')); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <!-- Delete Detail Button -->
                                                <form action="<?php echo e(route('services.details.destroy', [$service->id, $detail->id])); ?>" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            title="<?php echo e(__('messages.delete')); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i>
                            <?php echo e(__('messages.no_service_details')); ?>

                            <br><br>
                            <a href="<?php echo e(route('services.details.create', $service->id)); ?>" class="btn btn-success">
                                <i class="fas fa-plus"></i> <?php echo e(__('messages.add_first_detail')); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Info Card -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo e(__('messages.service_information')); ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><?php echo e(__('messages.title_en')); ?>:</strong> <?php echo e($service->title_en); ?><br>
                        <strong><?php echo e(__('messages.title_ar')); ?>:</strong> <?php echo e($service->title_ar); ?><br>
                        <strong><?php echo e(__('messages.target_audience')); ?>:</strong> <?php echo e($service->target_audience); ?><br>
                    </div>
                    <div class="col-md-6">
                        <strong><?php echo e(__('messages.duration_service')); ?>:</strong> <?php echo e($service->duration_service); ?><br>
                        <strong><?php echo e(__('messages.service_channel')); ?>:</strong> <?php echo e($service->service_channel); ?><br>
                        <strong><?php echo e(__('messages.service_cost')); ?>:</strong> <?php echo e($service->service_cost); ?><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/services/details.blade.php ENDPATH**/ ?>