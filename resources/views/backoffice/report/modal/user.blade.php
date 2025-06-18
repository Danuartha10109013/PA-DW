<div class="modal fade" id="detail-{{ $user->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black">Detail Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class=" text-center">
                            <label for="foto">Foto</label>
                            @if ($user->foto)
                                <img src="{{ Storage::disk('local')->url($user->foto) }}" 
                                class="gambarPreviewuser img-fluid d-block" alt=""
                                style="width: 150px; height: 150px; margin-left: auto; margin-right: auto">
                            @else
                                <img src="{{ asset('images/profile-default.jpg') }}" class="gambarPreviewuser rounded img-fluid mb-3 d-block" alt=""
                                style="width: 150px; height: 150px; margin-left: auto; margin-right: auto">
                            @endif
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Nama:</b> 
                                    </p>
                                    <p>
                                        {{ $user->name }}
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Email:</b> 
                                    </p>
                                    <p>
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Peran:</b> 
                                    </p>
                                    <p>
                                        {{ $user->role->name }}
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Jenis Kelamin:</b> 
                                    </p>
                                    @if ($user->gender == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $user->gender }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Agama:</b> 
                                    </p>
                                    @if ($user->religion == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $user->religion }}
                                        </p>
                                    @endif
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Tempat, Tanggal Lahir:</b> 
                                    </p>
                                    @if ($user->place_birth == null  && $user->date_birth == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $user->place_birth }}, {{ date('d F Y', strtotime($user->date_birth)) }}
                                        </p>
                                    @endif
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Alamat:</b> 
                                    </p>
                                    @if ($user->address == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $user->address }}
                                        </p>
                                    @endif
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>No Hp:</b> 
                                    </p>
                                    @if ($user->no_hp == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $user->no_hp }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                        </div>  
                        <div class="card card-outline card-primary bg-light shadow">
                           <div class="card-header text-center bg-primary text-white">
                               <strong>Rekapitulasi Absensi - {{ $user->name }}</strong>
                           </div>
                           <div class="card-body table-responsive">
                            @php
                                $bulan = request('bulan'); // ex: 07
                                $tahun = request('tahun'); // ex: 2025
                                // dd($tahun);
                            @endphp
                               @php
                                    $tepat_waktu_wfo = \App\Models\Absent::where('user_id', $user->id)
                                        ->where('status', 'hadir')
                                        ->where('status_absent', 'tepat waktu')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $telat_wfo = \App\Models\Absent::where('user_id', $user->id)
                                        ->where('status', 'hadir')
                                        ->where('status_absent', 'telat')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $tepat_waktu_wfh = \App\Models\Absent::where('user_id', $user->id)
                                        ->where('status', 'wfh')
                                        ->where('status_absent', 'tepat waktu')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $telat_wfh = \App\Models\Absent::where('user_id', $user->id)
                                        ->where('status', 'wfh')
                                        ->where('status_absent', 'telat')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $cuti_setuju = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'cuti')
                                        ->where('status', 'Disetujui')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $cuti_tolak = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'cuti')
                                        ->where('status', 'Ditolak')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $sakit_setuju = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'sakit')
                                        ->where('status', 'Disetujui')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $sakit_tolak = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'sakit')
                                        ->where('status', 'Ditolak')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $izin_setuju = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'izin')
                                        ->where('status', 'Disetujui')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $izin_tolak = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'izin')
                                        ->where('status', 'Ditolak')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $wfh_setuju = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'wfh')
                                        ->where('status', 'Disetujui')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();

                                    $wfh_tolak = \App\Models\Submission::where('user_id', $user->id)
                                        ->where('type', 'wfh')
                                        ->where('status', 'Ditolak')
                                        ->whereMonth('created_at', $bulan)
                                        ->whereYear('created_at', $tahun)
                                        ->count();
                                @endphp


                               <table class="table table-bordered table-striped">
                                   <thead class="text-center bg-secondary text-white">
                                       <tr>
                                           <th rowspan="2">No</th>
                                           <th colspan="2">Absensi WFO</th>
                                           <th colspan="2">Absensi WFH</th>
                                           <th colspan="2">Cuti</th>
                                           <th colspan="2">Sakit</th>
                                           <th colspan="2">Izin</th>
                                           <th colspan="2">Pengajuan WFH</th>
                                       </tr>
                                       <tr>
                                           <th>Tepat</th>
                                           <th>Telat</th>
                                           <th>Tepat</th>
                                           <th>Telat</th>
                                           <th>Disetujui</th>
                                           <th>Ditolak</th>
                                           <th>Disetujui</th>
                                           <th>Ditolak</th>
                                           <th>Disetujui</th>
                                           <th>Ditolak</th>
                                           <th>Disetujui</th>
                                           <th>Ditolak</th>
                                       </tr>
                                   </thead>
                                   <tbody class="text-center">
                                       <tr>
                                           <td>1</td>
                                           <td>{{ $tepat_waktu_wfo }}</td>
                                           <td>{{ $telat_wfo }}</td>
                                           <td>{{ $tepat_waktu_wfh }}</td>
                                           <td>{{ $telat_wfh }}</td>
                                           <td>{{ $cuti_setuju }}</td>
                                           <td>{{ $cuti_tolak }}</td>
                                           <td>{{ $sakit_setuju }}</td>
                                           <td>{{ $sakit_tolak }}</td>
                                           <td>{{ $izin_setuju }}</td>
                                           <td>{{ $izin_tolak }}</td>
                                           <td>{{ $wfh_setuju }}</td>
                                           <td>{{ $wfh_tolak }}</td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
