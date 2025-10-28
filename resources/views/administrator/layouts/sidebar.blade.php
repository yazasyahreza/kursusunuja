<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
            <span class="align-middle">Aplikasi Kursus</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ Route::is('kursus.view') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kursus.view') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Kursus
                        Card</span>
                </a>
            </li>


            <li class="sidebar-header">
                Master
            </li>

            <li class="sidebar-item {{ Route::is('master.instruktur.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('master.instruktur.index') }}">
                    <i class="align-middle" data-feather="check-square"></i> <span
                        class="align-middle">Instruktur</span>
                </a>
            </li>

            
            <li class="sidebar-item {{ Route::is('master.peserta.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('master.peserta.index') }}">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Peserta</span>
                </a>
            </li>
            
            <li class="sidebar-item {{ Route::is('master.kursus.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('master.kursus.index') }}">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Kursus</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('master.peserta-kursus.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('master.peserta-kursus.index') }}">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Peserta
                        Kursus</span>
                </a>
            </li>

            <li class="sidebar-header">
                Sistem
            </li>

            {{-- <li class="sidebar-item {{ Route::is('kursus.view') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kursus.view') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Kursus
                        Card</span>
                </a>
            </li> --}}

            <li class="sidebar-item">
                <a class="sidebar-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="align-middle" data-feather="log-out"></i>
                    <span class="align-middle">Log out</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

    </div>
</nav>
