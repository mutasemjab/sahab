<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Vertex</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                {{-- Content Management Section --}}
                <li class="nav-header">{{ __('messages.content_management') }}</li>

                @if (
                    $user->can('banner-table') ||
                        $user->can('banner-add') ||
                        $user->can('banner-edit') ||
                        $user->can('banner-delete'))
                    <li class="nav-item">
                        <a href="{{ route('banners.index') }}" class="nav-link">
                            <i class="fas fa-images nav-icon"></i>
                            <p> {{ __('messages.Banners') }} </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('abouts.index') }}" class="nav-link">
                        <i class="fas fa-info-circle nav-icon"></i>
                        <p> {{ __('messages.About') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('events.index') }}" class="nav-link">
                        <i class="fas fa-calendar nav-icon"></i>
                        <p> {{ __('messages.Events') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('services.index') }}" class="nav-link">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p> {{ __('messages.Services') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('public-sessions.index') }}" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p> {{ __('messages.PublicSessions') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('projects.index') }}" class="nav-link">
                        <i class="fas fa-project-diagram nav-icon"></i>
                        <p> {{ __('messages.Projects') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('advs.index') }}" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> {{ __('messages.Advs') }} </p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p> {{ __('messages.news') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('questions.index') }}" class="nav-link">
                        <i class="fas fa-question-circle nav-icon"></i>
                        <p> {{ __('messages.Questions') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('galleries.index') }}" class="nav-link">
                        <i class="fas fa-images nav-icon"></i>
                        <p> {{ __('messages.Galleries') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('topic-discussions.index') }}" class="nav-link">
                        <i class="fas fa-comments nav-icon"></i>
                        <p> {{ __('messages.TopicDiscussions') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('important-links.index') }}" class="nav-link">
                        <i class="fas fa-external-link-alt nav-icon"></i>
                        <p> {{ __('messages.ImportantLinks') }} </p>
                    </a>
                </li>

                {{-- Organization Section --}}
                <li class="nav-header">{{ __('messages.organization') }}</li>

                <li class="nav-item">
                    <a href="{{ route('our-parts.index') }}" class="nav-link">
                        <i class="fas fa-puzzle-piece nav-icon"></i>
                        <p> {{ __('messages.OurParts') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('municipal-councils.index') }}" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>
                        <p> {{ __('messages.MunicipalCouncils') }} </p>
                    </a>
                </li>

                {{-- Legal & Tenders Section --}}
                <li class="nav-header">{{ __('messages.legal_tenders') }}</li>

                <li class="nav-item">
                    <a href="{{ route('laws.index') }}" class="nav-link">
                        <i class="fas fa-gavel nav-icon"></i>
                        <p> {{ __('messages.Laws') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tenders.index') }}" class="nav-link">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p> {{ __('messages.Tenders') }} </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tender-details.index') }}" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p> {{ __('messages.TenderDetails') }} </p>
                    </a>
                </li>

                {{-- Existing Business Section --}}
                <li class="nav-header">{{ __('messages.business_management') }}</li>

              

                    @if (
                        $user->can('customer-table') ||
                            $user->can('customer-add') ||
                            $user->can('customer-edit') ||
                            $user->can('customer-delete'))
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __('messages.Customers') }} </p>
                            </a>
                        </li>
                    @endif

                   

                
                
                 

                    {{-- System Configuration --}}
                    <li class="nav-header">{{ __('messages.system_configuration') }}</li>

                    <li class="nav-item">
                        <a href="{{ route('settings.index') }}" class="nav-link">
                            <i class="fas fa-cog nav-icon"></i>
                            <p>{{ __('messages.Settings') }} </p>
                        </a>
                    </li>

                  

                    {{-- User Management --}}
                    <li class="nav-header">{{ __('messages.user_management') }}</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.login.edit', auth()->user()->id) }}" class="nav-link">
                            <i class="fas fa-user nav-icon"></i>
                            <p>{{ __('messages.Admin_account') }} </p>
                        </a>
                    </li>

                    @if ($user->can('role-table') || $user->can('role-add') || $user->can('role-edit') || $user->can('role-delete'))
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}" class="nav-link">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <span>{{ __('messages.Roles') }} </span>
                            </a>
                        </li>
                    @endif

                    @if (
                        $user->can('employee-table') ||
                            $user->can('employee-add') ||
                            $user->can('employee-edit') ||
                            $user->can('employee-delete'))
                        <li class="nav-item">
                            <a href="{{ route('admin.employee.index') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <span> {{ __('messages.Employee') }} </span>
                            </a>
                        </li>
                    @endif

             

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>