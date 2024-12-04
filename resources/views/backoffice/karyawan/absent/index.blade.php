@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Absen Hari Ini</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Absen Hari Ini</li>
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
                    <h3 class="card-title">Absen</h3>
                </div>
                <div class="card-body">

                    {{-- if validation error --}}
                    {{ $errors->any() ? $errors->first() : '' }}

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" absent="alert">
                        <strong class="ml-2 mr-2">Berhasil </strong> | {{ session('success') }}
                        <button type="button" class="close" style="margin-top: -20px;" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" absent="alert">
                        <strong class="ml-2 mr-2">Gagal </strong> | {{ session('error') }}
                        <button type="button" class="close" style="margin-top: -20px;" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">
                        
                        {{-- <div class="col-md-4 mb-3">
                            <form action="/backoffice/absent/store" method="POST">
                                @csrf
                                <div class="card card-outline card-primary bg-light">
                                    <div class="card-body">

                                        <input type="hidden" id="latitude" name="latitude" class="form-control">
                                        <input type="hidden" id="longitude" name="longitude" class="form-control">

                                        @if ($absentToday)
                                            @if ($absentToday->status != 'Absen')
                                                <select name="shift_id" class="form-control" disabled>
                                                    <option value="">-- Tidak ada shift --</option>
                                                </select>
                                            @elseif ($absentToday->start)
                                                <input type="text" name="shift_id" value="Shift {{ $absentToday->shift->name }} | {{ $absentToday->shift->start }} - {{ $absentToday->shift->end }}" disabled class="form-control">
                                            @endif
                                        @else
                                            <select name="shift_id" class="form-control" required id="shift"
                                                oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Pilihan shift harus diisi')">
                                                <option value="">-- Pilihan Shift --</option>
                                                @foreach ($shifts as $shift)
                                                <option value="{{ $shift->id }}">Shift {{ $shift->name }} | {{ $shift->start }} - {{ $shift->end }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="card card-outline card-primary bg-light" style="height: 475px">
                                    <div class="card-body">
                                        <div class="wfo-choice">

                                            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-3">
                                                <div id="qr-reader" style="width:100%"></div>
                                                <div id="qr-reader-results"></div>
                                            </div>
                                
                                            <form action="/karyawan/absen" method="POST" id="form">
                                                @csrf
                                                <input type="hidden" name="qrcode" id="qrcode">
                                            </form>
                                
                                        </div>
                                    </div>
                                </div>
                                @if ($absentToday)
                                    @if ($absentToday->start && !$absentToday->end)
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <span class="fa fa-sign-out"></span> Absen Pulang
                                        </button>
                                    @elseif ($absentToday->end)
                                        <button type="button" class="btn btn-success btn-block">
                                            <span class="fa fa-check"></span> Anda Sudah Absen
                                        </button>
                                    @elseif ($absentToday->status != 'Absen')
                                        <button type="button" class="btn btn-success btn-block">
                                            <span class="fa fa-check"></span> Anda sedang {{ $absentToday->status }}
                                        </button>
                                    @endif
                                @else
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <span class="fa fa-sign-in"></span> Absen Masuk
                                    </button>
                                @endif
                            </form>
                        </div> --}}
                        
                        <div class="col-md-4 mb-3">
                            <div class="wfo-choice">
                                
                                <form action="/backoffice/absen/store" method="POST" id="form">
                                    @csrf

                                    @if ($absentToday)
                                        @if ($absentToday->status == 'hadir')
                                            <input type="hidden" name="shift_id" value="{{ $absentToday->shift_id }}">
                                            <input type="text" value="Shift {{ $absentToday->shift->name }} | {{ $absentToday->shift->start }} - {{ $absentToday->shift->end }}" disabled class="form-control">
                                        @else
                                            <input type="text" value="Anda sedang {{ $absentToday->status }}" disabled class="form-control">
                                        @endif
                                    @else
                                        <select name="shift_id" class="form-control @if ($errors->has('shift_id')) is-invalid @endif" required id="shift"
                                            oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Pilihan shift harus diisi')">
                                            <option value="">-- Pilihan Shift --</option>
                                            @foreach ($shifts as $shift)
                                            <option value="{{ $shift->id }}">Shift {{ $shift->name }} | {{ $shift->start }} - {{ $shift->end }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('shift_id'))
                                            <h5 class="text-danger">{{ $errors->first('shift_id') }}</small>
                                        @endif
                                    @endif

                                    {{-- @if ($absentToday)
                                        @if ($absentToday->status != 'hadir')
                                            <select name="shift_id" class="form-control" disabled>
                                                <option value="">-- Tidak ada shift --</option>
                                            </select>
                                            @elseif ($absentToday->start)
                                                <input type="text" name="shift_id" value="Shift {{ $absentToday->shift->name }} | {{ $absentToday->shift->start }} - {{ $absentToday->shift->end }}" disabled class="form-control">
                                            @endif
                                        @else
                                            <select name="shift_id" class="form-control @if ($errors->has('shift_id')) is-invalid @endif" required id="shift"
                                                oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Pilihan shift harus diisi')">
                                                <option value="">-- Pilihan Shift --</option>
                                                @foreach ($shifts as $shift)
                                                <option value="{{ $shift->id }}">Shift {{ $shift->name }} | {{ $shift->start }} - {{ $shift->end }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('shift_id'))
                                                <h5 class="text-danger">{{ $errors->first('shift_id') }}</small>
                                            @endif
                                    @endif --}}
                                    
                                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-3">
                                        @if ($absentToday)
                                            @if ($absentToday->status == 'hadir')
                                                <div id="qr-reader" style="width:100%"></div>
                                                <div id="qr-reader-results"></div>
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
                            <div class="card card-outline card-primary bg-light">
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
                                            <h3>Absen Masuk</h3>
                                            @if ($absentToday)
                                                @if ($absentToday->start == null)
                                                    @if ($absentToday->status != 'hadir')
                                                        Anda sedang {{ $absentToday->status }}
                                                    @else
                                                        Belum Absen
                                                    @endif
                                                @else
                                                    {{ $absentToday->start }}
                                                @endif
                                            @else
                                                Belum Absen
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-warning">
                                        <div class="card-body">
                                            <h3>Absen Pulang</h3>
                                            @if ($absentToday)
                                                @if ($absentToday->end == null)
                                                    @if ($absentToday->status != 'hadir')
                                                    Anda sedang {{ $absentToday->status }}
                                                @else
                                                    Belum Absen
                                                @endif
                                                @else
                                                    {{ $absentToday->end }}
                                                @endif
                                            @else
                                                Belum Absen
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-info">
                                        <div class="card-body">
                                            <h3>Status Absen</h3>
                                            @if ($absentToday)
                                                {{ $absentToday->status }}
                                            @else
                                                Belum Absen
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="map" style="height: 400px"></div>
                        </div>

                    </div>


                    {{-- <div class="wfo-choice">

                        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-3">
                            <div id="qr-reader" style="width:100%"></div>
                            <div id="qr-reader-results"></div>
                        </div>
            
                        <form action="/karyawan/absen" method="POST" id="form">
                            @csrf
                            <input type="hidden" name="qrcode" id="qrcode">
                        </form>
            
                    </div> --}}


                </div>

            </div>

        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
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

    {{-- <script src="https://unpkg.com/html5-qrcode"></script>
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
    </script> --}}

</section>

@endsection