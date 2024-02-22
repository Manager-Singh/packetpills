<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.deactivated') }}">
                            @lang('menus.backend.access.users.deactivated')

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.deleted') }}">
                            @lang('menus.backend.access.users.deleted')

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/permission*'))
                            }}" href="{{ route('admin.auth.permission.index') }}">
                                @lang('labels.backend.access.permissions.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/drugs'))
                    }}" href="{{ route('admin.drugs.index') }}">
                        
                        <i class="nav-icon fas fa-pills"></i>
                        <!-- @lang('labels.backend.access.blogs.management') -->
                        Drugs Management
                    </a>
                </li>
                <li class="divider"></li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/transfer-requests'))
                    }}" href="{{ route('admin.transfer-requests.index') }}">
                        
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        Transfer Requests
                    </a>
                </li>
                <li class="divider"></li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/orders'))
                    }}" href="{{ route('admin.orders.index') }}">
                        <i class="nav-icon fab fa-first-order"></i>
                        All Orders
                    </a>
                </li>
                <li class="divider"></li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/prescriptions'))
                    }}" href="{{ route('admin.prescriptions.index') }}">
                        <i class="nav-icon fas fa-prescription"></i>
                        @lang('menus.backend.sidebar.prescriptions')
                    </a>
                </li>
                <li class="divider"></li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/enterpriseconnects'))
                    }}" href="{{ route('admin.enterpriseconnects.index') }}">
                        <i class="nav-icon fas fa-file"></i>
                        @lang('menus.backend.sidebar.enterprise_connect')
                    </a>
                </li>
                <li class="divider"></li>

                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/preciption-types'))
                    }}" href="{{ route('admin.preciption-types.index') }}">
                        <i class="nav-icon fas fa-hand-holding-medical"></i>
                        @lang('menus.backend.sidebar.preciption-types')
                    </a>
                </li>
                 <li class="divider"></li>

                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/auto-messages'))
                    }}" href="{{ route('admin.auto-messages.index') }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        @lang('menus.backend.sidebar.auto-messages')
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/mail-messages'))
                    }}" href="{{ route('admin.mail-messages.index') }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        @lang('menus.backend.sidebar.mail-messages')
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/setting'))
                    }}" href="{{ route('admin.setting') }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        Email Signature
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/provinces'))
                    }}" href="{{ route('admin.provinces.index') }}">
                        <i class="nav-icon fas fa-globe"></i>
                        @lang('menus.backend.sidebar.provinces')
                    </a>
                </li>
                
                <!-- <li class="divider"></li>
                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/pages'))
                    }}" href="{{ route('admin.pages.index') }}">
                        <i class="nav-icon fas fa-file"></i>
                        @lang('menus.backend.sidebar.pages')
                    </a>
                </li>

                <li class="divider"></li>

                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/faqs'))
                    }}" href="{{ route('admin.faqs.index') }}">
                        <i class="nav-icon fas fa-question-circle"></i>
                        @lang('menus.backend.sidebar.faqs')
                    </a>
                </li>

                <li class="divider"></li>

                <li class="nav-item">
                    <a class="nav-link {{
                        active_class(Route::is('admin/email-templates'))
                    }}" href="{{ route('admin.email-templates.index') }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        @lang('menus.backend.sidebar.email-templates')
                    </a>
                </li>

                

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/blogs'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/blogs*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-rss"></i> @lang('menus.backend.sidebar.blogs')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/blogs/blog-categories*'))
                        }}" href="{{ route('admin.blog-categories.index') }}">
                                @lang('labels.backend.access.blog-category.management')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/blogs/blog-tags*'))
                        }}" href="{{ route('admin.blog-tags.index') }}">
                                @lang('labels.backend.access.blog-tag.management')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blogs')) }}" 
                                href="{{ route('admin.blogs.index') }}">
                                @lang('labels.backend.access.blogs.management')
                            </a>
                        </li>
                        
                    </ul>
                </li> -->

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
