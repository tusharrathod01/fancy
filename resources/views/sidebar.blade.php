<aside class="main-sidebar sidebar-white-primary">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/avirattablogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (auth()->user()->check_ps('masters_side') == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('color') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>color</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shape') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>shape</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('size') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>Size</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('calarity') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>Calarity</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('type') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('agtype') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>A/G Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('currancy') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>Currency</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('party') }}" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>Party</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if (auth()->user()->user_type == 'sup_admin')
                        <li class="nav-item">
                            <a href="{{ route('year') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>Years</p>
                            </a>
                        </li>
                    @endif
                @endif
                @if (auth()->user()->user_type == 'sup_admin')
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 65px;">
                        <a href="{{ route('user-activity') }}" class="nav-link">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Users Activity</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item positionfix " style="position: fixed;bottom: 15px;background: #fff; display: flex;">
                    <a href="{{ route('password-forgot') }}"
                        class="nav-link username">{{ strtoupper(auth()->user()->name) }}</a>
                    <form action="{{ route('logout') }}" method="post" id="logout-form">
                        @csrf
                        <button type="submit" class="btn float-right mt-0 logout"><i
                                class="nav-icon fas fa-sign-out-alt"></i></button>
                    </form>
                </li>
                <li class="nav-item positionfix " style="position: fixed;bottom: 0;background: #fff; display: flex;">
                    <a href="https://aviratinfo.com/" class="footer" target="_blank">Provide by Aviratinfo</a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
