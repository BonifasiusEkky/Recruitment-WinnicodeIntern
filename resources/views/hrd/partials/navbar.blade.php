<!-- Navbar -->
<style>
    :root {
      --primary-bg: #1e3a8a;
      --sidebar-bg: #ffffff;
      --card-bg: #ffffff;
      --card-border: rgba(0,0,0,0.05);
      --text-color: #2f3e4e;
      --header-text: #ffffff;
      --content-bg: #e5e7eb;
    }
    .main-header.navbar {
      background-color: var(--primary-bg) !important;
    }
    .spark-sidebar {
      background-color: var(--sidebar-bg) !important;
    }
    .spark-sidebar .brand-link {
      background-color: var(--primary-bg) !important;
      color: var(--header-text) !important;
    }
    .spark-sidebar .brand-link .brand-text {
      color: var(--header-text) !important;
    }
    .spark-sidebar .user-panel {
      flex-direction: column;
      text-align: center;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      padding-bottom: 1rem;
    }
    .spark-sidebar .user-panel .image img {
      width: 48px;
      height: 48px;
      margin-bottom: 0.5rem;
    }
    .spark-sidebar .user-panel .info a {
      color: var(--text-color) !important;
      font-weight: 600;
    }
    .spark-sidebar .user-panel .info small {
      color: #6c757d;
      display: block;
      font-size: 0.75rem;
    }
    .spark-sidebar .nav-header {
      font-size: 0.75rem;
      font-weight: bold;
      color: #6c757d;
      margin-top: 1rem;
      padding-left: 1rem;
    }
    .spark-sidebar .nav-sidebar > .nav-item > .nav-link {
      color: var(--text-color) !important;
      font-weight: 500;
    }
    .spark-sidebar .nav-icon {
      width: 1.25rem;
    }
    .spark-sidebar .has-treeview .nav-link .right {
      transition: transform 0.2s ease;
    }
    .spark-sidebar .menu-open > .nav-link .right {
      transform: rotate(180deg);
    }
    .content-wrapper {
      background-color: var(--content-bg) !important;
    }
    .small-box {
      background-color: var(--card-bg) !important;
      color: var(--text-color) !important;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .small-box .inner h3 {
      color: var(--text-color);
      font-size: 2rem;
    }
    .small-box .inner p {
      color: #6c757d;
      font-size: 1rem;
    }
    .small-box .icon {
      color: var(--primary-bg);
      opacity: 0.7;
    }
    .card {
      background-color: var(--card-bg);
      color: var(--text-color);
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border: 1px solid var(--card-border);
    }
    .card-header {
      background-color: transparent;
      border-bottom: none;
    }
    .card-title {
      color: var(--text-color);
    }
    .main-footer {
      background-color: var(--card-bg);
      color: var(--text-color);
    }
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
      display: block;
      width: 100%;
      margin-bottom: 1rem;
    }
    .dataTables_wrapper .dataTables_filter {
      text-align: left;
    }
  </style>
<nav class="main-header navbar navbar-expand navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#"><i class="fas fa-search"></i></a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search projects..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit"><i class="fas fa-search"></i></button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-envelope"></i><span class="badge badge-danger navbar-badge">24</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-bell"></i><span class="badge badge-warning navbar-badge">5</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#"><i class="fas fa-expand-arrows-alt"></i></a>
            </li>
            <li class="nav-item">
                <form action="{{ route('hrd.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-white">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->