<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('media.center')); ?>" class="active"><?php echo e(__('front.media_center')); ?></a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title"><?php echo e(__('front.media_center')); ?></h2>
    <p class="mutasem-subtitle"><?php echo e(__('front.media_center_subtitle')); ?></p>
  </div>
</section>

<section class="news-section">
  <h2 class="section-title"><?php echo e(__('front.advertisements')); ?></h2>

  <div class="projects-grid">
    <?php $__empty_1 = true; $__currentLoopData = $advertisements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertisement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="project-card">
      <div class="project-image">
        <img src="<?php echo e($advertisement->photo_url); ?>" alt="<?php echo e($advertisement->title); ?>">
      </div>
      <div class="project-content">
        <p class="start-date"><?php echo e($advertisement->formatted_date); ?></p>
        <h3><?php echo e($advertisement->title); ?></h3>
        <p><?php echo e(Str::limit($advertisement->description, 100)); ?></p>
        <p class="start-date"><?php echo e($advertisement->formatted_date); ?></p>
        <a href="#" class="project-link">
         <?php echo e(__('front.read_more')); ?>

         <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="no-data">
      <p><?php echo e(__('front.no_advertisements')); ?></p>
    </div>
    <?php endif; ?>
  </div>

  <?php if($advertisements->count() >= 6): ?>
  <div class="more-btn-wrapper">
    <a href="<?php echo e(route('advertisements.index')); ?>" class="services-btn"><?php echo e(__('front.more')); ?></a>
  </div>
  <?php endif; ?>
</section>

<section class="projects-section">
  <h2 class="section-title"><?php echo e(__('front.latest_news')); ?></h2>

  <div class="news-grid">
    <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="news-card">
      <img src="<?php echo e($newsItem->photo_url); ?>" alt="<?php echo e($newsItem->title); ?>">
      <div class="news-content">
        <span class="news-date"><?php echo e($newsItem->formatted_date); ?></span>
        <h3><?php echo e($newsItem->title); ?></h3>
        <p><?php echo e($newsItem->excerpt); ?></p>
        <a href="#" class="news-link">
         <?php echo e(__('front.read_more')); ?>

          <i class="fas fa-arrow-left"></i> 
        </a>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="no-data">
      <p><?php echo e(__('front.no_news')); ?></p>
    </div>
    <?php endif; ?>
  </div>

  <?php if($news->count() >= 6): ?>
  <div class="more-btn-wrapper">
    <a href="<?php echo e(route('news.index')); ?>" class="services-btn"><?php echo e(__('front.more')); ?></a>
  </div>
  <?php endif; ?>
</section>

<?php if($gallery && $gallery->photo_urls): ?>
<!-- معرض الصور -->
<section class="mutasem-gallery-section">
  <div class="mutasem-container">
    <h2 class="mutasem-gallery-title"><?php echo e(__('front.photo_gallery')); ?></h2>
    <div class="mutasem-gallery-grid">
      <?php $__currentLoopData = array_slice($gallery->photo_urls, 0, 8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <img src="<?php echo e($photo); ?>" alt="<?php echo e(__('front.gallery_image')); ?>" class="mutasem-gallery-img">
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if($gallery && $gallery->video_data): ?>
<!-- معرض الفيديو -->
<section class="mutasem-gallery-section video">
  <div class="mutasem-container">
    <h2 class="mutasem-gallery-title"><?php echo e(__('front.video_gallery')); ?></h2>
    <div class="mutasem-gallery-grid">
      <?php $__currentLoopData = array_slice($gallery->video_data, 0, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <!-- بطاقة فيديو -->
      <div class="mutasem-video-card" data-video-url="<?php echo e($video['video_url']); ?>" style="cursor: pointer;">
        <div class="mutasem-video-thumbnail">
          <img src="<?php echo e($video['thumbnail'] ?? 'https://img.youtube.com/vi/' . $video['youtube_id'] . '/maxresdefault.jpg'); ?>" alt="<?php echo e($video['title']); ?>">
          <span class="mutasem-play-icon">▶</span>
        </div>
        <div class="mutasem-video-info">
          <h4><?php echo e($video['title']); ?></h4>
          <p><?php echo e($video['date']); ?></p>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="mutasem-social-section">
  <h2 class="mutasem-gallery-title"><?php echo e(__('front.social_media_updates')); ?></h2>
  <div class="mutasem-container mutasem-social-grid">
    <!-- تويتر -->
    <div class="mutasem-social-card">
      <div class="mutasem-social-header">
        <svg width="20" height="20" fill="#1DA1F2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.4.36a9.1 9.1 0 0 1-2.86 1.09A4.52 4.52 0 0 0 16.11 0c-2.5 0-4.52 2.01-4.52 4.49 0 .35.04.7.11 1.03A12.87 12.87 0 0 1 3.13.67a4.5 4.5 0 0 0-.61 2.26c0 1.56.8 2.94 2.02 3.75A4.49 4.49 0 0 1 2 6.58v.06c0 2.19 1.56 4.02 3.63 4.44a4.52 4.52 0 0 1-2.03.08 4.52 4.52 0 0 0 4.22 3.13A9.06 9.06 0 0 1 0 19.54a12.78 12.78 0 0 0 6.95 2.03c8.34 0 12.9-6.9 12.9-12.89 0-.2 0-.4-.01-.6A9.1 9.1 0 0 0 23 3z"/>
        </svg>
        <span><?php echo e(__('front.twitter_feed')); ?></span>

      </div>
      <div class="mutasem-facebook-posts">
        <p><?php echo e(__('front.sample_social_post')); ?> #<?php echo e(__('front.sahab_municipality')); ?><br><span><?php echo e(__('front.two_hours_ago')); ?></span></p>
        <p><?php echo e(__('front.sample_social_post')); ?> #<?php echo e(__('front.sahab_municipality')); ?><br><span><?php echo e(__('front.two_hours_ago')); ?></span></p>
        <p><?php echo e(__('front.sample_social_post')); ?> #<?php echo e(__('front.sahab_municipality')); ?><br><span><?php echo e(__('front.two_hours_ago')); ?></span></p>
      </div>
    </div>

    <!-- فيسبوك -->
    <div class="mutasem-social-card">
      <div class="mutasem-social-header">
        <svg width="20" height="20" fill="#1877F2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898v-2.891h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
        </svg>
        <span><?php echo e(__('front.facebook_updates')); ?></span>

      </div>
      <div class="mutasem-facebook-posts">
        <p><?php echo e(__('front.sample_social_post')); ?> #<?php echo e(__('front.sahab_municipality')); ?><br><span><?php echo e(__('front.two_hours_ago')); ?></span></p>
        <p><?php echo e(__('front.sample_social_post')); ?> #<?php echo e(__('front.sahab_municipality')); ?><br><span><?php echo e(__('front.two_hours_ago')); ?></span></p>
        <p><?php echo e(__('front.sample_social_post')); ?> #<?php echo e(__('front.sahab_municipality')); ?><br><span><?php echo e(__('front.two_hours_ago')); ?></span></p>
      </div>
    </div>

    <!-- إنستغرام -->
    <div class="mutasem-social-card">
      <div class="mutasem-social-header">
        <svg width="20" height="20" fill="#d62976" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm10.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
        </svg>
        <span><?php echo e(__('front.instagram_feed')); ?></span>
      </div>
      <div class="mutasem-instagram-grid">
        <?php for($i = 0; $i < 4; $i++): ?>
        <img src="<?php echo e(asset('assets/Images/about.png')); ?>" alt="<?php echo e(__('front.instagram_post')); ?>">
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<!-- YouTube Video Modal -->
<div id="videoModal" class="video-modal">
  <div class="video-modal-content">
    <span class="video-modal-close">&times;</span>
    <div class="video-container">
      <iframe id="youtubeFrame" src="" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>

<style>
/* Modal Styles */
.video-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.video-modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 90%;
  max-width: 800px;
  background: #000;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.video-modal-close {
  position: absolute;
  top: -40px;
  right: 0;
  color: #fff;
  font-size: 30px;
  font-weight: bold;
  cursor: pointer;
  z-index: 10000;
  transition: color 0.3s;
}

.video-modal-close:hover {
  color: #ff4444;
}

.video-container {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

.video-container iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

/* Video card hover effect */
.mutasem-video-card:hover {
  transform: translateY(-5px);
  transition: transform 0.3s ease;
}

.mutasem-video-card:hover .mutasem-play-icon {
  transform: scale(1.2);
  transition: transform 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const videoCards = document.querySelectorAll('.mutasem-video-card[data-video-url]');
  const modal = document.getElementById('videoModal');
  const iframe = document.getElementById('youtubeFrame');
  const closeBtn = document.querySelector('.video-modal-close');

  // Function to extract YouTube video ID from URL
  function extractYouTubeId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
  }

  // Open modal when video card is clicked
  videoCards.forEach(card => {
    card.addEventListener('click', function() {
      const videoUrl = this.getAttribute('data-video-url');
      const youtubeId = extractYouTubeId(videoUrl);
      
      if (youtubeId) {
        const embedUrl = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`;
        iframe.src = embedUrl;
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
      }
    });
  });

  // Close modal when close button is clicked
  closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
    iframe.src = ''; // Stop video
    document.body.style.overflow = 'auto'; // Restore scrolling
  });

  // Close modal when clicking outside the video
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.style.display = 'none';
      iframe.src = ''; // Stop video
      document.body.style.overflow = 'auto'; // Restore scrolling
    }
  });

  // Close modal with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.style.display === 'block') {
      modal.style.display = 'none';
      iframe.src = ''; // Stop video
      document.body.style.overflow = 'auto'; // Restore scrolling
    }
  });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/media-center.blade.php ENDPATH**/ ?>