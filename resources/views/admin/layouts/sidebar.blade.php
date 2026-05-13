<aside class="main-sidebar sidebar-light-white elevation-1" style="border-right: 1px solid #e2e8f0;">

    <a href="#" class="brand-link border-bottom-0 d-flex align-items-center" style="padding: 20px 24px; background: #fff;">
        <img src="{{ asset('img/logoe.png') }}" 
             alt="Logo" 
             style="height: 32px; width: auto; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.05));" 
             class="brand-image">
        <span class="brand-text font-weight-bold" style="font-size: 1.2rem; color: #0f172a; letter-spacing: -0.5px; margin-left: 10px;">e-Gang</span>
    </a>

    <div class="sidebar d-flex flex-column" style="padding: 0 14px;">
        
        <nav class="mt-3 flex-grow-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                
                <li class="nav-header text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px; color: #94a3b8; padding: 10px 12px;">Platform</li>

                <li class="nav-item mb-1">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                       style="border-radius: 10px; padding: 10px 12px; transition: all 0.2s;">
                        <i class="nav-icon fas fa-th-large" style="font-size: 1.1rem;"></i>
                        <p style="font-weight: 500;">Dashboard</p>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('campus-profile.index') }}" class="nav-link {{ request()->routeIs('campus-profile.*') ? 'active' : '' }}" 
                       style="border-radius: 10px; padding: 10px 12px;">
                        <i class="nav-icon fas fa-university"></i>
                        <p style="font-weight: 500;">Profil Kampus</p>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
                       style="border-radius: 10px; padding: 10px 12px;">
                        <i class="nav-icon fas fa-users"></i>
                        <p style="font-weight: 500;">Users</p>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('export.index') }}" class="nav-link {{ request()->routeIs('export.*') ? 'active' : '' }}"
                       style="border-radius: 10px; padding: 10px 12px;">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p style="font-weight: 500;">Export Data</p>
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('pengajuan_surat.index') }}" class="nav-link {{ request()->routeIs('pengajuan_surat.*') ? 'active' : '' }}"
                       style="border-radius: 10px; padding: 10px 12px;">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p style="font-weight: 500;">Surat Pengantar</p>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="user-panel-footer mt-auto" style="padding-bottom: 20px;">
            <div class="d-flex align-items-center p-3" style="background: #f8fafc; border-radius: 12px; border: 1px solid #f1f5f9;">
                <div class="image">
                    <div class="img-circle d-flex align-items-center justify-content-center" 
                         style="width: 40px; height: 40px; background: #ff6600; color: white; box-shadow: 0 4px 6px -1px rgba(255, 102, 0, 0.2);">
                        <span class="font-weight-bold" style="font-size: 14px;">AD</span>
                    </div>
                </div>
                <div class="info flex-grow-1 ml-3">
                    <span class="d-block font-weight-bold text-dark" style="font-size: 0.9rem; line-height: 1.2;">Admin</span>
                    <span class="text-muted" style="font-size: 0.75rem;">Administrator</span>
                </div>
                <div class="logout">
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-sm btn-light" style="border-radius: 8px; color: #ef4444;">
                        <i class="fas fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
        
    </div>
</aside>

<style>
    .sidebar-light-white .nav-sidebar > .nav-item > .nav-link.active {
        background-color: #fff5f0 !important;
        color: #ff6600 !important;
        box-shadow: none;
    }

    .sidebar-light-white .nav-sidebar > .nav-item > .nav-link:hover:not(.active) {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .nav-sidebar .nav-link p {
        margin-left: 8px;
    }

    .nav-sidebar .nav-link i.right {
        display: none;
    }
</style>