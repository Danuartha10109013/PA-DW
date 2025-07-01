@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Presensi WFH Hari Ini</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Presensi WFH Hari Ini</li>
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
                    <h3 class="card-title">Presensi WFH</h3>
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
                                            <span class="fa fa-sign-out"></span> Presensi Pulang
                                        </button>
                                    @elseif ($absentToday->end)
                                        <button type="button" class="btn btn-success btn-block">
                                            <span class="fa fa-check"></span> Anda Sudah Presensi
                                        </button>
                                    @elseif ($absentToday->status != 'Absen')
                                        <button type="button" class="btn btn-success btn-block">
                                            <span class="fa fa-check"></span> Anda sedang {{ $absentToday->status }}
                                        </button>
                                    @endif
                                @else
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <span class="fa fa-sign-in"></span> Presensi Masuk
                                    </button>
                                @endif
                            </form>
                        </div> --}}
                        
                        <div class="col-md-4 mb-3">
                            <div class="wfo-choice">
                                
                                <form action="/backoffice/wfh/wfh-store" method="POST" id="form" enctype="multipart/form-data">
                                    @csrf


                                    @if ($absentToday)
                                        @if ($absentToday->status == 'wfh')
                                            <button type="button" class="btn btn-success btn-sm btn-block mt-2" data-toggle="modal"
                                                data-target="#wfh-add" title="Tambah">
                                                <h3>
                                                    @if ($absentToday)
                                                        @if ($absentToday->start && $absentToday->end)
                                                            <i class="fa fa-check"></i> Anda Sudah Presensi
                                                        @else
                                                            <i class="fa fa-sign-out"></i> Presensi Pulang
                                           
                                                        @endif
                                                    @else
                                                        <i class="fa fa-sign-in"></i> Presensi Masuk
                                                    @endif
                                                </h3>
                                            </button>
                                                                                               <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                                                            <div class="form-group mb-3">
                                                                    <label for="latitude">Latitude</label>
                                                                    <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label for="longitude">Longitude</label>
                                                                    <input type="text" id="longitude" name="longitude" class="form-control" readonly>
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label for="alamat">Alamat Lengkap</label>
                                                                    <textarea id="alamat" name="alamat" class="form-control" rows="2" readonly></textarea>
                                                                </div>
                                            @include('backoffice.karyawan.absent.modal.wfh-add')
                                        @else
                                            <button type="button" class="btn btn-success btn-sm btn-block mt-2">
                                                <h3>Anda sedang {{ $absentToday->status }}</h3>
                                            </button>
                                        @endif
                                    @else

                                            <style>
                                                #camera-wrapper {
                                                    position: relative;
                                                    width: 100%;
                                                    max-width: 320px;
                                                    margin: auto;
                                                }

                                                #camera {
                                                    width: 100%;
                                                    border-radius: 12px;
                                                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                                                }

                                                #countdown {
                                                    position: absolute;
                                                    top: 50%;
                                                    left: 50%;
                                                    font-size: 48px;
                                                    font-weight: bold;
                                                    transform: translate(-50%, -50%);
                                                    color: red;
                                                    display: none;
                                                    background-color: rgba(255, 255, 255, 0.7);
                                                    padding: 10px 20px;
                                                    border-radius: 8px;
                                                }

                                                #capture-btn {
                                                    margin-top: 10px;
                                                    width: 100%;
                                                    padding: 10px;
                                                    background-color: #007bff;
                                                    border: none;
                                                    color: white;
                                                    border-radius: 8px;
                                                    font-size: 16px;
                                                    cursor: pointer;
                                                    transition: background 0.3s ease;
                                                }

                                                #capture-btn:hover {
                                                    background-color: #0056b3;
                                                }

                                                #preview-img {
                                                    margin-top: 10px;
                                                    width: 100%;
                                                    border-radius: 8px;
                                                    display: none;
                                                }
                                            </style>

                                            <div class="mb-3" id="camera-wrapper">
                                                <video id="camera" autoplay playsinline></video>
                                                <div id="countdown">3</div>
                                                <button type="button" id="capture-btn">📷 Ambil Foto</button>
                                                <canvas id="canvas" style="display:none;"></canvas>
                                                <img id="preview-img" alt="Preview">
                                                <input type="hidden" name="bukti_absent" id="bukti_absent_input">
                                            </div>

                                            <script>
                                            const video = document.getElementById('camera');
                                            const canvas = document.getElementById('canvas');
                                            const countdown = document.getElementById('countdown');
                                            const captureBtn = document.getElementById('capture-btn');
                                            const previewImg = document.getElementById('preview-img');
                                            const buktiInput = document.getElementById('bukti_absent_input');

                                            // Start camera
                                            navigator.mediaDevices.getUserMedia({ video: true })
                                                .then(stream => {
                                                    video.srcObject = stream;
                                                })
                                                .catch(err => {
                                                    alert('Tidak dapat mengakses kamera: ' + err.message);
                                                });

                                            captureBtn.addEventListener('click', () => {
                                                let seconds = 3;
                                                countdown.textContent = seconds;
                                                countdown.style.display = 'block';

                                                const timer = setInterval(() => {
                                                    seconds--;
                                                    if (seconds > 0) {
                                                        countdown.textContent = seconds;
                                                    } else {
                                                        clearInterval(timer);
                                                        countdown.style.display = 'none';

                                                        // Capture
                                                        canvas.width = video.videoWidth;
                                                        canvas.height = video.videoHeight;
                                                        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                                                        const imageData = canvas.toDataURL('image/jpeg');
                                                        previewImg.src = imageData;
                                                        previewImg.style.display = 'block';
                                                        buktiInput.value = imageData; // kirim base64 ke input tersembunyi
                                                    }
                                                }, 1000);
                                            });
                                            </script>
                                                    @if ($absentToday)
                                                        
                                                    @else
                                                        <div class="d-flex justify-content-center">
                                                            <div class="form-group ml-4">
                                                                <input type="hidden" class="form-check-input" name="status" value="hadir" id="hadir" required>
                                                            </div>
                                                            
                                                        </div>
                                                    @endif

                                                {{-- </div>
                                            </div> --}}
                                            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                                           <div class="form-group mb-3">
                                                <label for="latitude">Latitude</label>
                                                <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="longitude">Longitude</label>
                                                <input type="text" id="longitude" name="longitude" class="form-control" readonly>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="alamat">Alamat Lengkap</label>
                                                <textarea id="alamat" name="alamat" class="form-control" rows="2" readonly></textarea>
                                            </div>
                                           <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                                            {{-- <button type="submit" class="btn btn-block btn-primary">
                                                <i class="fa fa-save"></i> Save Changes
                                            </button> --}}

                                            <button type="button" class="btn btn-success btn-sm btn-block mt-2" data-toggle="modal"
                                                data-target="#wfh-add" title="Tambah">
                                                <h3>
                                                    <i class="fa fa-sign-in"></i> Save Changes
                                                </h3>
                                            </button>
                                            @include('backoffice.karyawan.absent.modal.wfh-add')
                                        {{-- </form> --}}

                                    @endif
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
                                                @if ($absentToday->status == 'wfh')
                                                    {{ $absentToday->start }} | Status: {{ strtoupper($absentToday->status_absent) }}
                                                @else
                                                    Anda sedang {{ $absentToday->status }}
                                                @endif
                                            @else
                                                Belum Presensi
                                            @endif

                                            {{-- @if ($absentToday)
                                                @if ($absentToday->start == null)
                                                    @if ($absentToday->status != 'hadir')
                                                        Anda sedang {{ $absentToday->status }}
                                                    @else
                                                        Belum Presensi
                                                    @endif
                                                @else
                                                    {{ $absentToday->start }}
                                                @endif
                                            @else
                                                Belum Presensi
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-warning">
                                        <div class="card-body">
                                            <h3>Presensi Pulang</h3>

                                            @if ($absentToday)
                                                @if ($absentToday->status == 'wfh')
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

                                            {{-- @if ($absentToday)
                                                @if ($absentToday->end == null)
                                                    @if ($absentToday->status != 'hadir')
                                                    Anda sedang {{ $absentToday->status }}
                                                @else
                                                    Belum Presensi
                                                @endif
                                                @else
                                                    {{ $absentToday->end }}
                                                @endif
                                            @else
                                                Belum Presensi
                                            @endif --}}
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
                            <div id="map" style="height: 400px"></div>
                           <script>
                                let map = L.map('map', { zoomControl: false, dragging: false }).setView([-6.200000, 106.816666], 13); // Default Jakarta
                                let marker;

                                // Tile Layer
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; OpenStreetMap contributors'
                                }).addTo(map);

                                // Fungsi untuk men-set marker dan input lokasi
                                function setMarker(lat, lng) {
                                    document.getElementById('latitude').value = lat.toFixed(6);
                                    document.getElementById('longitude').value = lng.toFixed(6);

                                    const latlng = L.latLng(lat, lng);

                                    if (marker) {
                                        marker.setLatLng(latlng);
                                    } else {
                                        marker = L.marker(latlng).addTo(map);
                                    }

                                    map.setView(latlng, 16);

                                    // Ambil alamat menggunakan reverse geocoding
                                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            const address = data.display_name || 'Alamat tidak ditemukan';
                                            document.getElementById('alamat').value = address;
                                        })
                                        .catch(error => {
                                            console.error('Error fetching address:', error);
                                            document.getElementById('alamat').value = 'Gagal mengambil alamat';
                                        });
                                }

                                // Ambil lokasi pengguna
                                if (navigator.permissions) {
                                    navigator.permissions.query({ name: 'geolocation' }).then(function (result) {
                                        if (result.state === 'granted' || result.state === 'prompt') {
                                            navigator.geolocation.getCurrentPosition(function (position) {
                                                const lat = position.coords.latitude;
                                                const lng = position.coords.longitude;
                                                setMarker(lat, lng);
                                            }, function (error) {
                                                alert("Gagal mendapatkan lokasi: " + error.message);
                                            });
                                        } else {
                                            alert("Akses lokasi ditolak oleh browser. Silakan izinkan lokasi dari pengaturan browser.");
                                        }
                                    });
                                } else {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function (position) {
                                            const lat = position.coords.latitude;
                                            const lng = position.coords.longitude;
                                            setMarker(lat, lng);
                                        }, function (error) {
                                            alert("Gagal mendapatkan lokasi: " + error.message);
                                        });
                                    } else {
                                        alert("Geolokasi tidak didukung oleh browser ini.");
                                    }
                                }

                                // Nonaktifkan klik di peta
                                map.dragging.disable();
                                map.touchZoom.disable();
                                map.doubleClickZoom.disable();
                                map.scrollWheelZoom.disable();
                                map.boxZoom.disable();
                                map.keyboard.disable();
                                if (map.tap) map.tap.disable();
                            </script>


                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</section>

@endsection