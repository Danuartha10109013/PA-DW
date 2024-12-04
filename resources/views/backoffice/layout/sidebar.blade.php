<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="/backoffice/dashboard">
            <img src="{{ asset('images/zen-2.webp') }}" class="logo-icon " style="height: 50px; width: 100%; padding: 3px;"
                alt="logo icon">
            {{-- <h5 class="logo-text">Pt Zen</h5> --}}
        </a>
    </div>

    <hr>

    <ul class="sidebar-menu do-nicescrol">

        @if (Auth::user()->role_id == 1)
            <li class="{{ request()->is('backoffice/dashboard', 'backoffice/dashboard/*') ? 'active' : '' }}">
                <a href="/backoffice/dashboard">
                    <i class="fa fa-home"></i> <span>Beranda</span>
                </a>
            </li>
        @endif

        <li class="sidebar-header">DATA ABSENSI</li>

        @if (Auth::user()->role_id == 2)
            <li class="{{ request()->is('backoffice/absen', 'backoffice/absen/*') ? 'active' : '' }}">
                <a href="/backoffice/absen">
                    <i class="fa fa-calendar-alt"></i> <span>Absen</span>
                </a>
            </li>
        @endif
        
        <li class="{{ request()->is('backoffice/absensi', 'backoffice/absensi/*') ? 'active' : '' }}">
            <a href="/backoffice/absensi">
                <i class="fa fa-calendar-check"></i> <span>Absensi</span>
            </a>
        </li>
        
        @if (Auth::user()->role_id == 1)
            
            <li class="sidebar-header">DATA MASTER</li>

            <li class="{{ request()->is('backoffice/office', 'backoffice/office/*') ? 'active' : '' }}">
                <a href="/backoffice/office">
                    <i class="fa fa-qrcode"></i> <span>Kantor / QR Code</span>
                </a>
            </li>

            <li class="{{ request()->is('backoffice/shift', 'backoffice/shift/*') ? 'active' : '' }}">
                <a href="/backoffice/shift">
                    <i class="fa fa-clock"></i> <span>Shift</span>
                </a>
            </li>

            <li class="sidebar-header">DATA PENGGUNA</li>

            <li class="{{ request()->is('backoffice/role', 'backoffice/role/*') ? 'active' : '' }}">
                <a href="/backoffice/role">
                    <i class="fa fa-list"></i> <span>Peran</span>
                </a>
            </li>

            <li class="{{ request()->is('backoffice/user', 'backoffice/user/*') ? 'active' : '' }}">
                <a href="/backoffice/user">
                    <i class="fa fa-user-friends"></i> <span>Pengguna</span>
                </a>
            </li>

        @endif


        <li class="sidebar-header">DATA PENGAJUAN ABSEN</li>

        <li class="{{ request()->is('backoffice/cuti', 'backoffice/cuti/*') ? 'active' : '' }}">
            <a href="/backoffice/cuti">
                <i class="fa fa-list"></i> <span>Cuti</span>
            </a>
        </li>

        <li class="{{ request()->is('backoffice/izin-sakit', 'backoffice/izin-sakit/*') ? 'active' : '' }}">
            <a href="/backoffice/izin-sakit">
                <i class="fa fa-list"></i> <span>Izin / Sakit</span>
            </a>
        </li>

    </ul>

</div>