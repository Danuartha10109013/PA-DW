@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Beranda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Beranda</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header">
                    <div class="row flex justify-content-between mt-2">
                        <form action="" class="form-inline">
                            <div class="pr-4" style="border-right: 3px solid #0d6efd">
                                <h3 class="card-title">
                                    <b>Beranda</b>
                                </h3>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @php
                        use Carbon\Carbon;
                        $now = Carbon::now();
                        $jamSekarang = $now->format('H:i');
                        $tanggal = $now->translatedFormat('l, d F Y');

                        $jamMasuk = '09:00';
                        $jamPulang = '18:00';
                        $batasPresensi = '09:10';

                        $statusKerja = '';
                        $warnaStatus = 'info';

                        if ($jamSekarang < $jamMasuk) {
                            $statusKerja = 'Belum waktunya masuk kerja';
                            $warnaStatus = 'secondary';
                        } elseif ($jamSekarang >= $jamMasuk && $jamSekarang < $jamPulang) {
                            $statusKerja = 'Sedang jam kerja';
                            $warnaStatus = 'primary';
                        } else {
                            $statusKerja = 'Sudah waktunya pulang';
                            $warnaStatus = 'success';
                        }

                        $terlambat = $jamSekarang > $batasPresensi && $jamSekarang < $jamPulang;
                    @endphp

                    <div class="mb-4">
                        <h5>📅 Tanggal: {{ $tanggal }}</h5>
                        <h5>🕒 Jam Sekarang: {{ $jamSekarang }}</h5>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="p-3 bg-light rounded shadow-sm">
                                    <h6>🕘 Jam Masuk: <span class="badge bg-primary">{{ $jamMasuk }}</span></h6>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="p-3 bg-light rounded shadow-sm">
                                    <h6>🕕 Jam Pulang: <span class="badge bg-success">{{ $jamPulang }}</span></h6>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="p-3 bg-light rounded shadow-sm">
                                    <h6>⏱️ Batas Presensi: <span class="badge bg-warning text-dark">{{ $batasPresensi }}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($terlambat)
                        <div class="alert alert-warning mt-3" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> Anda telah <strong>terlambat</strong> melakukan presensi. Presensi maksimal pukul <strong>{{ $batasPresensi }}</strong>.
                        </div>
                    @endif

                    <div class="alert alert-{{ $warnaStatus }} mt-3" role="alert">
                        <i class="fas fa-info-circle"></i> {{ $statusKerja }}
                    </div>

                    <div class="row mt-4">
    <div class="col-md-6 mb-3">
        <a href="/backoffice/absen" class="text-decoration-none">
            <div class="card shadow-lg border-start border-4 border-primary h-100 hover-shadow transition-ease">
                <div class="card-body text-center">
                    <i class="fas fa-building fa-3x text-primary mb-3"></i>
                    <h5 class="card-title text-dark">Presensi WFO</h5>
                    <p class="card-text text-muted">Klik di sini untuk melakukan Presensi di kantor</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 mb-3">
        <a href="/backoffice/wfh" class="text-decoration-none">
            <div class="card shadow-lg border-start border-4 border-success h-100 hover-shadow transition-ease">
                <div class="card-body text-center">
                    <i class="fas fa-laptop-house fa-3x text-success mb-3"></i>
                    <h5 class="card-title text-dark">Presensi WFH</h5>
                    <p class="card-text text-muted">Klik di sini untuk melakukan Presensi dari rumah</p>
                </div>
            </div>
        </a>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15) !important;
    }
    .transition-ease {
        transition: all 0.3s ease-in-out;
    }
</style>


                </div>
            </div>

        </div>
    </div>
</section>

@endsection
