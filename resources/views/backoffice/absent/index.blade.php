@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Presensi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Data Presensi</li>
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

                    <div class="row flex justify-content-between mt-2">
                        <form action="" class="form-inline">
                            <div class="pr-4" style="border-right: 3px solid #0d6efd">
                                <h3 class="card-title">
                                    <b>Data Presensi</b>
                                </h3>
                            </div>

                            <div class="pl-4">

                            </div>
                            <div class="input-group input-group-sm">
                                <label for="">Cari: </label>
                                <select name="bulan" class="form-control ml-2" required
                                    oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Bulan harus dipilih')">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="01" @if ($bulan == '01') selected @endif>Januari</option>
                                    <option value="02" @if ($bulan == '02') selected @endif>Februari</option>
                                    <option value="03" @if ($bulan == '03') selected @endif>Maret</option>
                                    <option value="04" @if ($bulan == '04') selected @endif>April</option>
                                    <option value="05" @if ($bulan == '05') selected @endif>Mei</option>
                                    <option value="06" @if ($bulan == '06') selected @endif>Juni</option>
                                    <option value="07" @if ($bulan == '07') selected @endif>Juli</option>
                                    <option value="08" @if ($bulan == '08') selected @endif>Agustus</option>
                                    <option value="09" @if ($bulan == '09') selected @endif>September</option>
                                    <option value="10" @if ($bulan == '10') selected @endif>Oktober</option>
                                    <option value="11" @if ($bulan == '11') selected @endif>November</option>
                                    <option value="12" @if ($bulan == '12') selected @endif>Desember</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm">
                                <select name="tahun" class="form-control ml-2" required
                                    oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Tahun harus dipilih')">
                                    <option value="">-- Pilih Tahun --</option>
                                    @for ($i = 2024; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}" @if ($tahun == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="input-group ml-2">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            @if ($bulan)
                                <div class="input-group ml-2">
                                    <a href="/backoffice/absensi" class="btn btn-primary btn-sm">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            @endif

                            @if ($bulan && $tahun)
                                <a href="/backoffice/absensi/pdf/{{ $bulan }}/{{ $tahun }}" class="btn btn-danger btn-sm ml-2" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            @else
                                <a href="/backoffice/absensi/pdf" class="btn btn-danger btn-sm ml-2" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            @endif

                        </form>
                        
                    </div>

                    {{-- <h3 class="card-title">Presensi</h3>

                    <div class="card-tools">
                        
                    </div> --}}

                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" absent="alert">
                        <strong>Berhasil </strong>{{ session('success') }}
          <button type="button" class="close"  data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if ($bulan)

                        <div class="callout callout-info">
                            <div class="d-flex justify-content-between">
                                <div class="search">
                                    <div class="text-center">
                                        <span class="fa fa-search"></span> Hasil Pencarian dari: <b>
                                            @if ($bulan)
                                                @if ($bulan == '01')
                                                    Januari
                                                @elseif ($bulan == '02')
                                                    Februari
                                                @elseif ($bulan == '03')
                                                    Maret
                                                @elseif ($bulan == '04')
                                                    April
                                                @elseif ($bulan == '05')
                                                    Mei
                                                @elseif ($bulan == '06')
                                                    Juni
                                                @elseif ($bulan == '07')
                                                    Juli
                                                @elseif ($bulan == '08')
                                                    Agustus
                                                @elseif ($bulan == '09')
                                                    September
                                                @elseif ($bulan == '10')
                                                    Oktober
                                                @elseif ($bulan == '11')
                                                    November
                                                @elseif ($bulan == '12')
                                                    Desember
                                                @endif
                                            @endif
                                            @if ($tahun)
                                                {{ $tahun }}
                                            @endif
                                        </b>
                                    </div>
                                </div>
                                <div class="">
                                    <h5>
                                        Hadir WFO: <b>
                                            {{ $hadir }} 
                                            @if (auth()->user()->role_id == 1)
                                             Orang   
                                            @endif
                                        </b> |
                                        Izin: <b>{{ $izin }} 
                                            @if (auth()->user()->role_id == 1)
                                             Orang   
                                            @endif
                                        </b> |
                                        Sakit: <b>{{ $sakit }} 
                                            @if (auth()->user()->role_id == 1)
                                             Orang   
                                            @endif
                                        </b> |
                                        Cuti: <b>{{ $cuti }} 
                                            @if (auth()->user()->role_id == 1)
                                             Orang   
                                            @endif
                                        </b> |
                                        Hadir WFH: <b>{{ $wfh }}</b>
                                            @if (auth()->user()->role_id == 1)
                                                Orang
                                            @endif
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <hr>

                    @endif

                    @if (auth()->user()->role_id == 2)
                        @if ($bulan && $tahun)
                            <div class="text-center">
                                <h3>-- Rekap Presensi {{ $user->name }} Bulan 
                                    @if ($bulan == '01')
                                        Januari
                                    @elseif ($bulan == '02')
                                        Februari
                                    @elseif ($bulan == '03')
                                        Maret
                                    @elseif ($bulan == '04')
                                        April
                                    @elseif ($bulan == '05')
                                        Mei
                                    @elseif ($bulan == '06')
                                        Juni
                                    @elseif ($bulan == '07')
                                        Juli
                                    @elseif ($bulan == '08')
                                        Agustus
                                    @elseif ($bulan == '09')
                                        September
                                    @elseif ($bulan == '10')
                                        Oktober
                                    @elseif ($bulan == '11')
                                        November
                                    @elseif ($bulan == '12')
                                        Desember
                                    @endif
                                    {{ date('Y', strtotime($startDate)) }} --</h3>
                            </div>
                            <table class="table table-bordered table-hover table-responsive text-center mb-2">
                                <thead>
                                    <tr>
                                        @for ($i = $startDate; $i <= $endDate; $i++)
                                            <th>{{ date('d', strtotime($i)) }}</th>
                                        @endfor
                                        <th>hadir wfo</th>
                                        <th>sakit</th>
                                        <th>izin</th>
                                        <th>cuti</th>
                                        <th>hadir wfh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = $startDate; $i <= $endDate; $i++)
                                        <td>
                                            @foreach ($user->absents as $absent)
                                                @if (date('Y-m-d', strtotime($absent->date)) == $i)
                                                    @if ($absent->status == 'hadir')
                                                        H
                                                    @elseif ($absent->status == 'izin')
                                                        I
                                                    @elseif ($absent->status == 'sakit')
                                                        S
                                                    @elseif ($absent->status == 'cuti')
                                                        C
                                                    @elseif ($absent->status == 'wfh')
                                                        W
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor

                                    <td>
                                        {{ $user->absents->where('status', 'hadir')->whereBetween('date', [$startDate, $endDate])->count() }}
                                    </td>
                                    <td>
                                        {{ $user->absents->where('status', 'sakit')->whereBetween('date', [$startDate, $endDate])->count() }}
                                    </td>
                                    <td>
                                        {{ $user->absents->where('status', 'izin')->whereBetween('date', [$startDate, $endDate])->count() }}
                                    </td>
                                    <td>
                                        {{ $user->absents->where('status', 'cuti')->whereBetween('date', [$startDate, $endDate])->count() }}
                                    </td>
                                    <td>
                                        {{ $user->absents->where('status', 'wfh')->whereBetween('date', [$startDate, $endDate])->count() }}
                                    </td>
                                </tbody>
                            </table>
                            <div class="mt-2">
                                <div class="text-center">
                                    <h5>Keterangan: H = Hadir WFO, S = Sakit, I = Izin, C = Cuti, W = Hadir WFH</h5>
                                </div>
                            </div>
                        @endif
                        <hr>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    @if (auth()->user()->role_id == 1)
                                        <th>Karyawan</th>
                                    @endif
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Status</th>
                                    <th>Metode Presensi</th>
                                    <th>Bukti Presensi</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
    
                                @foreach($absents as $key => $absent)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    @if ($absent->user_id == null)
                                        <td>
                                            <h5>
                                                <span class="badge badge-danger"> <i class="fa fa-times"></i> Karyawan Resign</span>
                                            </h5>
                                        </td>
                                    @else
                                        @if (auth()->user()->role_id == 1)
                                            <td>
                                                <button class="badge badge-light" data-toggle="modal" data-target="#detail-{{ $absent->user->id }}" title="Detail User">
                                                    <i class="fa fa-eye"></i> {{ $absent->user->name }}
                                                </button>
                                            </td>
                                        @endif
                                    @endif
                                    <td>
                                        {{  \Carbon\Carbon::parse($absent->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td>{{ $absent->start }}</td>
                                    <td>{{ $absent->end }}</td>
                                    <td>
                                        @if ($absent->status == 'wfh')
                                            hadir
                                        @else
                                            {{ $absent->status }}
                                        @endif
                                        @if ($absent->status_absent)
                                            | {{ $absent->status_absent }}
                                        @endif
                                        </td>
                                        <td>
                                            {{
                                                $absent->type == 'wfo' ? 'Work Form Office' :
                                                ($absent->type == 'wfh' ? 'Work From Home' :
                                                ($absent->type == null ?
                                                ($absent->status == 'cuti' ? 'Cuti' :
                                                ($absent->status == 'izin' ? 'Izin' :
                                                ($absent->status == 'sakit' ? 'Sakit' : 'Lainnya')))
                                                : $absent->type))
                                            }}
                                        </td>

                                        <td>
                                            @if($absent->bukti_absent)
                                                <button class="btn btn-sm btn-primary open-modal-btn" data-id="{{ $absent->id }}">
                                                    Lihat Bukti Presensi
                                                </button>
                                                <div id="customModal{{ $absent->id }}" class="custom-modal">
                                                    <div class="custom-modal-content">
                                                        <span class="custom-close" data-id="{{ $absent->id }}">&times;</span>
                                                        <h5>Detail Bukti Presensi</h5>

                                                        <!-- Alamat -->
                                                        <p><strong>Alamat:</strong> {{ $absent->alamat }}</p>

                                                        <!-- Bukti Absensi -->
                                                        @php
                                                            $ext = pathinfo($absent->bukti_absent, PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                            <img src="{{ asset('storage/' . $absent->bukti_absent) }}" alt="Bukti Absensi" style="max-width: 100%; border-radius: 6px;" />
                                                        @elseif(strtolower($ext) === 'pdf')
                                                            <iframe src="{{ asset('storage/' . $absent->bukti_absent) }}" width="100%" height="400"></iframe>
                                                        @else
                                                            <a href="{{ asset('storage/' . $absent->bukti_absent) }}" target="_blank">Lihat File</a>
                                                        @endif

                                                        <!-- Map -->
                                                        <div id="map{{ $absent->id }}" style="height: 300px; margin-top: 1rem; border-radius: 8px;"></div>
                                                    </div>
                                                </div>
                                                <style>
                                                    .custom-modal {
                                                    display: none;
                                                    position: fixed;
                                                    z-index: 1050;
                                                    left: 0;
                                                    top: 0;
                                                    width: 100%;
                                                    height: 100%;
                                                    overflow: auto;
                                                    background-color: rgba(0,0,0,0.5);
                                                }

                                                .custom-modal-content {
                                                    background-color: #fff;
                                                    margin: 5% auto;
                                                    padding: 20px;
                                                    border-radius: 8px;
                                                    width: 80%;
                                                    max-width: 900px;
                                                    position: relative;
                                                }

                                                .custom-close {
                                                    position: absolute;
                                                    top: 15px;
                                                    right: 20px;
                                                    font-size: 24px;
                                                    cursor: pointer;
                                                }

                                                </style>
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function () {
                                                        document.querySelectorAll(".open-modal-btn").forEach(function (btn) {
                                                            btn.addEventListener("click", function () {
                                                                const id = this.getAttribute("data-id");
                                                                const modal = document.getElementById("customModal" + id);
                                                                if (modal) {
                                                                    modal.style.display = "block";

                                                                    // Render map setelah modal muncul
                                                                    setTimeout(() => {
                                                                        const map = L.map('map' + id).setView([{{ $absent->latitude }}, {{ $absent->longitude }}], 16);
                                                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                                            attribution: '&copy; OpenStreetMap contributors'
                                                                        }).addTo(map);
                                                                        L.marker([{{ $absent->latitude }}, {{ $absent->longitude }}])
                                                                            .addTo(map)
                                                                            .bindPopup("Lokasi Presensi")
                                                                            .openPopup();
                                                                    }, 100);
                                                                }
                                                            });
                                                        });

                                                        // Tombol close
                                                        document.querySelectorAll(".custom-close").forEach(function (btn) {
                                                            btn.addEventListener("click", function () {
                                                                const id = this.getAttribute("data-id");
                                                                const modal = document.getElementById("customModal" + id);
                                                                if (modal) {
                                                                    modal.style.display = "none";
                                                                }
                                                            });
                                                        });

                                                        // Tutup modal saat klik di luar isi modal
                                                        window.addEventListener("click", function (event) {
                                                            document.querySelectorAll(".custom-modal").forEach(function (modal) {
                                                                if (event.target === modal) {
                                                                    modal.style.display = "none";
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                                                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                                            @else
                                                <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                        </td>

                                    {{-- <td>
                                        <a href="/backoffice/absent/{{ $absent->id }}/detail" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    {{-- modal --}}
                    @foreach ($absents as $absent)
                        @if ($absent->user_id != null)
                            @include('backoffice.absent.modal.delete')
                            @include('backoffice.absent.modal.user')
                            @include('backoffice.absent.modal.description-user')
                        @endif
                    @endforeach

                </div>

            </div>

        </div>
    </div>

</section>

@endsection