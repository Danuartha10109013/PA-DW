<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>PRESENSI PT ZEN</title>
  <!-- loader-->
  {{-- <link href="{{ asset('assets/dashtreme-master/assets/css/pace.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('assets/dashtreme-master/assets/js/pace.min.js') }}"></script> --}}
  <!--favicon-->
  <link rel="icon" href="{{ asset('images/favicon.jpg') }}" type="image/x-icon">
  <!-- Vector CSS -->
  {{-- <link href="{{ asset('assets/dashtreme-master/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}"
    rel="stylesheet" /> --}}
  <!-- simplebar CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/animate.css') }}" rel="stylesheet" type="text/css') }}" />
  <!-- Icons CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/icons.css') }}" rel="stylesheet" type="text/css') }}" />
  <!-- Sidebar CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/sidebar-menu.css') }}" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/app-style.css') }}" rel="stylesheet" />
  {{-- Datatable --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.3/css/responsive.dataTables.min.css">

  {{-- FontAwesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  {{-- <script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/instascan.min.js" defer></script> --}}
  {{-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}

</head>

<body class="bg-theme bg-theme9">
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const lastRun = localStorage.getItem('last_generate_date');
        const today = new Date().toISOString().slice(0, 10); // format YYYY-MM-DD

        if (lastRun !== today) {
            // Jalankan otomatis hanya sekali hari ini
            fetch("/backoffice/office/generate")
                .then(response => {
                    if (response.ok) {
                        console.log("Generate berhasil dijalankan.");
                        localStorage.setItem('last_generate_date', today);
                    } else {
                        console.error("Gagal generate:", response.status);
                    }
                })
                .catch(error => {
                    console.error("Error saat generate:", error);
                });
        }
    });
</script>

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    @include('backoffice.layout.sidebar')
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    @include('backoffice.layout.header')
    <!--End topbar header-->

    <div class="clearfix"></div>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!--Start Dashboard Content-->

        @yield('content')

        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

      </div>
      <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    @include('backoffice.layout.footer')

    <!--End footer-->

    <!--start color switcher-->
    <div class="right-sidebar">
      <div class="switcher-icon">
        <i class="fa fa-cog fa-spin"></i>
      </div>
      <div class="right-sidebar-content">

        <p class="mb-0">Gaussion Texture</p>
        <hr>

        <ul class="switcher">
          <li id="theme1"></li>
          <li id="theme2"></li>
          <li id="theme3"></li>
          <li id="theme4"></li>
          <li id="theme5"></li>
          <li id="theme6"></li>
        </ul>

        <p class="mb-0">Gradient Background</p>
        <hr>

        <ul class="switcher">
          <li id="theme7"></li>
          <li id="theme8"></li>
          <li id="theme9"></li>
          <li id="theme10"></li>
          <li id="theme11"></li>
          <li id="theme12"></li>
          <li id="theme13"></li>
          <li id="theme14"></li>
          <li id="theme15"></li>
        </ul>

      </div>
    </div>
    <!--end color switcher-->

  </div>
  <!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/dashtreme-master/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/dashtreme-master/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/dashtreme-master/assets/js/bootstrap.min.js') }}"></script>

  <!-- simplebar js -->
  <script src="{{ asset('assets/dashtreme-master/assets/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('assets/dashtreme-master/assets/js/sidebar-menu.js') }}"></script>
  <!-- loader scripts -->
  <script src="{{ asset('assets/dashtreme-master/assets/js/jquery.loading-indicator.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('assets/dashtreme-master/assets/js/app-script.js') }}"></script>
  <!-- Chart js -->
  {{-- <script src="{{ asset('assets/dashtreme-master/assets/plugix`ns/Chart.js/Chart.min.js') }}"></script> --}}

  <!-- Index js -->
  <script src="{{ asset('assets/dashtreme-master/assets/js/index.js') }}"></script>

  {{-- Datatable --}}
  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.3/js/dataTables.responsive.min.js"></script>
  <script>
    $(function () {
      $("#myTable").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>

</body>

</html>