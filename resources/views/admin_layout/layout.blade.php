@include('admin_layout.header')



<div class="main-wrapper">
    <div class="header">
        <div class="header-left active">
            <a href="{{route('admin.dashboard')}}" class="logo">
                <img src="{{ asset('admin/assets/img/logo.png') }}" alt="" />
            </a>
            <a href="{{route('admin.dashboard')}}" class="logo-small">
                <img src="{{ asset('admin/assets/img/logo-small.png') }}" alt="" />
            </a>
            <a id="toggle_btn" href="javascript:void(0);"> </a>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <ul class="nav user-menu">
            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#">
                        <div class="searchinputs">
                            <input type="text" placeholder="Search Here ..." />
                            <div class="search-addon">
                                <span><img src="{{ asset('admin/assets/img/icons/closes.svg') }}"
                                        alt="img" /></span>
                            </div>
                        </div>
                        <a class="btn" id="searchdiv"><img src="{{ asset('admin/assets/img/icons/search.svg') }}"
                                alt="img" /></a>
                    </form>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <img src="{{ asset('admin/assets/img/icons/notification-bing.svg') }}" alt="img" />
                    <span class="badge rounded-pill">4</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti">
                            Clear All
                        </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt=""
                                                src="{{ asset('admin/assets/img/profiles/avatar-02.jpg') }}" />
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title">John Doe</span>
                                                added new task
                                                <span class="noti-title">Patient appointment
                                                    booking</span>
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time">4 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#">View all Notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-img"><img src="{{ asset('admin/assets/img/profiles/avator1.jpg') }}"
                            alt="" />
                        <span class="status online"></span></span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <span class="user-img"><img src="{{ asset('admin/assets/img/profiles/avator1.jpg') }}"
                                    alt="" />
                                <span class="status online"></span></span>
                            <div class="profilesets">
                                <h6>{{ Auth::guard('admin')->user()->first_name }}</h6>
                                <h5>Admin</h5>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <a class="dropdown-item" href="#">
                            <i class="me-2" data-feather="user"></i> My
                            Profile</a>
                        <hr class="m-0" />
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <a class="dropdown-item logout pb-0" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"><img
                                    src="{{ asset('admin/assets/img/icons/log-out.svg') }}" class="me-2"
                                    alt="img" />Logout</a>
                        </form>
                    </div>
                </div>
            </li>
        </ul>

        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">My Profile</a>
                <form action="{{ route('admin.logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
            </div>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
        @include('admin_layout.sidebar')
    </div>

    <div class="page-wrapper">
        @yield('content')
    </div>
</div>

@include('admin_layout.footer')
