@extends('backoffice.layout.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Presensi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Presensi</li>
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
                                    <b>Absensi</b>
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

                    {{-- <h3 class="card-title">Absensi</h3>

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
                                        Hadir: <b>
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
                                        </b>
                                    </h5>
                                </div>
                            </div>
                        </div>

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
                                    <th>Kantor</th>
                                    <th>Shift</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    {{-- <th>Bukti Presensi</th> --}}
                                    <th>Status</th>
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
                                    <td>
                                        @if ($absent->office_id)
                                            {{ $absent->office->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($absent->shift_id)
                                            {{ $absent->shift->name }} | {{ $absent->shift->start }} - {{ $absent->shift->end }}
                                        @endif
                                    </td>
                                    <td>{{ $absent->start }}</td>
                                    <td>{{ $absent->end }}</td>
                                    {{-- <td>
                                        @if($item->bukti_absent)
                                            <a href="{{ asset('storage/' . $item->bukti_absent) }}" target="_blank" class="btn btn-sm btn-primary">
                                                Lihat Bukti Presensi
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada bukti</span>
                                        @endif
                                    </td> --}}

                                    <td>{{ $absent->status }}</td>
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