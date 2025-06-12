<div class="modal fade" id="detail-{{ $absent->user->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black">Detail Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card" style="background-color: #33ccff; color: black">
                    <div class="card-body">
                        <div class=" text-center">
                            <label for="foto">Foto</label>
                            @if ($absent->user->foto)
                                <img src="{{ Storage::disk('local')->url($absent->user->foto) }}" 
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
                                        {{ $absent->user->name }}
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Email:</b> 
                                    </p>
                                    <p>
                                        {{ $absent->user->email }}
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Peran:</b> 
                                    </p>
                                    <p>
                                        {{ $absent->user->role->name }}
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Jenis Kelamin:</b> 
                                    </p>
                                    @if ($absent->user->gender == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $absent->user->gender }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Agama:</b> 
                                    </p>
                                    @if ($absent->user->religion == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $absent->user->religion }}
                                        </p>
                                    @endif
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Tempat, Tanggal Lahir:</b> 
                                    </p>
                                    @if ($absent->user->place_birth == null  && $absent->user->date_birth == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $absent->user->place_birth }}, {{ date('d F Y', strtotime($absent->user->date_birth)) }}
                                        </p>
                                    @endif
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>Alamat:</b> 
                                    </p>
                                    @if ($absent->user->address == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $absent->user->address }}
                                        </p>
                                    @endif
                                </div>
                                <div class=" d-flex justify-content-between pl-4 pr-4">
                                    <p>
                                        <b>No Hp:</b> 
                                    </p>
                                    @if ($absent->user->no_hp == null)
                                        <p class="badge badge-warning">
                                            <i class="fa fa-exclamation-triangle"></i> Belum melengkapi data
                                        </p>
                                    @else
                                        <p>
                                            {{ $absent->user->no_hp }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>  
                        
                    </div>
                    <div class="mb-4 mx-3">
                        <center><h4 class="text text-bold">Data Presensi</h4></center>
                        @php
                            $tepat_waktu_wfo = \App\Models\Absent::where('user_id',$absent->user->id)->where('status','hadir')->where('status_absent','tepat waktu')->count();
                            $telat_wfo = \App\Models\Absent::where('user_id',$absent->user->id)->where('status','hadir')->where('status_absent','telat')->count();
                            $tepat_waktu_wfh = \App\Models\Absent::where('user_id',$absent->user->id)->where('status','wfh')->where('status_absent','tepat waktu')->count();
                            $telat_wfh = \App\Models\Absent::where('user_id',$absent->user->id)->where('status','wfh')->where('status_absent','telat')->count();
                            $cuti_setuju = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','cuti')->where('status','Disetujui')->count();
                            $cuti_tolak = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','cuti')->where('status','Ditolak')->count();
                            $sakit_setuju = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','sakit')->where('status','Disetujui')->count();
                            $sakit_tolak = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','sakit')->where('status','Ditolak')->count();
                            $izin_setuju = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','izin')->where('status','Disetujui')->count();
                            $izin_tolak = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','izin')->where('status','Ditolak')->count();
                            $wfh_setuju = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','wfh')->where('status','Disetujui')->count();
                            $wfh_tolak = \App\Models\Submission::where('user_id',$absent->user->id)->where('type','wfh')->where('status','Ditolak')->count();
                        @endphp

                        <div class="row text-center mt-3">
                            <!-- WFO -->
                            <div class="col-md-4 mb-3">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">Work From Office</div>
                                    <div class="card-body">
                                        <p class="mb-1">Tepat Waktu: <strong>{{ $tepat_waktu_wfo }}</strong></p>
                                        <p class="mb-0">Telat: <strong>{{ $telat_wfo }}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- WFH -->
                            <div class="col-md-4 mb-3">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">Work From Home</div>
                                    <div class="card-body">
                                        <p class="mb-1">Tepat Waktu: <strong>{{ $tepat_waktu_wfh }}</strong></p>
                                        <p class="mb-0">Telat: <strong>{{ $telat_wfh }}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Cuti -->
                            <div class="col-md-4 mb-3">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning text-dark">Cuti</div>
                                    <div class="card-body">
                                        <p class="mb-1">Disetujui: <strong>{{ $cuti_setuju }}</strong></p>
                                        <p class="mb-0">Ditolak: <strong>{{ $cuti_tolak }}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sakit -->
                            <div class="col-md-4 mb-3">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">Sakit</div>
                                    <div class="card-body">
                                        <p class="mb-1">Disetujui: <strong>{{ $sakit_setuju }}</strong></p>
                                        <p class="mb-0">Ditolak: <strong>{{ $sakit_tolak }}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Izin -->
                            <div class="col-md-4 mb-3">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">Izin</div>
                                    <div class="card-body">
                                        <p class="mb-1">Disetujui: <strong>{{ $izin_setuju }}</strong></p>
                                        <p class="mb-0">Ditolak: <strong>{{ $izin_tolak }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Izin -->
                            <div class="col-md-4 mb-3">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">Pengajuan Work Form Home</div>
                                    <div class="card-body">
                                        <p class="mb-1">Disetujui: <strong>{{ $wfh_setuju }}</strong></p>
                                        <p class="mb-0">Ditolak: <strong>{{ $wfh_tolak }}</strong></p>
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
