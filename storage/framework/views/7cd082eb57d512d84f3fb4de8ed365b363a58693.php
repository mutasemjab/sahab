<?php $__env->startSection('content'); ?>
    
    <?php if(!View::hasSection('head')): ?>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php endif; ?>
    
    <div class="breadcrumb-bar">
        <div class="breadcrumb-container">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span> <i class="fas fa-chevron-left"></i> </span>
            <a href="<?php echo e(route('community.index')); ?>" class="active"><?php echo e(__('front.community')); ?></a>
        </div>
    </div>

    <section class="mutasem-community-section">
        <div class="mutasem-container">
            <h2 class="mutasem-title"><?php echo e(__('front.shape_community_future')); ?></h2>
            <p class="mutasem-subtitle"><?php echo e(__('front.community_participation_description')); ?></p>

            <!-- المبادرات المجتمعية -->
            <div class="mutasem-block">
                <h3 class="mutasem-heading"><?php echo e(__('front.community_initiatives')); ?></h3>
                <div class="mutasem-cards-row">
                    <?php $__empty_1 = true; $__currentLoopData = $initiatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $initiative): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mutasem-card">
                            <div class="mutasem-card-header"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                <h4 style="margin:0;">
                                    <?php echo e(app()->getLocale() == 'ar' ? $initiative->title_ar : $initiative->title_en); ?>

                                </h4>

                                <?php if(auth()->guard()->check()): ?>
                                    <?php if($initiative->isSupportedByUser(Auth::id())): ?>
                                        <button class="support-initiative-btn supported" disabled>
                                            <?php echo e(__('front.supported')); ?> ✓
                                        </button>
                                    <?php else: ?>
                                        <button class="support-initiative-btn" data-id="<?php echo e($initiative->id); ?>">
                                            <?php echo e(__('front.support_initiative')); ?>

                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <button class="support-initiative-btn login-to-support-btn" data-id="<?php echo e($initiative->id); ?>">
                                        <?php echo e(__('front.login_to_support')); ?>

                                    </button>
                                <?php endif; ?>
                            </div>

                            <p><?php echo e(Str::limit(app()->getLocale() == 'ar' ? $initiative->description_ar : $initiative->description_en, 100)); ?>

                            </p>

                            <div class="mutasem-card-progress">
                                <span class="supporter-count-<?php echo e($initiative->id); ?>">
                                    <i class="fas fa-users" style="margin-left:6px; color:#c9c0c0;"></i>
                                    <?php echo e($initiative->supporting_users_count); ?> <?php echo e(__('front.supporters')); ?>

                                </span>

                                <?php if($initiative->date_finish): ?>
                                    <span>
                                        <i class="fas fa-calendar-alt" style="margin-left:6px; color:#c9c0c0;"></i>
                                        <?php echo e(__('front.ends_on')); ?>

                                        <?php echo e(Carbon\Carbon::parse($initiative->date_finish)->locale('ar')->translatedFormat('j F Y')); ?>

                                    </span>
                                <?php endif; ?>

                                <?php
                                    $supportCount = $initiative->supporting_users_count;
                                    $progressPercentage = min(($supportCount / 100) * 100, 100); // Assuming 100 is the target
                                ?>
                                <div class="mutasem-progress-bar">
                                    <div class="progress-fill-<?php echo e($initiative->id); ?>"
                                        style="width: <?php echo e($progressPercentage); ?>%;"></div>
                                </div>
                               
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="no-initiatives">
                            <p><?php echo e(__('front.no_initiatives_available')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <button class="mutasem-add-btn">+ <?php echo e(__('front.start_initiative')); ?></button>
            </div>

            <!-- الجلسات العامة القادمة -->
            <div class="mutasem-block">
                <h3 class="mutasem-heading"><?php echo e(__('front.upcoming_public_sessions')); ?></h3>
                <div class="mutasem-cards-row-1">
                    <?php $__empty_1 = true; $__currentLoopData = $publicSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mutasem-session-card">
                            <span class="mutasem-status <?php echo e($session->type == 1 ? 'open' : ''); ?>">
                                <?php echo e($session->type == 1 ? __('front.open') : __('front.coming_soon')); ?>

                            </span>
                            <span class="session-date" style="font-size:14px;">
                                <?php echo e(\Carbon\Carbon::parse($session->date_of_event)->locale('ar')->translatedFormat('j F Y')); ?>

                            </span>
                            <h4><?php echo e(app()->getLocale() == 'ar' ? $session->title_ar : $session->title_en); ?></h4>
                            <p><?php echo e(Str::limit(app()->getLocale() == 'ar' ? $session->description_ar : $session->description_en, 100)); ?>

                            </p>
                            <p class="mutasem-time">
                                <?php if($session->from_time): ?>
                                    <?php
                                        \Carbon\Carbon::setLocale('ar');
                                        $fromTime = \Carbon\Carbon::parse($session->from_time);
                                        $toTime = \Carbon\Carbon::parse($session->to_time);
                                    ?>
                                    <div class="session-time">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($fromTime->format('g:i')); ?>

                                        <?php echo e($fromTime->format('A') == 'AM' ? 'صباحا' : 'مساء'); ?> -
                                        <?php echo e($toTime->format('g:i')); ?> <?php echo e($toTime->format('A') == 'AM' ? 'صباحا' : 'مساء'); ?>

                                    </div>
                                <?php endif; ?>
                            </p>

                            <?php if($session->type == 1): ?>
                                <a href="<?php echo e(route('sessions.show', $session->id)); ?>" class="mutasem-primary-btn">
                                    <?php echo e(__('front.join_session')); ?>

                                </a>
                            <?php else: ?>
                                <button class="mutasem-light-btn"><?php echo e(__('front.vote_on_discussion_topics')); ?></button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="no-sessions">
                            <p><?php echo e(__('front.no_sessions_available')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- التصويت على مواضيع النقاش -->
            <div class="mutasem-block">
                <h3 class="mutasem-heading"><?php echo e(__('front.vote_on_discussion_topics')); ?></h3>
                <div class="mutasem-cards-row">
                    <?php $__empty_1 = true; $__currentLoopData = $topicDiscussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mutasem-vote-card">
                            <h4><?php echo e(app()->getLocale() == 'ar' ? $topic->title_ar : $topic->title_en); ?></h4>
                            <p><?php echo Str::limit(app()->getLocale() == 'ar' ? $topic->description_ar : $topic->description_en, 100); ?></p>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom:6px;direction: ltr;">
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if($topic->isVotedByUser(Auth::id())): ?>
                                        <button class="vote-topic-btn voted" disabled>
                                            <?php echo e(__('front.voted')); ?> ✓
                                        </button>
                                    <?php else: ?>
                                        <button class="vote-topic-btn" data-id="<?php echo e($topic->id); ?>">
                                            <?php echo e(__('front.vote')); ?> ↑
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <button class="vote-topic-btn login-to-vote-btn" data-id="<?php echo e($topic->id); ?>">
                                        <?php echo e(__('front.login_to_vote')); ?>

                                    </button>
                                <?php endif; ?>

                                <span class="vote-count-<?php echo e($topic->id); ?>" style="font-size: 14px; color: #555;">
                                    <?php echo e(__('front.current_votes')); ?>: <?php echo e($topic->voting_users_count); ?>

                                </span>
                            </div>

                            <?php
                                $maxVotes = $topicDiscussions->max('voting_users_count') ?: 1;
                                $progressPercentage = ($topic->voting_users_count / $maxVotes) * 100;
                            ?>
                            <div class="mutasem-progress-bar small">
                                <div class="vote-progress-<?php echo e($topic->id); ?>" style="width: <?php echo e($progressPercentage); ?>%;"></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="no-topics">
                            <p><?php echo e(__('front.no_topics_available')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Modal -->
    <div id="registrationModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3><?php echo e(__('front.join_community')); ?></h3>
            <p><?php echo e(__('front.register_to_participate')); ?></p>
            
            <form id="registrationForm">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="name"><?php echo e(__('front.full_name')); ?></label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="phone"><?php echo e(__('front.phone_number')); ?></label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <button type="submit" class="modal-submit-btn"><?php echo e(__('front.join_now')); ?></button>
            </form>
            
            <div id="modalMessage" class="modal-message" style="display: none;"></div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <style>
        /* Modal Styles */
        .modal {
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 30px;
            border: none;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #aaa;
            transition: color 0.3s;
        }

        .close:hover {
            color: #000;
        }

        .modal-content h3 {
            color: #1b7b63;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .modal-content p {
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1b7b63;
        }

        .modal-submit-btn {
            width: 100%;
            background-color: #1b7b63;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-submit-btn:hover {
            background-color: #146652;
        }

        .modal-submit-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .modal-message {
            margin-top: 15px;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            font-weight: 600;
        }

        .modal-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .modal-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .vote-topic-btn {
            background: none;
            border: none;
            color: #1b7b63;
            font-size: 15px;
            cursor: pointer;
            padding: 0;
            transition: color 0.3s;
        }

        .vote-topic-btn:hover {
            color: #146652;
        }

        .vote-topic-btn.voted {
            color: #28a745;
            cursor: default;
        }

        .vote-topic-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .login-to-vote-btn {
            background: none;
            border: none;
            color: #dc3545;
            font-size: 15px;
            cursor: pointer;
            padding: 0;
            text-decoration: underline;
        }

        /* RTL Support */
        [dir="rtl"] .close {
            right: auto;
            left: 20px;
        }
    </style>

    <script>
        // Safely get CSRF token
        function getCSRFToken() {
            let token = null;
            
            // Method 1: From meta tag
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (metaTag) {
                token = metaTag.getAttribute('content');
            }
            
            // Method 2: From hidden input in any form
            if (!token) {
                const hiddenInput = document.querySelector('input[name="_token"]');
                if (hiddenInput) {
                    token = hiddenInput.value;
                }
            }
            
            // Method 3: Fallback to blade template
            if (!token) {
                token = '<?php echo e(csrf_token()); ?>';
            }
            
            return token;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('registrationModal');
            const closeBtn = document.querySelector('.close');
            const form = document.getElementById('registrationForm');
            const messageDiv = document.getElementById('modalMessage');
            let currentInitiativeId = null;
            
            // Open modal when clicking login to support buttons or login to vote buttons
            document.querySelectorAll('.login-to-support-btn, .login-to-vote-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentInitiativeId = this.getAttribute('data-id');
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden'; // Prevent background scroll
                });
            });
            
            // Close modal
            closeBtn.addEventListener('click', closeModal);
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') {
                    closeModal();
                }
            });
            
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
                // Reset form
                form.reset();
                messageDiv.style.display = 'none';
                messageDiv.className = 'modal-message';
                currentInitiativeId = null;
            }
            
            // Handle form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = form.querySelector('.modal-submit-btn');
                const formData = new FormData(form);
                
                // Disable form during submission
                submitBtn.disabled = true;
                submitBtn.textContent = '<?php echo e(__("front.processing")); ?>...';
                form.classList.add('loading');
                
                fetch('<?php echo e(route("modal.register")); ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCSRFToken()
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(data.message, 'success');
                        setTimeout(() => {
                            closeModal();
                            // Auto-support/vote after registration if currentInitiativeId exists
                            if (currentInitiativeId) {
                                // Check if it was a vote button or support button based on the clicked element
                                const clickedElement = document.querySelector(`[data-id="${currentInitiativeId}"]`);
                                if (clickedElement && clickedElement.classList.contains('login-to-vote-btn')) {
                                    voteOnTopicAfterLogin(currentInitiativeId);
                                } else {
                                    supportInitiativeAfterLogin(currentInitiativeId);
                                }
                            } else {
                                // Just refresh the page
                                window.location.reload();
                            }
                        }, 1500);
                    } else {
                        showMessage(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('<?php echo e(__("front.error_occurred")); ?>', 'error');
                })
                .finally(() => {
                    // Re-enable form
                    submitBtn.disabled = false;
                    submitBtn.textContent = '<?php echo e(__("front.join_now")); ?>';
                    form.classList.remove('loading');
                });
            });
            
            function showMessage(message, type) {
                messageDiv.textContent = message;
                messageDiv.className = `modal-message ${type}`;
                messageDiv.style.display = 'block';
            }
            
            // Function to support initiative after login
            function supportInitiativeAfterLogin(initiativeId) {
                fetch(`<?php echo e(route('community.support-initiative', '')); ?>/${initiativeId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCSRFToken()
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh page to show updated state
                        window.location.reload();
                    } else {
                        alert(data.message);
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.reload();
                });
            }

            // Function to vote on topic after login
            function voteOnTopicAfterLogin(topicId) {
                fetch(`<?php echo e(route('community.vote-topic', '')); ?>/${topicId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCSRFToken()
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh page to show updated state
                        window.location.reload();
                    } else {
                        alert(data.message);
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.reload();
                });
            }

            // Vote on topic for logged in users
            document.querySelectorAll('.vote-topic-btn:not(.voted):not(.login-to-vote-btn)').forEach(button => {
                button.addEventListener('click', function() {
                    const topicId = this.getAttribute('data-id');
                    const button = this;

                    fetch(`<?php echo e(route('community.vote-topic', '')); ?>/${topicId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': getCSRFToken()
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update button
                                button.textContent = '<?php echo e(__('front.voted')); ?> ✓';
                                button.classList.add('voted');
                                button.disabled = true;

                                // Update vote count
                                document.querySelector(`.vote-count-${topicId}`).textContent =
                                    `<?php echo e(__('front.current_votes')); ?>: ${data.new_count}`;

                                // Update progress bar (recalculate based on max votes)
                                const allVoteCounts = Array.from(document.querySelectorAll('[class*="vote-count-"]'))
                                    .map(el => parseInt(el.textContent.split(':')[1]) || 0);
                                const maxVotes = Math.max(...allVoteCounts, data.new_count);
                                const progressPercentage = (data.new_count / maxVotes) * 100;
                                document.querySelector(`.vote-progress-${topicId}`).style.width =
                                    `${progressPercentage}%`;

                                // Show success message
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('<?php echo e(__('front.error_occurred')); ?>');
                        });
                });
            });

            // Support Initiative for logged in users
            document.querySelectorAll('.support-initiative-btn:not(.supported):not(.login-to-support-btn)').forEach(button => {
                button.addEventListener('click', function() {
                    const initiativeId = this.getAttribute('data-id');
                    const button = this;

                    fetch(`<?php echo e(route('community.support-initiative', '')); ?>/${initiativeId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': getCSRFToken()
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update button
                                button.textContent = '<?php echo e(__('front.supported')); ?> ✓';
                                button.classList.add('supported');
                                button.disabled = true;

                                // Update supporter count
                                document.querySelector(`.supporter-count-${initiativeId}`).innerHTML =
                                    `<i class="fas fa-users" style="margin-left:6px; color:#c9c0c0;"></i>${data.new_count} <?php echo e(__('front.supporters')); ?>`;

                                // Update progress bar
                                const progressPercentage = Math.min((data.new_count / 100) * 100, 100);
                                document.querySelector(`.progress-fill-${initiativeId}`).style.width =
                                    `${progressPercentage}%`;

                                // Show success message
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('<?php echo e(__('front.error_occurred')); ?>');
                        });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sahab\resources\views/user/community.blade.php ENDPATH**/ ?>