

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><?php echo e(__('messages.contact_us_management')); ?></h3>
                </div>

                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="<?php echo e(route('admin.contacts.index')); ?>" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" 
                                           placeholder="<?php echo e(__('messages.search_by_name_email_subject')); ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <?php if(request('search')): ?>
                                            <a href="<?php echo e(route('admin.contacts.index')); ?>" class="btn btn-outline-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['per_page' => 10])); ?>" 
                                       class="btn btn-outline-secondary <?php echo e(request('per_page', 25) == 10 ? 'active' : ''); ?>">10</a>
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['per_page' => 25])); ?>" 
                                       class="btn btn-outline-secondary <?php echo e(request('per_page', 25) == 25 ? 'active' : ''); ?>">25</a>
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['per_page' => 50])); ?>" 
                                       class="btn btn-outline-secondary <?php echo e(request('per_page', 25) == 50 ? 'active' : ''); ?>">50</a>
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['per_page' => 100])); ?>" 
                                       class="btn btn-outline-secondary <?php echo e(request('per_page', 25) == 100 ? 'active' : ''); ?>">100</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Results Info -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p class="text-muted">
                                <?php echo e(__('messages.showing')); ?> <?php echo e($contacts->firstItem() ?? 0); ?> <?php echo e(__('messages.to')); ?> <?php echo e($contacts->lastItem() ?? 0); ?> 
                                <?php echo e(__('messages.of')); ?> <?php echo e($contacts->total()); ?> <?php echo e(__('messages.results')); ?>

                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" 
                                           class="text-white text-decoration-none">
                                            <?php echo e(__('messages.id')); ?>

                                            <?php if(request('sort') == 'id'): ?>
                                                <i class="fas fa-sort-<?php echo e(request('direction', 'desc') == 'asc' ? 'up' : 'down'); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" 
                                           class="text-white text-decoration-none">
                                            <?php echo e(__('messages.name')); ?>

                                            <?php if(request('sort') == 'name'): ?>
                                                <i class="fas fa-sort-<?php echo e(request('direction', 'desc') == 'asc' ? 'up' : 'down'); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" 
                                           class="text-white text-decoration-none">
                                            <?php echo e(__('messages.email')); ?>

                                            <?php if(request('sort') == 'email'): ?>
                                                <i class="fas fa-sort-<?php echo e(request('direction', 'desc') == 'asc' ? 'up' : 'down'); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th><?php echo e(__('messages.subject')); ?></th>
                                    <th><?php echo e(__('messages.message')); ?></th>
                                    <th>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" 
                                           class="text-white text-decoration-none">
                                            <?php echo e(__('messages.created')); ?>

                                            <?php if(request('sort') == 'created_at' || !request('sort')): ?>
                                                <i class="fas fa-sort-<?php echo e(request('direction', 'desc') == 'asc' ? 'up' : 'down'); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th><?php echo e(__('messages.actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($contact->id); ?></td>
                                    <td>
                                        <strong><?php echo e($contact->name); ?></strong>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo e($contact->email); ?>" class="text-primary">
                                            <?php echo e($contact->email); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="<?php echo e($contact->subject); ?>">
                                            <?php echo e(Str::limit($contact->subject, 50)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if(strlen($contact->message) > 100): ?>
                                            <span class="text-truncate d-inline-block" style="max-width: 300px;" title="<?php echo e($contact->message); ?>">
                                                <?php echo e(Str::limit($contact->message, 100)); ?>

                                            </span>
                                            <button type="button" class="btn btn-sm btn-outline-info ml-2" 
                                                    data-toggle="modal" data-target="#messageModal<?php echo e($contact->id); ?>">
                                                <i class="fas fa-eye"></i> <?php echo e(__('messages.view_full')); ?>

                                            </button>

                                            <!-- Message Modal -->
                                            <div class="modal fade" id="messageModal<?php echo e($contact->id); ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo e(__('messages.full_message')); ?> - <?php echo e($contact->name); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <strong><?php echo e(__('messages.from')); ?>:</strong> <?php echo e($contact->name); ?> (<?php echo e($contact->email); ?>)
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong><?php echo e(__('messages.subject')); ?>:</strong> <?php echo e($contact->subject); ?>

                                                            </div>
                                                            <div class="mb-3">
                                                                <strong><?php echo e(__('messages.message')); ?>:</strong>
                                                            </div>
                                                            <div class="p-3 bg-light rounded">
                                                                <?php echo nl2br(e($contact->message)); ?>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="mailto:<?php echo e($contact->email); ?>?subject=Re: <?php echo e($contact->subject); ?>" 
                                                               class="btn btn-primary">
                                                                <i class="fas fa-reply"></i> <?php echo e(__('messages.reply_via_email')); ?>

                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                <?php echo e(__('messages.close')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <?php echo nl2br(e($contact->message)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo e(\Carbon\Carbon::parse($contact->created_at)->format('Y-m-d H:i')); ?>

                                            <br>
                                            <span class="badge badge-secondary">
                                                <?php echo e(\Carbon\Carbon::parse($contact->created_at)->diffForHumans()); ?>

                                            </span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="mailto:<?php echo e($contact->email); ?>?subject=Re: <?php echo e($contact->subject); ?>" 
                                               class="btn btn-sm btn-primary" title="<?php echo e(__('messages.reply_via_email')); ?>">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    data-toggle="modal" data-target="#messageModal<?php echo e($contact->id); ?>" 
                                                    title="<?php echo e(__('messages.view_full_message')); ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="<?php echo e(route('admin.contacts.destroy', $contact->id)); ?>" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('<?php echo e(__('messages.confirm_delete_contact')); ?>')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" title="<?php echo e(__('messages.delete')); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted"><?php echo e(__('messages.no_contacts_found')); ?></h5>
                                            <p class="text-muted"><?php echo e(__('messages.no_contacts_to_display')); ?></p>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo e($contacts->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function() {
    // Auto-focus search input if there's a search term
    if ($('input[name="search"]').val()) {
        $('input[name="search"]').focus();
    }
});
</script>

<style>
.table td {
    vertical-align: middle;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.table th a {
    display: block;
    color: white !important;
}

.table th a:hover {
    color: #f8f9fa !important;
}

.modal-body .bg-light {
    max-height: 400px;
    overflow-y: auto;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/contactUs/index.blade.php ENDPATH**/ ?>