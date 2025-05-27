<div class="modal fade" id="wfh-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black">Presensi WFH</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        @if ($absentToday)
                            @if ($absentToday->start && $absentToday->end)
                                <p>Anda sudah presensi masuk dan pulang</p>
                            @else
                                <p>Apakah anda yakin akan presensi pulang ?</p>
                            @endif
                        @else
                            {{-- <p>Apakah anda yakin akan presensi masuk ?</p> --}}
                            <p>Apakah pilihan anda sudah benar ?</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>

                @if ($absentToday)
                    @if ($absentToday->start && $absentToday->end)
                        
                    @else
                        <button class="btn btn-success">
                            <i class="fas fa-sign-out-alt"></i> Presensi pulang
                        </button>
                    @endif
                @else
                    <button class="btn btn-success">
                        <i class="fas fa-sign-in-alt"></i> Save Changes
                    </button>
                @endif

                {{-- <a href="/backoffice/wfh/wfh-store" class="btn btn-success">
                    @if ($absentToday)
                        <i class="fas fa-sign-out-alt"></i> Presensi pulang
                    @else
                        <i class="fas fa-sign-in-alt"></i> Presensi masuk
                    @endif
                </a> --}}
            </div>
        </div>
    </div>
</div>
