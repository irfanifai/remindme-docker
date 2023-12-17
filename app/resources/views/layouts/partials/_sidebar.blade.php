<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">Reminder</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Ar</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin</li>
            {{-- Home --}}
            <li>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Halaman Utama</span>
                </a>
            </li>
            {{-- Reminder --}}
            <li>
                <a class="nav-link" href="{{ route('reminder.index') }}">
                    <i class="fas fa-file"></i> 
                    <span>Reminder</span>
                </a>
            </li>
            {{-- User --}}
            <li>
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="far fa-user"></i> 
                    <span>Pengguna</span>
                </a>
            </li>
            {{-- User --}}
            <li>
                <a target="_blank" class="nav-link" href="{{ url('/api/documentation') }}">
                    <i class="far fa-file"></i> 
                    <span>API Documentation</span>
                </a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">Logout</button>
            </form>
        </div>

    </aside>
</div>
