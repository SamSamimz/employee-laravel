<header class="header">
    <div class="page-brand">
        <a class="link" href="{{route('home')}}" wire:navigate>
            <span class="brand">{{auth()->user()->first_name}}
                <span class="brand-tip">{{auth()->user()->last_name}}</span>
            </span>
            <span class="brand-mini">EL</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="./assets/img/admin-avatar.png" />
                    <span></span>Admin<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/"><i class="fa fa-user"></i>Profile</a>
                    <li class="dropdown-divider"></li>
                    <a wire:click='logoutUser()' class="dropdown-item"><i class="fa fa-power-off"></i>Logout</a>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>