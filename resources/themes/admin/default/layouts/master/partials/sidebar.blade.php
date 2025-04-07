<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="/themes/admin/default/assets/images/logo.png" srcset="/themes/admin/default/assets/images/logo.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/themes/admin/default/assets/images/logo.png" srcset="./themes/admin/default/assets/images/logo.png 2x" alt="logo-dark">
                <span>
                    Telebot
                </span>
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-menu">
                    <ul class="nk-menu">
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                                <span class="nk-menu-text"> Dashboard</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Contents</h6>
                        </li><!-- .nk-menu-heading -->
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route('posts.index') }}" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                <span class="nk-menu-text">Posts</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('posts.index') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-list"></em></span>
                                        <span class="nk-menu-text">All Posts</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('posts.create') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-edit-alt"></em></span>
                                        <span class="nk-menu-text">Add New Post</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('posts.categories.index') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-network"></em></span>
                                        <span class="nk-menu-text">Categories</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('posts.tags.index') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tags"></em></span>
                                        <span class="nk-menu-text">Tags</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route('pages.index') }}" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                                <span class="nk-menu-text">Pages</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('pages.index') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-list"></em></span>
                                        <span class="nk-menu-text">All Pages</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="/pages/create" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-edit-alt"></em></span>
                                        <span class="nk-menu-text">Add New Page</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item">
                            <a href="{{route('medias.index')}}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-img"></em></span>
                                <span class="nk-menu-text">Media</span>
                            </a>
                        </li><!-- .nk-menu-item -->

                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Settings</h6>
                        </li><!-- .nk-menu-heading -->
                        <li class="nk-menu-item">
                            <a href="{{ route('settings.bots.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-tree-structure"></em></span>
                                <span class="nk-menu-text">Bot</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('settings.users.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                <span class="nk-menu-text">Users</span>
                            </a>
                        </li><!-- .nk-menu-item -->

                    </ul><!-- .nk-menu -->
                </div><!-- .nk-sidebar-menu -->
                <div class="nk-sidebar-footer">
                </div><!-- .nk-sidebar-footer -->
            </div><!-- .nk-sidebar-content -->
        </div><!-- .nk-sidebar-body -->
    </div><!-- .nk-sidebar-element -->
</div>
