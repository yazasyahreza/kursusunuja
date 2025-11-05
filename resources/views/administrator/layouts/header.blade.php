<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-link d-none d-sm-inline-block">
                    <span class="text-dark">Welcome, <strong>{{ Auth::user()->name }}!</strong></span>
                </a>

            </li>
        </ul>
    </div>
</nav>


