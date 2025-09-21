<header class="header-container">
    <div class="header-logo">
        <img src="<?php echo e(asset('assets/admin/uploads/' . $setting->logo)); ?>" alt="<?php echo e(__('front.sahab_logo_alt')); ?>">
    </div>

    <div class="header-menu">

        <div class="dropdown">
            <a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about', 'projects') ? 'active' : ''); ?>">
                <?php echo e(__('front.about_municipality')); ?> <i class="fas fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu">
                <a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>">عن البلدية</a>
                <a href="<?php echo e(route('projects')); ?>"
                    class="<?php echo e(request()->routeIs('projects') ? 'active' : ''); ?>">المشاريع</a>
            </div>
        </div>

        <a href="<?php echo e(route('services')); ?>" class="<?php echo e(request()->routeIs('services') ? 'active' : ''); ?>">
            <?php echo e(__('front.services')); ?>

        </a>
        <a href="<?php echo e(route('wbsiteTenders.index')); ?>"
            class="<?php echo e(request()->routeIs('wbsiteTenders.index') ? 'active' : ''); ?>">
            <?php echo e(__('front.Tenders')); ?>

        </a>
       
          <a href="<?php echo e(route('community.index')); ?>"
            class="<?php echo e(request()->routeIs('community.index') ? 'active' : ''); ?>">تفاصيل المجتمع</a>

       

        <div class="dropdown">
            <a href="<?php echo e(route('complaints.index')); ?>"
                class="<?php echo e(request()->routeIs('complaints.index', 'complaintdetails', 'complaintfollow') ? 'active' : ''); ?>">
                <?php echo e(__('front.complaints')); ?> <i class="fas fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu">
                <a href="<?php echo e(route('complaints.index')); ?>"
                    class="<?php echo e(request()->routeIs('complaints.index') ? 'active' : ''); ?>">تقديم شكوى</a>
                <a href="<?php echo e(route('complaintdetails')); ?>"
                    class="<?php echo e(request()->routeIs('complaintdetails') ? 'active' : ''); ?>">تفاصيل الشكوى</a>
                <a href="<?php echo e(route('complaintfollow')); ?>"
                    class="<?php echo e(request()->routeIs('complaintfollow') ? 'active' : ''); ?>">تتبع شكواك</a>
            </div>
        </div>

        <a href="<?php echo e(route('media.center')); ?>" class="<?php echo e(request()->routeIs('media.center') ? 'active' : ''); ?>">
            <?php echo e(__('front.media_center')); ?>

        </a>

        <a href="<?php echo e(route('newListen.index')); ?>" class="<?php echo e(request()->routeIs('newListen.index') ? 'active' : ''); ?>">
            <?php echo e(__('front.listen_sessions')); ?>

        </a>

        <a href="<?php echo e(route('contact.index')); ?>" class="<?php echo e(request()->routeIs('contact.index') ? 'active' : ''); ?>">
            <?php echo e(__('front.contact_us')); ?>

        </a>
    </div>



    <div class="header-icons">
        <?php
            $icons = App\Models\IconHeader::get();
        ?>
        <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($icon->link); ?>" target="_blank">
                <i class="<?php echo e($icon->icon); ?>"></i>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button class="search-trigger" type="button" aria-label="Search" onclick="openSearchPopup()">
            <i class="fas fa-search"></i>
        </button>

        <div id="searchOverlay" class="search-overlay" aria-hidden="true">
            <div class="search-popup" role="dialog" aria-modal="true">
                <div class="search-popup-body">This feature will be available soon</div>
                <button class="search-close" type="button" aria-label="Close" onclick="closeSearchPopup()">✕</button>
            </div>
        </div>


        <div class="custom-dropdown" id="langDropdown">
            <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false"
                onclick="toggleLangMenu(event)">
                <i class="fas fa-globe"></i> <?php echo e(__('Language')); ?>

            </button>

            <ul class="dropdown-menu" id="langMenu" style="top:100%;list-style:none; margin-top:0; /* إزالة الفجوة */">
                <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="dropdown-item" hreflang="<?php echo e($localeCode); ?>"
                            href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

    .header-menu a.active {
        font-weight: 900;
        color: #10503d;
    }

    .header-menu .dropdown-menu a.active {
        font-weight: bold;
        background-color: #f0f8ff;
        color: #3490dc;
    }


    :root {
        --brand: #3490dc;
        --overlay-bg: rgba(20, 25, 35, .55)
    }

    .search-trigger {
        background: transparent;
        border: 0;
        padding: 8px;
        border-radius: 10px;
        cursor: pointer;
        transition: transform .12s ease, box-shadow .2s ease, background .2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center
    }

    .search-trigger i {
        font-size: 18px;
        color: #2c3a47;
        transition: color .2s ease
    }

    .search-trigger:hover {
        transform: translateY(1px) scale(.97);
        background: rgba(52, 144, 220, .08);
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, .08)
    }

    .search-trigger:active {
        transform: translateY(2px) scale(.94);
        box-shadow: inset 0 3px 10px rgba(0, 0, 0, .12)
    }

    .search-trigger:hover i {
        color: var(--brand)
    }

    .search-overlay {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 3000;
        background: var(--overlay-bg);
        backdrop-filter: blur(8px) saturate(115%);
        -webkit-backdrop-filter: blur(8px) saturate(115%)
    }

    .search-overlay.active {
        display: flex;
        animation: overlayFade .18s ease
    }

    @keyframes overlayFade {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    .search-popup {
        position: relative;
        max-width: 420px;
        width: calc(100% - 32px);
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .22), 0 6px 18px rgba(0, 0, 0, .10);
        transform-origin: center;
        animation: popupIn .22s cubic-bezier(.2, .7, .2, 1.1)
    }

    @keyframes popupIn {
        from {
            opacity: 0;
            transform: scale(.88) translateY(8px)
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0)
        }
    }

    .search-popup-body {
        padding: 26px 28px 26px 28px;
        font-size: 16px;
        font-weight: 700;
        text-align: center;
        color: #2c3a47;
        letter-spacing: .2px
    }

    .search-close {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: 0;
        background: #f3f5f7;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform .16s ease, background .2s ease, box-shadow .2s ease
    }

    .search-close:hover {
        background: #e9eef3;
        transform: scale(.96)
    }

    .search-close:active {
        transform: scale(.92)
    }

    @media (prefers-reduced-motion:reduce) {
        .search-overlay.active {
            animation: none
        }

        .search-popup {
            animation: none
        }

        .search-trigger,
        .search-close {
            transition: none
        }
    }
</style>

<script>
    let searchOpen = false;

    function openSearchPopup() {
        if (searchOpen) return;
        const o = document.getElementById('searchOverlay');
        o.classList.add('active');
        o.setAttribute('aria-hidden', 'false');
        document.documentElement.style.overflow = 'hidden';
        searchOpen = true;
        setTimeout(() => {
            if (searchOpen) closeSearchPopup();
        }, 2200);
    }

    function closeSearchPopup() {
        const o = document.getElementById('searchOverlay');
        o.classList.remove('active');
        o.setAttribute('aria-hidden', 'true');
        document.documentElement.style.overflow = '';
        searchOpen = false;
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && searchOpen) closeSearchPopup();
    });
    document.addEventListener('click', e => {
        const o = document.getElementById('searchOverlay');
        if (!o) return;
        if (searchOpen && e.target === o) closeSearchPopup();
    });
</script>

<script>
    function toggleLangMenu(e) {
        e.preventDefault();
        e.stopPropagation();
        const dd = document.getElementById('langDropdown');
        const menu = document.getElementById('langMenu');
        const open = menu.style.display === 'block';
        menu.style.display = open ? '' : 'block';
        e.currentTarget.setAttribute('aria-expanded', open ? 'false' : 'true');
    }

    // اغلاق عند الضغط خارج القائمة
    document.addEventListener('click', function(e) {
        const dd = document.getElementById('langDropdown');
        const menu = document.getElementById('langMenu');
        if (!dd.contains(e.target)) {
            menu.style.display = '';
            const btn = dd.querySelector('.dropdown-toggle');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/includes/navbar.blade.php ENDPATH**/ ?>