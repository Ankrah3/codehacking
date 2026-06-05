<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        #sidebar-wrapper {
            width: 250px;
            min-height: 100vh;
            background-color: #1a1f2e;
            flex-shrink: 0;
            transition: width 0.2s;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 1.25rem 1.5rem;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand:hover { color: #fff; }

        .sidebar-brand i {
            margin-right: .6rem;
            color: #4e9af1;
        }

        .sidebar-search {
            padding: .75rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-search .form-control {
            background: rgba(255,255,255,0.07);
            border: none;
            color: #fff;
            font-size: .85rem;
        }

        .sidebar-search .form-control::placeholder { color: rgba(255,255,255,0.4); }
        .sidebar-search .form-control:focus {
            background: rgba(255,255,255,0.12);
            box-shadow: none;
            color: #fff;
        }

        .sidebar-search .btn {
            background: rgba(255,255,255,0.07);
            border: none;
            color: rgba(255,255,255,0.6);
        }

        /* Nav sections */
        .sidebar-section-label {
            padding: .9rem 1.2rem .3rem;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
        }

        #sidebar-wrapper .nav-link {
            color: rgba(255,255,255,0.65);
            padding: .45rem 1.2rem;
            font-size: .875rem;
            display: flex;
            align-items: center;
            gap: .55rem;
            border-radius: 0;
            transition: background .15s, color .15s;
        }

        #sidebar-wrapper .nav-link:hover,
        #sidebar-wrapper .nav-link.active {
            color: #fff;
            background: rgba(78,154,241,0.15);
        }

        #sidebar-wrapper .nav-link i {
            width: 18px;
            text-align: center;
            font-size: .8rem;
            color: rgba(255,255,255,0.4);
        }

        #sidebar-wrapper .nav-link:hover i,
        #sidebar-wrapper .nav-link.active i {
            color: #4e9af1;
        }

        /* Collapsible sub-menus */
        .sidebar-parent {
            color: rgba(255,255,255,0.65);
            padding: .45rem 1.2rem;
            font-size: .875rem;
            display: flex;
            align-items: center;
            gap: .55rem;
            cursor: pointer;
            user-select: none;
            transition: background .15s, color .15s;
        }

        .sidebar-parent:hover { color: #fff; background: rgba(255,255,255,0.05); }

        .sidebar-parent i.fa-chevron-down {
            margin-left: auto;
            font-size: .65rem;
            transition: transform .2s;
        }

        .sidebar-parent[aria-expanded="true"] i.fa-chevron-down {
            transform: rotate(180deg);
        }

        .sidebar-submenu {
            background: rgba(0,0,0,0.15);
        }

        .sidebar-submenu .nav-link {
            padding-left: 2.8rem;
            font-size: .82rem;
        }

        /* ── Top navbar ── */
        #top-navbar {
            background: #fff;
            border-bottom: 1px solid #e8eaf0;
            padding: .6rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .toggle-sidebar-btn {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1.1rem;
            cursor: pointer;
            padding: .25rem .5rem;
            border-radius: .375rem;
            transition: background .15s;
        }

        .toggle-sidebar-btn:hover { background: #f0f2f5; }

        /* ── Main content ── */
        #page-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .content-area {
            flex: 1;
            padding: 1.75rem;
        }

        /* ── Dropdown polish ── */
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            border-radius: .5rem;
        }
    </style>
</head>

<body id="admin-page">

<div id="wrapper">

    <!-- ════════════════════════════════
         SIDEBAR
    ════════════════════════════════ -->
    <div id="sidebar-wrapper">

        <!-- Brand -->
        <a class="sidebar-brand" href="{{ route('admin.index') }}">
            <i class="fas fa-layer-group"></i> Laravel Admin
        </a>

        <!-- Search -->
        <div class="sidebar-search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Nav -->
        <nav>
            <div class="sidebar-section-label">Main</div>

            <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}"
               href="{{ route('admin.index') }}">
                <i class="fas fa-gauge-high"></i> Dashboard
            </a>

            <!-- Users -->
            <div class="sidebar-section-label">Management</div>

            <div class="sidebar-parent"
                 data-bs-toggle="collapse"
                 data-bs-target="#menu-users"
                 aria-expanded="{{ Request::is('admin/users*') ? 'true' : 'false' }}">
                <i class="fas fa-users"></i>
                Users
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="collapse sidebar-submenu {{ Request::is('admin/users*') ? 'show' : '' }}"
                 id="menu-users">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-list"></i> All Users
                </a>
                <a class="nav-link" href="{{ route('admin.users.create') }}">
                    <i class="fas fa-plus"></i> Create User
                </a>
            </div>

            <!-- Posts -->
            <div class="sidebar-parent"
                 data-bs-toggle="collapse"
                 data-bs-target="#menu-posts"
                 aria-expanded="{{ Request::is('admin/posts*') ? 'true' : 'false' }}">
                <i class="fas fa-newspaper"></i>
                Posts
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="collapse sidebar-submenu {{ Request::is('admin/posts*') ? 'show' : '' }}"
                 id="menu-posts">
                <a class="nav-link" href="{{ route('admin.posts.index') }}">
                    <i class="fas fa-list"></i> All Posts
                </a>
                <a class="nav-link" href="{{ route('admin.posts.create') }}">
                    <i class="fas fa-plus"></i> Create Post
                </a>
                <a class="nav-link" href="{{ route('admin.comments.index') }}">
                    <i class="fas fa-comments"></i> All Comments
                </a>
            </div>

            <!-- Categories -->
            <div class="sidebar-parent"
                 data-bs-toggle="collapse"
                 data-bs-target="#menu-categories"
                 aria-expanded="{{ Request::is('admin/categories*') ? 'true' : 'false' }}">
                <i class="fas fa-tags"></i>
                Categories
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="collapse sidebar-submenu {{ Request::is('admin/categories*') ? 'show' : '' }}"
                 id="menu-categories">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-list"></i> All Categories
                </a>
                <a class="nav-link" href="{{ route('admin.categories.create') }}">
                    <i class="fas fa-plus"></i> Create Category
                </a>
            </div>

            <!-- Media -->
            <div class="sidebar-parent"
                 data-bs-toggle="collapse"
                 data-bs-target="#menu-media"
                 aria-expanded="{{ Request::is('admin/medias*') ? 'true' : 'false' }}">
                <i class="fas fa-photo-film"></i>
                Media
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="collapse sidebar-submenu {{ Request::is('admin/medias*') ? 'show' : '' }}"
                 id="menu-media">
                <a class="nav-link" href="{{ route('admin.medias.index') }}">
                    <i class="fas fa-list"></i> All Media
                </a>
                <a class="nav-link" href="{{ route('admin.medias.create') }}">
                    <i class="fas fa-upload"></i> Upload Media
                </a>
            </div>

        </nav>
    </div>
    <!-- /#sidebar-wrapper -->


    <!-- ════════════════════════════════
         MAIN CONTENT AREA
    ════════════════════════════════ -->
    <div id="page-wrapper">

        <!-- Top Navbar -->
        <div id="top-navbar">
            <button class="toggle-sidebar-btn" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <div class="d-flex align-items-center gap-3">

                <!-- User dropdown -->
                <div class="dropdown">
                    <a href="#"
                       class="d-flex align-items-center gap-2 text-decoration-none text-dark dropdown-toggle"
                       data-bs-toggle="dropdown">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                             style="width:32px;height:32px;font-size:.8rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="d-none d-sm-inline small fw-medium">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="/home">
                                <i class="fas fa-user fa-fw me-2 text-muted"></i> User Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-gear fa-fw me-2 text-muted"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-right-from-bracket fa-fw me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /#top-navbar -->

        <!-- Page Content -->
        <div class="content-area">
            @yield('content')
        </div>

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Sidebar toggle
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-wrapper');
        if (sidebar.style.width === '0px' || sidebar.style.width === '') {
            sidebar.style.width = sidebar.dataset.width || '250px';
        } else {
            sidebar.dataset.width = sidebar.style.width || '250px';
            sidebar.style.width = '0px';
        }
    });
</script>

@yield('footer')
@yield('scripts')

</body>
</html>