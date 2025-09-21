<footer class="main-footer">
    <div class="footer-top">
        
        <?php
            $aboutLinks = \App\Models\FooterSetting::where('section', 'about_municipality')
                                                  ->where('is_active', true)
                                                  ->orderBy('order')
                                                  ->get();
        ?>
        
        <?php if($aboutLinks->count() > 0): ?>
        <div class="footer-col">
            <h3><?php echo e(__('front.about_municipality')); ?></h3>
            <ul>
                <?php $__currentLoopData = $aboutLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route($link->route_name)); ?>"><?php echo e(__($link->title)); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        
        <?php
            $quickLinks = \App\Models\FooterSetting::where('section', 'quick_links')
                                                   ->where('is_active', true)
                                                   ->orderBy('order')
                                                   ->get();
        ?>
        
        <?php if($quickLinks->count() > 0): ?>
        <div class="footer-col">
            <h3><?php echo e(__('front.quick_links')); ?></h3>
            <ul>
                <?php $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route($link->route_name)); ?>"><?php echo e(__($link->title)); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        
        <div class="footer-col">
            <h3><?php echo e(__('front.contact_us')); ?></h3>
            <p><i class="fas fa-phone-alt"></i> <?php echo e($setting->phone); ?></p>
            <p><i class="fas fa-envelope"></i> <?php echo e($setting->email); ?></p>
            <div class="social-icons">
                <a href="<?php echo e($setting->twitter); ?>"><i class="fab fa-twitter"></i></a>
                <a href="<?php echo e($setting->instagram); ?>"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo e($setting->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>

        
        <div class="footer-col newsletter">
            <h3><?php echo e(__('front.newsletter')); ?></h3>
            <form id="newsletter-form" class="newsletter-form">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="<?php echo e(__('front.enter_email')); ?>" required>
                <button type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
            <div id="newsletter-message" style="display: none; margin-top: 10px;"></div>
        </div>

        <script>
            document.getElementById('newsletter-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = this;
                const messageDiv = document.getElementById('newsletter-message');
                const submitBtn = form.querySelector('button');
                const email = form.querySelector('input[name="email"]').value;

                // Disable button during request
                submitBtn.disabled = true;

                fetch('<?php echo e(route('newsletter.subscribe')); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            messageDiv.innerHTML = '<div style="color: green;">' + data.message + '</div>';
                            form.reset();
                        } else {
                            messageDiv.innerHTML = '<div style="color: red;">' + (data.message ||
                                'An error occurred') + '</div>';
                        }
                        messageDiv.style.display = 'block';
                    })
                    .catch(error => {
                        messageDiv.innerHTML =
                        '<div style="color: red;">An error occurred. Please try again.</div>';
                        messageDiv.style.display = 'block';
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                    });
            });
        </script>
    </div>

    <div class="footer-bottom">
        <?php echo e(__('front.copyright')); ?>

    </div>
</footer><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/includes/footer.blade.php ENDPATH**/ ?>