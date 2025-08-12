

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><?php echo e(__('messages.complaints_management')); ?></h3>
                    
                </div>

                <div class="card-body">
                    <!-- Filters -->
                    <form method="GET" action="<?php echo e(route('adminComplaints.index')); ?>" class="mb-4">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" name="status" onchange="this.form.submit()">
                                    <option value=""><?php echo e(__('messages.all_status')); ?></option>
                                    <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>><?php echo e(__('messages.pending')); ?></option>
                                    <option value="2" <?php echo e(request('status') == '2' ? 'selected' : ''); ?>><?php echo e(__('messages.work_on_it')); ?></option>
                                    <option value="3" <?php echo e(request('status') == '3' ? 'selected' : ''); ?>><?php echo e(__('messages.done')); ?></option>
                                    <option value="4" <?php echo e(request('status') == '4' ? 'selected' : ''); ?>><?php echo e(__('messages.outside_jurisdiction')); ?></option>
                                    <option value="5" <?php echo e(request('status') == '5' ? 'selected' : ''); ?>><?php echo e(__('messages.not_solved')); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="emergency" onchange="this.form.submit()">
                                    <option value=""><?php echo e(__('messages.all_types')); ?></option>
                                    <option value="1" <?php echo e(request('emergency') == '1' ? 'selected' : ''); ?>><?php echo e(__('messages.emergency')); ?></option>
                                    <option value="2" <?php echo e(request('emergency') == '2' ? 'selected' : ''); ?>><?php echo e(__('messages.regular')); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="gender" onchange="this.form.submit()">
                                    <option value=""><?php echo e(__('messages.all_genders')); ?></option>
                                    <option value="1" <?php echo e(request('gender') == '1' ? 'selected' : ''); ?>><?php echo e(__('messages.male')); ?></option>
                                    <option value="2" <?php echo e(request('gender') == '2' ? 'selected' : ''); ?>><?php echo e(__('messages.female')); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" 
                                           placeholder="<?php echo e(__('messages.search_by_name_or_phone')); ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <?php if(request()->hasAny(['search', 'status', 'emergency', 'gender'])): ?>
                                            <a href="<?php echo e(route('adminComplaints.index')); ?>" class="btn btn-outline-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Results Info -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted">
                                <?php echo e(__('messages.showing')); ?> <?php echo e($complaints->firstItem() ?? 0); ?> <?php echo e(__('messages.to')); ?> <?php echo e($complaints->lastItem() ?? 0); ?> 
                                <?php echo e(__('messages.of')); ?> <?php echo e($complaints->total()); ?> <?php echo e(__('messages.results')); ?>

                            </p>
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
                                    <th><?php echo e(__('messages.number')); ?></th>
                                    <th>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" 
                                           class="text-white text-decoration-none">
                                            <?php echo e(__('messages.name')); ?>

                                            <?php if(request('sort') == 'name'): ?>
                                                <i class="fas fa-sort-<?php echo e(request('direction', 'desc') == 'asc' ? 'up' : 'down'); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th><?php echo e(__('messages.phone')); ?></th>
                                    <th><?php echo e(__('messages.age')); ?></th>
                                    <th><?php echo e(__('messages.gender')); ?></th>
                                    <th><?php echo e(__('messages.status')); ?></th>
                                    <th><?php echo e(__('messages.emergency')); ?></th>
                                    <th><?php echo e(__('messages.service')); ?></th>
                                    <th><?php echo e(__('messages.place')); ?></th>
                                    <th><?php echo e(__('messages.details')); ?></th>
                                    <th><?php echo e(__('messages.photos')); ?></th>
                                    <th><?php echo e(__('messages.video')); ?></th>
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
                                <?php $__empty_1 = true; $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($complaint->id); ?></td>
                                    <td>
                                        <span class="badge badge-info">#<?php echo e($complaint->number); ?></span>
                                    </td>
                                    <td>
                                        <?php if($complaint->hide_information == 1): ?>
                                            <i class="fas fa-eye-slash text-muted" title="<?php echo e(__('messages.information_hidden')); ?>"></i>
                                            <?php echo e($complaint->name); ?>

                                        <?php else: ?>
                                            <?php echo e($complaint->name); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($complaint->phone); ?></td>
                                    <td><?php echo e($complaint->age); ?></td>
                                    <td>
                                        <?php if($complaint->gender == 1): ?>
                                            <span class="badge badge-primary"><?php echo e(__('messages.male')); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-pink"><?php echo e(__('messages.female')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php switch($complaint->status):
                                            case (1): ?>
                                                <span class="badge badge-warning"><?php echo e(__('messages.pending')); ?></span>
                                                <?php break; ?>
                                            <?php case (2): ?>
                                                <span class="badge badge-info"><?php echo e(__('messages.work_on_it')); ?></span>
                                                <?php break; ?>
                                            <?php case (3): ?>
                                                <span class="badge badge-success"><?php echo e(__('messages.done')); ?></span>
                                                <?php break; ?>
                                            <?php case (4): ?>
                                                <span class="badge badge-secondary"><?php echo e(__('messages.outside_jurisdiction')); ?></span>
                                                <?php break; ?>
                                            <?php case (5): ?>
                                                <span class="badge badge-danger"><?php echo e(__('messages.not_solved')); ?></span>
                                                <?php break; ?>
                                        <?php endswitch; ?>
                                    </td>
                                    <td>
                                        <?php if($complaint->is_complaint_emergency == 1): ?>
                                            <span class="badge badge-danger">
                                                <i class="fas fa-exclamation-triangle"></i> <?php echo e(__('messages.emergency')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-light"><?php echo e(__('messages.regular')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline"><?php echo e(__('messages.service')); ?>: <?php echo e($complaint->service->title_ar); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline"><?php echo e(__('messages.place')); ?>: <?php echo e($complaint->placeComplaint->name_ar); ?></span>
                                        <?php if($complaint->address_details): ?>
                                            <br><small class="text-muted"><?php echo e(Str::limit($complaint->address_details, 30)); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;" title="<?php echo e($complaint->complaint_details); ?>">
                                            <?php echo e(Str::limit($complaint->complaint_details, 50)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                            // Safely decode JSON and ensure we have arrays
                                            $photos = json_decode($complaint->photo, true);
                                            if (!is_array($photos)) {
                                                $photos = [];
                                            }
                                            
                                            $anotherPhotos = [];
                                            if ($complaint->another_photo) {
                                                $anotherPhotos = json_decode($complaint->another_photo, true);
                                                if (!is_array($anotherPhotos)) {
                                                    $anotherPhotos = [];
                                                }
                                            }
                                            
                                            $totalPhotos = count($photos) + count($anotherPhotos);
                                        ?>
                                        
                                        <?php if($totalPhotos > 0): ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#photosModal<?php echo e($complaint->id); ?>">
                                                <i class="fas fa-images"></i> <?php echo e($totalPhotos); ?> <?php echo e(__('messages.photos')); ?>

                                            </button>

                                            <!-- Photos Modal -->
                                            <div class="modal fade" id="photosModal<?php echo e($complaint->id); ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo e(__('messages.complaint_photos')); ?> - #<?php echo e($complaint->number); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <?php if(is_array($photos) && count($photos) > 0): ?>
                                                                    <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="col-md-4 mb-3">
                                                                            <img src="<?php echo e(asset('assets/admin/uploads/' . trim($photo, '"'))); ?>" class="img-fluid rounded" alt="<?php echo e(__('messages.complaint_photo')); ?>" style="max-height: 200px; object-fit: cover;">
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                                
                                                                <?php if(is_array($anotherPhotos) && count($anotherPhotos) > 0): ?>
                                                                    <?php $__currentLoopData = $anotherPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="col-md-4 mb-3">
                                                                            <img src="<?php echo e(asset('assets/admin/uploads/' . trim($photo, '"'))); ?>" class="img-fluid rounded" alt="<?php echo e(__('messages.additional_photo')); ?>" style="max-height: 200px; object-fit: cover;">
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted"><?php echo e(__('messages.no_photos')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($complaint->video): ?>
                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#videoModal<?php echo e($complaint->id); ?>">
                                                <i class="fas fa-video"></i> <?php echo e(__('messages.view')); ?>

                                            </button>

                                            <!-- Video Modal -->
                                            <div class="modal fade" id="videoModal<?php echo e($complaint->id); ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo e(__('messages.complaint_video')); ?> - #<?php echo e($complaint->number); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                        </div>
                                                        <div class="modal-body">
                                                            <video width="100%" controls>
                                                                <source src="<?php echo e(asset('assets/admin/uploads/' . $complaint->video)); ?>" type="video/mp4">
                                                                <?php echo e(__('messages.browser_not_support_video')); ?>

                                                            </video>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted"><?php echo e(__('messages.no_video')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small><?php echo e(\Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d H:i')); ?></small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-success" title="<?php echo e(__('messages.view_location')); ?>" onclick="showLocation(<?php echo e($complaint->lat); ?>, <?php echo e($complaint->lng); ?>)">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="15" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted"><?php echo e(__('messages.no_complaints_found')); ?></h5>
                                            <p class="text-muted"><?php echo e(__('messages.no_complaints_to_display')); ?></p>
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
                            <?php echo e($complaints->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('messages.complaint_location')); ?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
// Show location function using free OpenStreetMap
function showLocation(lat, lng) {
    $('#locationModal').modal('show');
    
    // Initialize map when modal is shown
    $('#locationModal').on('shown.bs.modal', function () {
        // Clear any existing map content
        document.getElementById('map').innerHTML = '';
        
        // Use free OpenStreetMap
        var mapHtml = 
            '<div style="position: relative; height: 100%;">' +
            '<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" ' +
            'src="https://www.openstreetmap.org/export/embed.html?bbox=' + 
            (lng-0.01) + '%2C' + (lat-0.01) + '%2C' + (lng+0.01) + '%2C' + (lat+0.01) + 
            '&layer=mapnik&marker=' + lat + '%2C' + lng + '"></iframe>' +
            '<div style="position: absolute; top: 10px; right: 10px; background: white; padding: 5px 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">' +
            '<a href="https://www.openstreetmap.org/?mlat=' + lat + '&mlon=' + lng + '#map=15/' + lat + '/' + lng + '" target="_blank" style="text-decoration: none; color: #007bff;">' +
            '<i class="fas fa-external-link-alt"></i> <?php echo e(__('messages.view_in_openstreetmap')); ?>' +
            '</a>' +
            '</div>' +
            '</div>';
            
        document.getElementById('map').innerHTML = mapHtml;
    });
}
</script>

<style>
.badge-pink {
    background-color: #e91e63;
    color: white;
}

.badge-outline {
    background-color: transparent;
    border: 1px solid #dee2e6;
    color: #6c757d;
}

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
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/complaints/index.blade.php ENDPATH**/ ?>