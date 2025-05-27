<div class="modal fade" id="accept-{{ $submission->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black">Konfirmasi Pengajuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <p style="color:black;">Apakah anda yakin konfirmasi pengajuan?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
                <a href="/backoffice/izin-sakit/{{ $submission->id }}/confirm" class="btn btn-success">
                    <i class="fas fa-check"></i> Konfirmasi
                </a>
            </div>
        </div>
    </div>
</div>
