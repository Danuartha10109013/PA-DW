<div class="modal fade" id="home-early-{{ $absentToday->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="/backoffice/absen/home-early" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: black">Anda belum waktunya pulang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Jika anda ada keperluan untuk presensi pulang lebih cepat, silahkan sertakan alasan anda</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="home_early">Alasan pulang cepat <span class="text-danger">*</span></label>
                                <textarea name="home_early" id="home_early" class="form-control" rows="4" required
                                oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Alasan pulang cepat harus diisi')"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sign-out-alt"></i> Presensi pulang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
