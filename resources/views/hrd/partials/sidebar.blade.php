<!-- Sidebar -->
<aside class="main-sidebar elevation-4 spark-sidebar">
    <a href="{{ route('hrd.dashboard') }}" class="brand-link">
        <img src="{{ asset('images/banner-logo.png') }}"
             alt="Winnicode Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Winnicode</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/default-admin.jpeg')}}"
                     class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <small>Human Resource Developer</small>
            </div>
        </div>

        @php
            // parent “Jobs” active jika rutenya hr d.jobs.index, create, edit, show, dll.
            $isJobsOpen = request()->routeIs('hrd.jobs.*');
        @endphp

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-header">MAIN</li>

                {{-- Dashboards --}}
                <li class="nav-item has-treeview {{ request()->routeIs('hrd.dashboard') ? 'menu-open' : '' }}">
                    <a href="{{ route('hrd.dashboard') }}"
                       class="nav-link {{ request()->routeIs('hrd.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboards</p>
                    </a>
                </li>

                {{-- Jobs --}}
                <li class="nav-item has-treeview {{ $isJobsOpen ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ $isJobsOpen ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Jobs
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('hrd.jobs.index') }}"
                               class="nav-link {{ request()->routeIs('hrd.jobs.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Job Lists</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hrd.jobs.create') }}"
                               class="nav-link {{ request()->routeIs('hrd.jobs.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Jobs</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Application --}}
                <li class="nav-item has-treeview {{ $isJobsOpen ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ $isJobsOpen ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Application
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('hrd.applications.index') }}"
                               class="nav-link {{ request()->routeIs('hrd.jobs.applications.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Applications</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">ELEMENTS</li>
                {{-- Company Profile --}}
                <li class="nav-item">
                    <a href="#"
                       class="nav-link {{ request()->routeIs('hrd.ui.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>Company Profile</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
