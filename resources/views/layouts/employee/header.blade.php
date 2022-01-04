<header id="page-topbar">
    <div class="navbar-header">
    
        <div class="d-flex px-3">
            <a href="/" class="logo logo-light mr-3">
                    <span class="logo-sm">
                        <img src="/assets/images/dost.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-dost.png" alt="" height="30">
                    </span>
            </a>
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <employee-notifications-d ref="notification"></employee-notifications-d>
            <employee-notifications-t :profile=" {{ json_encode($profile) }}" ref="notification"></employee-notifications-t>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset('images/avatars/'.Auth::user()->avatar)}}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1" key="t-henry">{{ Auth::user()->profile->firstname }} {{Auth::user()->profile->lastname}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="/profile"><i class="bx bx-user font-size-16 align-middle mr-1"></i> <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item d-block" data-toggle="modal" data-target="#settings"><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> <span key="t-settings">Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" data-toggle="modal" data-target="#settings" class="btn header-item noti-icon waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button> 
            </div>

        </div>
    </div>
            </header>