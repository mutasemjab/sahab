 

 <?php $__env->startSection('content'); ?>
     <section class="hero-slider">
         <div class="slides">
             <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="slide <?php echo e($index == 0 ? 'active' : ''); ?>"
                     style="background-image: url('<?php echo e(asset('assets/admin/uploads/' . $banner->photo)); ?>');">
                     <div class="slide-content">
                         <h2><?php echo e($banner->{'title_' . $locale}); ?></h2>
                         <p><?php echo $banner->{'description_' . $locale}; ?></p>
                     </div>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

         <div class="slider-controls">
             <span class="prev">&#10094;</span>
             <span class="next">&#10095;</span>
         </div>
         
         <div class="slider-dots">
             <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <span class="dot <?php echo e($index == 0 ? 'active' : ''); ?>" onclick="goToSlide(<?php echo e($index); ?>)"></span>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
     </section>

     <?php if($about): ?>
         <section class="about-section">
             <h2 class="about-h"><?php echo e(__('front.about_municipality')); ?></h2>
             <div class="about-container">
                 <div class="about-content">
                     <p>
                     <?php echo $about->{'description_' . $locale}; ?>

                     </p>
                     <a href="<?php echo e(route('about')); ?>" class="about-btn"><?php echo e(__('front.learn_more')); ?></a>
                 </div>
                 <div class="about-image">
                     <img src="<?php echo e(asset('assets/admin/uploads/' . $about->photo)); ?>"
                         alt="<?php echo e(__('front.about_municipality')); ?>">
                 </div>
             </div>
         </section>
     <?php endif; ?>

     <section class="calendar-section">
         <h2 class="calendar-title"><?php echo e(__('front.events_calendar')); ?></h2>
         <div class="calendar-header">
             <button onclick="prevMonth()">&#10094;</button>
             <span id="calendar-month"></span>
             <button onclick="nextMonth()">&#10095;</button>
         </div>
         <div class="calendar-subtitle" id="calendar-selected-date"></div>
         <div class="calendar-grid" id="calendar-grid"></div>
     </section>

     <section class="services-section">
         <h2 class="section-title"><?php echo e(__('front.our_services')); ?></h2>

         <div class="services-grid">
             <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="service-card">
                     <div class="service-icon">
                         <i class="<?php echo e($service->icon); ?>"></i>
                     </div>
                     <h3><?php echo e($service->{'title_' . $locale}); ?></h3>
                     <p><?php echo $service->{'description_' . $locale}; ?></p>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

         <a href="<?php echo e(route('services')); ?>" class="services-btn"><?php echo e(__('front.learn_more')); ?></a>
     </section>

     <section class="sessions-section">
         <h2 class="section-title"><?php echo e(__('front.upcoming_public_sessions')); ?></h2>

         <div class="sessions-grid">
             <?php $__currentLoopData = $publicSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="session-card">
                     <div>
                         <div class="session-header">
                            <span class="session-date">
                                <?php echo e(\Carbon\Carbon::parse($session->date_of_event)->locale('ar')->translatedFormat('j F Y')); ?>

                            </span>
                            
                             <span class="session-status <?php echo e($session->type == 1 ? 'open' : 'coming'); ?>">
                                 <?php echo e($session->type == 1 ? __('front.open') : __('front.coming_soon')); ?>

                             </span>


                         </div>
                         <h3><?php echo e($session->{'title_' . $locale}); ?></h3>
                         <p><?php echo $session->{'description_' . $locale}; ?></p>
                     </div>
                     <div>
                       <?php if($session->from_time): ?>
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
                        <?php endif; ?>
                        <a href="#"> <button class="session-btn <?php echo e($session->type != 1 ? 'disabled' : ''); ?>"
                             <?php echo e($session->type != 1 ? 'disabled' : ''); ?>>
                             <?php echo e($session->type == 1 ? __('front.join_session') : __('front.learn_more')); ?>

                         </button></a>
                     </div>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

         <div class="more-btn-wrapper">
             <a href="<?php echo e(route('services')); ?>" class="services-btn"><?php echo e(__('front.more')); ?></a>
         </div>
     </section>

     <section class="projects-section">
         <h2 class="section-title"><?php echo e($locale == 'ar' ? 'المشاريع' : 'Projects'); ?></h2>

         <div class="projects-grid">
             <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="project-card">
                     <div class="project-image">
                         <img src="<?php echo e(asset('assets/admin/uploads/' . $project->photo)); ?>"
                             alt="<?php echo e($project->{'title_' . $locale}); ?>">
                         <span class="project-tag">
                             <?php if($project->type == 1): ?>
                                 <?php echo e($locale == 'ar' ? 'مكتمل' : 'Completed'); ?>

                             <?php elseif($project->type == 2): ?>
                                 <?php echo e($locale == 'ar' ? 'جاري التنفيذ' : 'Ongoing'); ?>

                             <?php else: ?>
                                 <?php echo e($locale == 'ar' ? 'مخطط لها' : 'Planned'); ?>

                             <?php endif; ?>
                         </span>
                     </div>
                     <div class="project-content">
                         <h3><?php echo e($project->{'title_' . $locale}); ?></h3>
                         <p><?php echo $project->{'description_' . $locale}; ?></p>
                         <?php if($project->time): ?>
                             <p class="start-date"><?php echo e($locale == 'ar' ? 'بدءًا من:' : 'Starting from:'); ?>

                                 <?php echo e($project->time); ?></p>
                         <?php endif; ?>
                         <a href="#" class="project-link">
                             <?php echo e($locale == 'ar' ? 'اعرف المزيد' : 'Learn More'); ?>

                             <i class="fas fa-arrow-left"></i>
                             </a>
                     </div>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

         <div class="more-btn-wrapper">
             <a href="<?php echo e(route('services')); ?>" class="services-btn"><?php echo e($locale == 'ar' ? 'المزيد' : 'More'); ?></a>
         </div>
     </section>

     <section class="news-section">
         <h2 class="section-title"><?php echo e($locale == 'ar' ? 'الأخبار و الاعلانات' : 'News & Announcements'); ?></h2>

         <div class="news-grid">
             <?php $__currentLoopData = $advs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="news-card">
                     <img src="<?php echo e(asset('assets/admin/uploads/' . $adv->photo)); ?>" alt="<?php echo e($adv->{'title_' . $locale}); ?>">
                     <div class="news-content">
                         <span class="news-date"> <?php echo e(\Carbon\Carbon::parse($session->date_of_adv)->locale('ar')->translatedFormat('j F Y')); ?></span>
                         <h3><?php echo e($adv->{'title_' . $locale}); ?></h3>
                         <p><?php echo Str::limit($adv->{'description_' . $locale}, 60); ?>...</p>
                         <a href="#" class="news-link">
                             <?php echo e($locale == 'ar' ? 'اقرأ المزيد' : 'Read More'); ?>

                             <i class="fas fa-arrow-left"></i>
                             </a>
                     </div>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

         <div class="more-btn-wrapper">
             <a href="<?php echo e(route('services')); ?>" class="services-btn"><?php echo e($locale == 'ar' ? 'المزيد' : 'More'); ?></a>
         </div>
     </section>

     <section class="quick-access">
         <h2 class="section-title"><?php echo e(__('front.quick_access')); ?></h2>

         <div class="quick-grid">
             <a href="<?php echo e(route('contact.index')); ?>">
             <div class="quick-card">
                 <i class="fas fa-map-marked-alt"></i>
                 <span><?php echo e(__('front.maps')); ?></span>
             </div>
              </a>

             <a href="<?php echo e(route('contact.index')); ?>">
             <div class="quick-card">
                 <i class="fas fa-phone-alt"></i>
                 <span><?php echo e(__('front.contact_guide')); ?></span>
             </div>
              </a>
              
             <a href="<?php echo e(route('questions')); ?>">
                <div class="quick-card">
                 <i class="fas fa-info-circle"></i>
                 <span><?php echo e(__('front.faq')); ?></span>
             </div>
             </a>
             <div class="quick-card">
                 <i class="fas fa-calendar-alt"></i>
                 <span><?php echo e(__('front.event_calendar')); ?></span>
             </div>
         </div>
     </section>

     <script>
         // القائمة الجانبية للموبايل
         function toggleMenu() {
             document.getElementById('mobileNav').classList.toggle('active');
         }

         // سلايدر الصور
         let currentSlide = 0;
         const slides = document.querySelectorAll(".slide");
         const dots = document.querySelectorAll(".dot");

         function showSlide(index) {
             slides.forEach((slide, i) => {
                 slide.classList.remove("active");
                 dots[i].classList.remove("active");
             });
             slides[index].classList.add("active");
             dots[index].classList.add("active");
         }

         function nextSlide() {
             currentSlide = (currentSlide + 1) % slides.length;
             showSlide(currentSlide);
         }

         function prevSlide() {
             currentSlide = (currentSlide - 1 + slides.length) % slides.length;
             showSlide(currentSlide);
         }

         function goToSlide(index) {
             currentSlide = index;
             showSlide(currentSlide);
         }

         document.addEventListener("DOMContentLoaded", function() {
             if (document.querySelector(".next")) {
                 document.querySelector(".next").onclick = nextSlide;
             }
             if (document.querySelector(".prev")) {
                 document.querySelector(".prev").onclick = prevSlide;
             }

             showSlide(currentSlide);
             setInterval(nextSlide, 10000);
         });

    // التقويم
const daysOfWeek = ["السبت", "الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة"];

// Get events data from Laravel
const events = <?php echo json_encode($events, 15, 512) ?>;

let currentDate = new Date();

function renderCalendar() {
    const grid = document.getElementById("calendar-grid");
    const monthSpan = document.getElementById("calendar-month");
    const selectedDateSpan = document.getElementById("calendar-selected-date");

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const day = currentDate.getDate();

    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const firstWeekday = (firstDay.getDay() + 1) % 7;
    const totalDays = lastDay.getDate();

    const monthNames = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر",
        "نوفمبر", "ديسمبر"
    ];
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];

    monthSpan.innerText = `${monthNames[month]} ${year}`;
    selectedDateSpan.innerText = `${daysOfWeek[(today.getDay()+6)%7]}، ${day} ${monthNames[month]}`;

    grid.innerHTML = "";

    for (let i = 0; i < firstWeekday; i++) {
        const empty = document.createElement("div");
        empty.className = "calendar-day empty-day";
        grid.appendChild(empty);
    }

    for (let i = 1; i <= totalDays; i++) {
        const fullDate = `${year}-${(month+1).toString().padStart(2, "0")}-${i.toString().padStart(2, "0")}`;
        const dayDiv = document.createElement("div");
        dayDiv.className = "calendar-day";

        if (fullDate === todayStr) {
            dayDiv.classList.add("today");
        }
        
        // Check if there's an event on this date
        const eventOnThisDate = events.find(event => event.date === fullDate);
        if (eventOnThisDate) {
            dayDiv.classList.add("event-day");
            dayDiv.innerHTML = `${i}<small>${eventOnThisDate.title}</small>`;
            
            // Make event day clickable and add cursor pointer style
            dayDiv.style.cursor = 'pointer';
            dayDiv.onclick = function() {
                if (eventOnThisDate.link_google_meet) {
                    window.open(eventOnThisDate.link_google_meet, '_blank');
                }
            };
        } else {
            dayDiv.innerText = i;
        }

        grid.appendChild(dayDiv);
    }
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

document.addEventListener("DOMContentLoaded", renderCalendar);
     </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/home.blade.php ENDPATH**/ ?>