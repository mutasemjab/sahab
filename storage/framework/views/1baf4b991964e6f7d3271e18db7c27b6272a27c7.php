<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo e(asset('assets/admin/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Vertex</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(asset('assets/admin/dist/img/user2-160x160.jpg')); ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo e(auth()->user()->name); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                
                <li class="nav-header"><?php echo e(__('messages.content_management')); ?></li>

                <?php if($user->can('banner-table') || $user->can('banner-add') || $user->can('banner-edit') || $user->can('banner-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('banners.index')); ?>" class="nav-link">
                            <i class="fas fa-images nav-icon"></i>
                            <p> <?php echo e(__('messages.Banners')); ?> </p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?php echo e(route('abouts.index')); ?>" class="nav-link">
                        <i class="fas fa-info-circle nav-icon"></i>
                        <p> <?php echo e(__('messages.About')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('events.index')); ?>" class="nav-link">
                        <i class="fas fa-calendar nav-icon"></i>
                        <p> <?php echo e(__('messages.Events')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('services.index')); ?>" class="nav-link">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p> <?php echo e(__('messages.Services')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('public-sessions.index')); ?>" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p> <?php echo e(__('messages.PublicSessions')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('projects.index')); ?>" class="nav-link">
                        <i class="fas fa-project-diagram nav-icon"></i>
                        <p> <?php echo e(__('messages.Projects')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('advs.index')); ?>" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> <?php echo e(__('messages.Advs')); ?> </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="<?php echo e(route('questions.index')); ?>" class="nav-link">
                        <i class="fas fa-question-circle nav-icon"></i>
                        <p> <?php echo e(__('messages.Questions')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('galleries.index')); ?>" class="nav-link">
                        <i class="fas fa-images nav-icon"></i>
                        <p> <?php echo e(__('messages.Galleries')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('topic-discussions.index')); ?>" class="nav-link">
                        <i class="fas fa-comments nav-icon"></i>
                        <p> <?php echo e(__('messages.TopicDiscussions')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('important-links.index')); ?>" class="nav-link">
                        <i class="fas fa-external-link-alt nav-icon"></i>
                        <p> <?php echo e(__('messages.ImportantLinks')); ?> </p>
                    </a>
                </li>

                
                <li class="nav-header"><?php echo e(__('messages.organization')); ?></li>

                <li class="nav-item">
                    <a href="<?php echo e(route('our-parts.index')); ?>" class="nav-link">
                        <i class="fas fa-puzzle-piece nav-icon"></i>
                        <p> <?php echo e(__('messages.OurParts')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('municipal-councils.index')); ?>" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>
                        <p> <?php echo e(__('messages.MunicipalCouncils')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('new-listen-sessions.index')); ?>" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>
                        <p> <?php echo e(__('messages.listen_sessions')); ?> </p>
                    </a>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>
                            <?php echo e(__('messages.user_management')); ?>

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('adminComplaints.index')); ?>" class="nav-link">
                                <i class="fas fa-exclamation-triangle nav-icon text-warning"></i>
                                <p><?php echo e(__('messages.complaints_management')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.contacts.index')); ?>" class="nav-link">
                                <i class="fas fa-envelope nav-icon text-info"></i>
                                <p><?php echo e(__('messages.contact_us_management')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.service-forms.index')); ?>" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon text-primary"></i>
                                <p><?php echo e(__('messages.service_forms_management')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.suggestions.index')); ?>" class="nav-link">
                                <i class="fas fa-lightbulb nav-icon text-success"></i>
                                <p><?php echo e(__('messages.suggestions_management')); ?></p>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="nav-header"><?php echo e(__('messages.legal_tenders')); ?></li>



                <li class="nav-item">
                    <a href="<?php echo e(route('laws.index')); ?>" class="nav-link">
                        <i class="fas fa-gavel nav-icon"></i>
                        <p> <?php echo e(__('messages.Laws')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('tenders.index')); ?>" class="nav-link">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p> <?php echo e(__('messages.Tenders')); ?> </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('tender-details.index')); ?>" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p> <?php echo e(__('messages.TenderDetails')); ?> </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="<?php echo e(route('community-initiatives.index')); ?>" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p> <?php echo e(__('messages.community_initiatives_management')); ?> </p>
                    </a>
                </li>





                <li class="nav-item">
                    <a href="<?php echo e(route('pages.index')); ?>" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> <?php echo e(__('messages.pages_management')); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('footer-settings.index')); ?>" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> <?php echo e(__('messages.footer_settings')); ?> </p>
                    </a>
                </li>
             
                <li class="nav-item">
                    <a href="<?php echo e(route('icon_headers.index')); ?>" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> <?php echo e(__('messages.icon_headers')); ?> </p>
                    </a>
                </li>

                
                <li class="nav-header"><?php echo e(__('messages.system_configuration')); ?></li>

                <li class="nav-item">
                    <a href="<?php echo e(route('settings.index')); ?>" class="nav-link">
                        <i class="fas fa-cog nav-icon"></i>
                        <p><?php echo e(__('messages.Settings')); ?> </p>
                    </a>
                </li>



                
                <li class="nav-header"><?php echo e(__('messages.user_management')); ?></li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.login.edit', auth()->user()->id)); ?>" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p><?php echo e(__('messages.Admin_account')); ?> </p>
                    </a>
                </li>

             



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\sahab\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>