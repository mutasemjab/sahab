<?php $__env->startSection('title', __('messages.create') . ' ' . __('messages.Galleries')); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo e(__('messages.create')); ?> <?php echo e(__('messages.Galleries')); ?></h1>
    <a href="<?php echo e(route('galleries.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('galleries.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label for="photo" class="form-label"><?php echo e(__('messages.photos')); ?> (Multiple)</label>
                <input type="file" class="form-control <?php $__errorArgs = ['photo.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       id="photo" name="photo[]" accept="image/*" multiple required>
                <?php $__errorArgs = ['photo.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="text-muted">You can select multiple images</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><?php echo e(__('messages.videos')); ?> (URLs)</label>
                <div id="video-container">
                    <div class="input-group mb-2">
                        <input type="url" class="form-control <?php $__errorArgs = ['video.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="video[]" placeholder="https://youtube.com/watch?v=..." required>
                        <button type="button" class="btn btn-outline-secondary" onclick="addVideoField()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <?php $__errorArgs = ['video.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="text-muted">Enter video URLs (YouTube, Vimeo, etc.)</small>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="<?php echo e(route('galleries.index')); ?>" class="btn btn-secondary me-2">
                    <?php echo e(__('messages.cancel')); ?>

                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?php echo e(__('messages.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addVideoField() {
    const container = document.getElementById('video-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="url" class="form-control" name="video[]" placeholder="https://youtube.com/watch?v=..." required>
        <button type="button" class="btn btn-outline-danger" onclick="removeVideoField(this)">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeVideoField(button) {
    button.parentElement.remove();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/galleries/create.blade.php ENDPATH**/ ?>