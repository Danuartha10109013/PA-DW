<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ABSENSI PT ZEN</title>
  <!-- loader-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/pace.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('assets/dashtreme-master/assets/js/pace.min.js') }}"></script>
  <!--favicon-->
  <link rel="icon" href="{{ asset('images/favicon.jpg') }}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
  <!-- Custom Style-->
  <link href="{{ asset('assets/dashtreme-master/assets/css/app-style.css') }}" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">

  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader -->

  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="loader-wrapper">
      <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="card card-authentication1 mx-auto my-5">
      <div class="card-body">

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex" role="alert">
          <strong class="ml-2 mr-2">Gagal </strong> | {{ session('error') }}
          <button type="button" class="close" style="margin-top: -17px" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
          <strong class="ml-2 mr-2">Berhasil </strong> | {{ session('success') }}
          <button type="button" class="close" style="margin-top: -17px" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <div class="card-content p-2">
          <div class="text-center">
            <img src="{{ asset('images/zen-2.webp') }}" class="img-fluid" alt="logo icon">
          </div>
          <div class="card-title text-uppercase text-center py-3">Atur ulang password</div>
          <form action="/reset-password/{{ $user->remember_token }}/action" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="exampleInputPassword" class="sr-only">Password</label>
              <div class="position-relative has-icon-right">
                <input type="password" name="password" id="exampleInputPassword" class="form-control input-shadow"
                  placeholder="Enter Password" required
                  oninvalid="this.setCustomValidity('Password tidak boleh kosong')" oninput="setCustomValidity('')">
                <div class="form-control-position">
                  <i class="icon-lock"></i>
                </div>
                @if ($errors->has('password'))
                  <small class="help-block" style="color: white">{{ $errors->first('password') }}</small>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputPasswordCnfirmation" class="sr-only">Konfirmasi password</label>
              <div class="position-relative has-icon-right">
                <input type="password" name="password_confirmation" id="exampleInputPasswordConfirmation" class="form-control input-shadow"
                  placeholder="Enter Password_confirmation" required
                  oninvalid="this.setCustomValidity('Password_confirmation tidak boleh kosong')" oninput="setCustomValidity('')">
                <div class="form-control-position">
                  <i class="icon-lock"></i>
                </div>
                @if ($errors->has('password_confirmation'))
                  <small class="help-block" style="color: white">{{ $errors->first('password_confirmation') }}</small>
                @endif
              </div>
            </div>
            <button type="submit" class="btn btn-light btn-block">
              <i class="fa fa-edit fa-1x"></i> Atur ulang password
            </button>

          </form>
        </div>
      </div>
      <div class="card-footer text-center py-3">
        {{-- <p class="text-warning mb-0">Do not have an account? <a href="/register"> Sign Up here</a></p> --}}
      </div>
    </div>

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--start color switcher-->
    <div class="right-sidebar">
      <div class="switcher-icon">
        <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
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
  <!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/dashtreme-master/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/dashtreme-master/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/dashtreme-master/assets/js/bootstrap.min.js') }}"></script>

  <!-- sidebar-menu js -->
  <script src="{{ asset('assets/dashtreme-master/assets/js/sidebar-menu.js') }}"></script>

  <!-- Custom scripts -->
  <script src="{{ asset('assets/dashtreme-master/assets/js/app-script.js') }}"></script>

</body>

</html>