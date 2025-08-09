<header class="header-container">
  <div class="header-logo">
    <img src="<?php echo e(asset('assets/admin/uploads/' . $setting->photo)); ?>" alt="<?php echo e(__('front.sahab_logo_alt')); ?>">
  </div>

<div class="header-menu">
    
    <div class="dropdown">
        <a href="<?php echo e(route('about')); ?>"><?php echo e(__('front.about_municipality')); ?> <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
            <a href="<?php echo e(route('about')); ?>">عن البلدية</a>
            <a href="<?php echo e(route('projects')); ?>">المشاريع</a>
        </div>
    </div>
    
    <a href="<?php echo e(route('services')); ?>"><?php echo e(__('front.services')); ?> </a>
    
    <div class="dropdown">
        <a href="<?php echo e(route('community.index')); ?>"><?php echo e(__('front.community')); ?> <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
             <a href="<?php echo e(route('community.index')); ?>">تفاصيل المجتمع</a>
            <a href="<?php echo e(route('suggestion')); ?>">اقتراحات</a>
           
        </div>
    </div>

    <div class="dropdown">
        <a href="<?php echo e(route('complaints.index')); ?>"><?php echo e(__('front.complaints')); ?> <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
            <a href="<?php echo e(route('complaints.index')); ?>">تقديم شكوى</a>
            <a href="<?php echo e(route('complaintdetails')); ?>">تفاصيل الشكوى</a>
            <a href="<?php echo e(route('complaintfollow')); ?>">تتبع شكواك</a>
        </div>
    </div>

    <a href="<?php echo e(route('media.center')); ?>"><?php echo e(__('front.media_center')); ?></a>
    <a href="<?php echo e(route('contact.index')); ?>"><?php echo e(__('front.contact_us')); ?></a>
</div>


  <div class="header-icons">
    <i class="fas fa-search"></i>
<div class="custom-dropdown">
    <button class="dropdown-toggle">
        <i class="fas fa-globe"></i> <?php echo e(__('Language')); ?>

    </button>
    <ul class="dropdown-menu">
        <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="dropdown-item" hreflang="<?php echo e($localeCode); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                    <?php echo e($properties['native']); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>


    <a href="<?php echo e(route('community.index')); ?>"><i class="fas fa-universal-access"></i></a>
  </div>

  <div class="mobile-menu-icon" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </div>
<div class="mobile-nav" id="mobileNav">
    <!-- About & Projects -->
    <div class="mobile-section">
        <div class="mobile-main">
            <?php echo e(__('front.about_municipality')); ?>

        </div>
        <div class="mobile-sub">
            <div><a href="<?php echo e(route('about')); ?>">عن البلدية</a></div>
            <div><a href="<?php echo e(route('projects')); ?>">المشاريع</a></div>
        </div>
    </div>

    <!-- Services -->
    <div class="mobile-section">
        <div class="mobile-main">
            <a href="<?php echo e(route('services')); ?>"><?php echo e(__('front.services')); ?></a>
        </div>
    </div>

    <!-- Community -->
    <div class="mobile-section">
        <div class="mobile-main">
            <?php echo e(__('front.community')); ?>

        </div>
        <div class="mobile-sub">
            <div><a href="<?php echo e(route('community.index')); ?>">تفاصيل المجتمع</a></div>
            <div><a href="<?php echo e(route('suggestion')); ?>">اقتراحات</a></div>
        </div>
    </div>

    <!-- Complaints -->
    <div class="mobile-section">
        <div class="mobile-main">
            <?php echo e(__('front.complaints')); ?>

        </div>
        <div class="mobile-sub">
            <div><a href="<?php echo e(route('complaints.index')); ?>">تقديم شكوى</a></div>
            <div><a href="<?php echo e(route('complaintdetails')); ?>">تفاصيل الشكوى</a></div>
            <div><a href="<?php echo e(route('complaintfollow')); ?>">تتبع شكواك</a></div>
        </div>
    </div>

    <!-- Media Center -->
    <div class="mobile-section">
        <div class="mobile-main">
            <a href="<?php echo e(route('media.center')); ?>"><?php echo e(__('front.media_center')); ?></a>
        </div>
    </div>

    <!-- Contact Us -->
    <div class="mobile-section">
        <div class="mobile-main">
            <a href="<?php echo e(route('contact.index')); ?>"><?php echo e(__('front.contact_us')); ?></a>
        </div>
    </div>
</div>

</header>

<style>
  .custom-dropdown {
    position: relative;
    display: inline-block;
}

.custom-dropdown .dropdown-toggle {
    background-color: #3490dc;
    color: #fff;
    padding: 10px 16px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}

.custom-dropdown .dropdown-menu {
    display: none;
    position: absolute;
    top: 110%;
    left: 0;
    background-color: #fff;
    min-width: 140px;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 1000;
}

.custom-dropdown:hover .dropdown-menu {
    display: block;
}

.custom-dropdown .dropdown-item {
    color: #333;
    padding: 10px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.2s ease;
}

.custom-dropdown .dropdown-item:hover {
    background-color: #f5f5f5;
}

.header-menu {
    display: flex;
    gap: 20px;
    position: relative;
}

.header-menu .dropdown {
    position: relative;
}

.header-menu .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    min-width: 180px;
    z-index: 1000;
}

.header-menu .dropdown-menu a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s;
}

.header-menu .dropdown-menu a:hover {
    background: #f2f2f2;
}


.header-menu .dropdown:hover .dropdown-menu {
    display: block;
}

.mobile-nav {
    display: none;
    flex-direction: column;
    background: #fff;
    padding: 15px;
    border-top: 1px solid #ddd;
}


.mobile-section {
    margin-bottom: 15px;
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 10px;
}

.mobile-main {
    font-size: 18px;
    font-weight: bold;
    color: #2c3a47;
    margin-bottom: 8px;
}


.mobile-main a {
    color: #2c3a47;
    text-decoration: none;
    display: block;
    padding: 5px 0;
}


.mobile-sub div {
    margin-bottom: 5px;
}

.mobile-sub a {
    display: block;
    font-size: 15px;
    color: #555;
    padding: 6px 10px;
    border-radius: 6px;
    background: #f8f8f8;
    text-decoration: none;
    transition: background 0.3s;
}

.mobile-sub a:hover {
    background: #e9e9e9;
}


@media (max-width: 991px) {
    .mobile-nav {
        display: none;
    }
}

@media (max-width: 768px) {
  .header-menu {
    display: none !important;
  }
}
  </style>
<?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/includes/navbar.blade.php ENDPATH**/ ?>