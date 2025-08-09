<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="<?php echo e(route('question')); ?>" class="active"><?php echo e(__('front.faq')); ?></a>
  </div>
</div>

<section class="mutasem-propose-intro">
  <div class="mutasem-container">
    <h2 class="mutasem-title"><?php echo e(__('front.faq')); ?></h2>
    <p class="mutasem-subtitle"><?php echo e(__('front.faq_subtitle')); ?></p>
  </div>
</section>

<section class="mutasem-faq-section">
  <div class="mutasem-faq-container">
    <div class="mutasem-faq-search">
      <input type="text" id="faqSearch" placeholder="<?php echo e(__('front.search')); ?>" autocomplete="off">
      <span class="mutasem-faq-search-icon">🔍</span>
    </div>

    <div class="mutasem-faq-list" id="faqList">
      <?php $__empty_1 = true; $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="mutasem-faq-item" data-question-id="<?php echo e($question->id); ?>">
        <div class="mutasem-faq-question">
          <?php echo e($question->question); ?>

          <span class="mutasem-faq-toggle">
            <i class="fas fa-chevron-down"></i>
          </span>
        </div>
        <div class="mutasem-faq-answer">
          <?php echo e($question->answer); ?>

        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="no-questions">
        <p><?php echo e(__('front.no_questions_found')); ?></p>
      </div>
      <?php endif; ?>
    </div>

    <!-- Loading indicator -->
    <div class="loading-indicator" id="loadingIndicator" style="display: none;">
      <div class="spinner"></div>
      <p><?php echo e(__('front.searching')); ?>...</p>
    </div>

    <!-- No results message -->
    <div class="no-results" id="noResults" style="display: none;">
      <p><?php echo e(__('front.no_search_results')); ?></p>
      <button type="button" class="btn-clear-search" onclick="clearSearch()"><?php echo e(__('front.clear_search')); ?></button>
    </div>

    <div class="mutasem-faq-help">
      <p><?php echo e(__('front.still_have_questions')); ?></p>
      <div class="mutasem-faq-help-options">
        <a href="tel:<?php echo e($setting->phone); ?>" class="mutasem-help-link">
          📞 <?php echo e(__('front.call_us')); ?>

        </a>
        <a href="mailto:<?php echo e($setting->email); ?>" class="mutasem-help-link">
          📧 <?php echo e(__('front.email_support')); ?>

        </a>
        <a href="#" class="mutasem-help-link">
          💬 <?php echo e(__('front.send_message')); ?>

        </a>
      </div>
    </div>
  </div>
</section>

<script>
let searchTimeout;
const searchInput = document.getElementById('faqSearch');
const faqList = document.getElementById('faqList');
const loadingIndicator = document.getElementById('loadingIndicator');
const noResults = document.getElementById('noResults');

// Search functionality
searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const query = this.value.trim();
    
    // Show loading after a short delay
    searchTimeout = setTimeout(() => {
        if (query.length > 0) {
            searchQuestions(query);
        } else {
            // If search is empty, reload all questions
            location.reload();
        }
    }, 300);
});

function searchQuestions(query) {
    // Show loading indicator
    loadingIndicator.style.display = 'block';
    faqList.style.display = 'none';
    noResults.style.display = 'none';
    
    fetch(`<?php echo e(route('question.search')); ?>?q=${encodeURIComponent(query)}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        loadingIndicator.style.display = 'none';
        
        if (data.questions && data.questions.length > 0) {
            displayQuestions(data.questions);
            faqList.style.display = 'block';
        } else {
            noResults.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Search error:', error);
        loadingIndicator.style.display = 'none';
        faqList.style.display = 'block';
    });
}

function displayQuestions(questions) {
    faqList.innerHTML = '';
    
    questions.forEach(question => {
        const faqItem = document.createElement('div');
        faqItem.className = 'mutasem-faq-item';
        faqItem.setAttribute('data-question-id', question.id);
        
        faqItem.innerHTML = `
            <div class="mutasem-faq-question">
                ${question.question}
                <span class="mutasem-faq-toggle">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </div>
            <div class="mutasem-faq-answer">
                ${question.answer}
            </div>
        `;
        
        faqList.appendChild(faqItem);
    });
    
    // Re-bind click events
    bindFaqEvents();
}

function clearSearch() {
    searchInput.value = '';
    location.reload();
}

function bindFaqEvents() {
    // FAQ accordion functionality
    document.querySelectorAll('.mutasem-faq-question').forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            const answer = faqItem.querySelector('.mutasem-faq-answer');
            const toggle = this.querySelector('.mutasem-faq-toggle i');
            
            // Close all other open FAQ items
            document.querySelectorAll('.mutasem-faq-item').forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('active');
                    item.querySelector('.mutasem-faq-answer').style.maxHeight = null;
                    item.querySelector('.mutasem-faq-toggle i').classList.remove('fa-chevron-up');
                    item.querySelector('.mutasem-faq-toggle i').classList.add('fa-chevron-down');
                }
            });
            
            // Toggle current FAQ item
            if (faqItem.classList.contains('active')) {
                faqItem.classList.remove('active');
                answer.style.maxHeight = null;
                toggle.classList.remove('fa-chevron-up');
                toggle.classList.add('fa-chevron-down');
            } else {
                faqItem.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + "px";
                toggle.classList.remove('fa-chevron-down');
                toggle.classList.add('fa-chevron-up');
            }
        });
    });
}

// Initialize FAQ events on page load
document.addEventListener('DOMContentLoaded', function() {
    bindFaqEvents();
    
    // Add keyboard navigation
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            clearSearch();
        }
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/questions.blade.php ENDPATH**/ ?>