<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/backoffice/dashboard" class="brand-link">
        {{-- <img src="{{ asset('images/zen-2.webp') }}"
                alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: .8"> --}}
        <img src="{{ asset('images/zen-2.webp') }}" class="img-fluid" style="height: 50px">
        <span class="brand-text" style="text-transform: uppercase">
            {{-- <b>PST</b> --}}
        </span>
        {{-- <div class="d-flex "> --}}
            {{-- <div>
                <img src="{{ asset('images/absen-logo.png') }}" alt="AdminLTE Logo" class="brand-image"
                    style="opacity: .8; width: 100%">
            </div> --}}
            {{-- <div class="ml-2">
                <span class="brand-text" style="text-transform: uppercase"> <b>Absensi</b> </span>
            </div> --}}
        {{-- </div> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 mb-3 text-center">

            <div class="info">
                <p style="text-transform: uppercase; color: #fff">
                    <b>{{ Auth::user()->name}}</b>
                </p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a href="/backoffice/dashboard"
                        class="nav-link {{ request()->is('backoffice/dashboard', 'backoffice/dashboard/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role_id == 1)
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a href="/backoffice/office"
                        class="nav-link {{ request()->is('backoffice/office', 'backoffice/office/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-qrcode"></i>
                        <p>
                            Kantor / Qr Code
                        </p>
                    </a>
                </li>

                <li class="nav-header">DATA KARYAWAN</li>
                <li class="nav-item">
                    <a href="/backoffice/user"
                        class="nav-link {{ request()->is('backoffice/user', 'backoffice/user/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user-friends"></i>
                        <p>
                            Karyawan
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role_id == 2)
                    <li class="nav-item">
                    <a href="/backoffice/beranda/home"
                        class="nav-link {{ request()->is('backoffice/beranda/home', 'backoffice/beranda/home/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role_id != 3)
                    <li class="nav-header">DATA PRESENSI</li>
                @endif

                @if (Auth::user()->role_id == 2)
                <li class="nav-item">
                    <a href="/backoffice/absen"
                        class="nav-link {{ request()->is('backoffice/absen', 'backoffice/absen/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-calendar-alt"></i>
                        <p>
                            Presensi WFO
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/backoffice/wfh"
                        class="nav-link {{ request()->is('backoffice/wfh', 'backoffice/wfh/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-calendar-alt"></i>
                        <p>
                            Presensi WFH
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role_id != 3)
                    <li class="nav-item">
                        <a href="/backoffice/absensi"
                            class="nav-link {{ request()->is('backoffice/absensi', 'backoffice/absensi/*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-calendar-check"></i>
                            <p>
                                Data Presensi
                            </p>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->role_id == 1)
                <li class="nav-header">DATA PENGAJUAN PRESENSI</li>
                <li class="nav-item">
                    <a href="/backoffice/cuti"
                        class="nav-link {{ request()->is('backoffice/cuti', 'backoffice/cuti/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Cuti
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/backoffice/izin-sakit"
                        class="nav-link {{ request()->is('backoffice/izin-sakit', 'backoffice/izin-sakit/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Izin/Sakit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/backoffice/data-wfh"
                        class="nav-link {{ request()->is('backoffice/data-wfh', 'backoffice/data-wfh/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            WFH
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                <li class="nav-header">DATA REPORT</li>
                <li class="nav-item">
                    <a href="/backoffice/report"
                        class="nav-link {{ request()->is('backoffice/report', 'backoffice/report/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-calendar-check"></i>
                        <p>
                            Report Presensi
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        
    </div>
    
</aside>
