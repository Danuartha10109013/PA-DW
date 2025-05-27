@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Presensi WFO Hari Ini</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Presensi WFO Hari Ini</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Presensi WFO</h3>
                </div>
                
                <div class="card-body">

                    {{-- if validation error --}}
                    {{ $errors->any() ? $errors->first() : '' }}

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" absent="alert">
                        <strong class="ml-2 mr-2">Berhasil </strong> | {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" absent="alert">
                        <strong class="ml-2 mr-2">Gagal </strong> | {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">
                        
                        <div class="col-md-4 mb-3">
                            <div class="wfo-choice">
                                
                                <form action="/backoffice/absen/store" method="POST" id="form">
                                    @csrf
                                    
                                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-3">
                                        @if ($absentToday)
                                            @if ($absentToday->status == 'hadir')
                                                @if ($absentToday->end == null)
                                                    <div id="qr-reader" style="width:100%"></div>
                                                    <div id="qr-reader-results"></div>
                                                @else
                                                    <img src="{{ asset('images/favicon.jpg') }}" alt="qr-code" class="img-fluid rounded" style="width: 80%; height: 300px;">
                                                @endif
                                                {{-- <div id="qr-reader" style="width:100%"></div>
                                                <div id="qr-reader-results"></div> --}}
                                            @else
                                                <img src="{{ asset('images/favicon.jpg') }}" alt="qr-code" class="img-fluid rounded" style="width: 100%; height: 300px;">
                                            @endif
                                        @else
                                            <div id="qr-reader" style="width:100%"></div>
                                            <div id="qr-reader-results"></div>
                                        @endif
                                    </div>

                                    <input type="hidden" name="qrcode" id="qrcode">
                                </form>
                    
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-outline card-primary bg-primary">
                                <div class="card-body">
                                    <h3 class="text-center">
                                        <b> {{ \Carbon\Carbon::parse(date('Y-m-d'))->locale('id')->isoFormat('dddd, D
                                            MMMM YYYY') }}
                                        </b>    
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card bg-success">
                                        <div class="card-body">
                                            <h3>Presensi Masuk</h3>

                                            @if ($absentToday)
                                                @if ($absentToday->status == 'hadir')
                                                    {{ $absentToday->start }} | Status: {{ strtoupper($absentToday->status_absent) }}
                                                @else
                                                    Anda sedang {{ $absentToday->status }}
                                                @endif
                                            @else
                                                Belum Presensi
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-warning">
                                        <div class="card-body">
                                            <h3>Presensi Pulang</h3>
                                            @if ($absentToday)
                                                @if ($absentToday->status == 'hadir')
                                                    @if ($absentToday->end == null)
                                                        Belum Presensi
                                                    @else
                                                        {{ $absentToday->end }}
                                                    @endif
                                                @else
                                                    Anda sedang {{ $absentToday->status }}
                                                @endif
                                            @else
                                                Belum Presensi
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-info">
                                        <div class="card-body">
                                            <h3>Status Presensi</h3>
                                            @if ($absentToday)
                                                {{ $absentToday->status }}
                                            @else
                                                Belum Presensi
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- if session home-early --}}
    @if(session('home-early'))
    <button title="Tambah" type="button" id="home-early" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#home-early-{{ $absentToday->id }}">
        <span class="fa fa-plus"></span>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('home-early').click();
        });
    </script>

    @include('backoffice.karyawan.absent.modal.home-early')
    @endif

    {{-- <script type="text/javascript" src="instascan.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/instascan.min.js"></script> --}}
    {{-- <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
          console.log('QR Code Scanned:', content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
          if (cameras.length > 0) {
            scanner.start(cameras[0]);
          } else {
            console.error('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
        });
    </script> --}}

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                console.log(`Scan result ${decodedText}`, decodedResult);
            }

            $('#result').val(decodedText);
            let id = decodedText;
            console.log(id);

            html5QrcodeScanner.clear().then(_ => {
                document.getElementById('qrcode').value = id;
                document.getElementById('form').submit();
            });
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250,
                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
            });

        html5QrcodeScanner.render(onScanSuccess);

        html5QrcodeScanner.start(
            { facingMode: { exact: "environment" } },
            { fps: 10, qrbox: 250 },
            onScanSuccess
        );

        document.querySelector('.html5-qrcode-button-camera-stop').style.display = 'inline-block';
        document.querySelector('.html5-qrcode-camera-selector').style.display = 'none';
    </script>

@endsection