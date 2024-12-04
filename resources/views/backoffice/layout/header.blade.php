<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon fa fa-bars"></i>
                </a>
            </li>
            {{-- <li class="nav-item">
                <form class="search-bar">
                    <input type="text" class="form-control" placeholder="Enter keywords">
                    <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                </form>
            </li> --}}
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
            <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                    href="javascript:void();">
                    <i class="fa fa-envelope-open-o"></i></a>
            </li>
            <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                    href="javascript:void();">
                    <i class="fa fa-bell-o"></i></a>
            </li>
            {{-- <li class="nav-item language">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                    href="javascript:void();"><i class="fa fa-flag"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
                </ul>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile">
                        @if (Auth::user()->foto)
                            <img class="align-self-start mr-3" src="{{ Storage::disk('public')->url(Auth::user()->foto) }}" alt="user avatar">
                        @else
                            <img class="align-self-start mr-3" src="{{ asset('images/profile-default.jpg') }}" alt="user avatar">
                        @endif
                        <i class="fa fa-caret-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar">

                                    @if (Auth::user()->foto)
                                        <img class="align-self-start mr-3" src="{{ Storage::disk('public')->url(Auth::user()->foto) }}" alt="user avatar">
                                    @else
                                        <img class="align-self-start mr-3" src="{{ asset('images/profile-default.jpg') }}" alt="user avatar">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
                                    <p class="user-subtitle">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item">
                        <a href="/backoffice/user/{{ Auth::user()->id }}/profile">
                            <i class="fa fa-user mr-2"></i> Profil
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item">
                        <a href="/logout">
                            <i class="fa fa-sign-out mr-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>