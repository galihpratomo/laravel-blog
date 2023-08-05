<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.html"><img class="main-logo" src="{{ asset('theme/img/logo/logo.png') }}" alt="" /></a>
            <strong><img src="{{ asset('theme/img/logo/logosn.png') }}" alt="" /></strong>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <li class="{{ request()->routeIs('home') ? 'menu_aktif' : '' }}">
                        <a title="Dashboard" href="{{ route('home') }}">
                            <i class="fa big-icon fa-home icon-wrap" aria-hidden="true"></i> <span class="mini-click-non">Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('article-post.index')   ? 'active' : '' }}">
                        <a class="has-arrow" href="mailbox.html" aria-expanded="false">
                            <i class="fa fa-building sub-icon-mg"></i> <span class="mini-click-non">Article</span>
                        </a>
                        <ul class="submenu-angle"  aria-expanded="false">
                            <li class="{{ request()->routeIs('article-post.index') ? 'menu_aktif' : '' }}">
                                <a title="Post" href="{{ route('article-post.index') }}" >
                                    <i class="fa fa-bookmark icon-wrap sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Post</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    
                    
                </ul>
            </nav>
        </div>
    </nav>
</div>