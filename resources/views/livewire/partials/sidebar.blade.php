<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="./assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{auth()->user()->username}}</div><small>Admin</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li class="heading">PAGES</li>
            <li class="{{request()->routeIs('users') ? 'active' : '' }}">
                <a href="{{route('users')}}" wire:navigate><i class="sidebar-item-icon fa fa-calendar"></i>
                    <span class="nav-label">Users</span>
                </a>
            </li>
            <li class="{{request()->routeIs('employees') ? 'active' : '' }}">
                <a href="{{route('employees')}}" wire:navigate><i class="sidebar-item-icon fa fa-calendar"></i>
                    <span class="nav-label">Employees</span>
                </a>
            </li>
            <li class="{{request()->routeIs(['cities','countries','states','departments']) ? 'active' : '' }}">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-envelope"></i>
                    <span class="nav-label">Tools</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{route('countries')}}" wire:navigate>Country</a>
                    </li>
                    <li>
                        <a href="{{route('states')}}" wire:navigate>State</a>
                    </li>
                    <li>
                        <a href="{{route('cities')}}" wire:navigate>City</a>
                    </li>
                    <li>
                        <a href="{{route('departments')}}" wire:navigate>Department</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>