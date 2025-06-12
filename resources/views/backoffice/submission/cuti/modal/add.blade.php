<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="POST" action="/backoffice/cuti/store" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Tambah Cuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label style="color: black;">Pilih Karyawan <span class="text-danger">*</span></label>
                                <select name="user_id"
                                    class="form-control @if($errors->has('user_id')) is-invalid @endif" required
                                    oninvalid="this.setCustomValidity('Karyawan harus diisi')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}
                                        - jumlah cuti diambil
                                        {{ $user->countCutiPerTahun($user->id, now()->format('Y')) }} hari
                                        - jumlah sisa cuti
                                        {{ ( 12 - $user->countCutiPerTahun($user->id, now()->format('Y')) ) }} hari
                                    </option>
                                </select>
                                @if($errors->has('start_date'))
                                <small class="help-block" style="color: red">{{ $errors->first('start_date') }}</small>
                                @endif
                            </div>
                            <!-- <div class="form-group">
                                <label style="color: black;">Mulai Cuti <span class="text-danger">*</span></label>
                                <input type="date"  name="start_date" class="form-control @if($errors->has('start_date')) is-invalid @endif" placeholder="Mulai Cuti" value="{{ old('start_date') }}"
                                required oninvalid="this.setCustomValidity('Mulai cuti harus diisi')" oninput="this.setCustomValidity('')" min="{{ date('Y-m-d') }}">
                                @if($errors->has('start_date'))
                                <small class="help-block" style="color: red">{{ $errors->first('start_date') }}</small>
                                @endif
                            </div> -->
                            <div class="form-group">
                                <label style="color: black;">Mulai Cuti <span class="text-danger">*</span></label>
                                <input type="date" name="start_date"
                                    class="form-control @if($errors->has('start_date')) is-invalid @endif"
                                    placeholder="Mulai Cuti" value="{{ old('start_date') }}" required
                                    oninvalid="this.setCustomValidity('Mulai cuti harus diisi')"
                                    oninput="this.setCustomValidity('')" id="start_date_input">
                                @if($errors->has('start_date'))
                                <small class="help-block" style="color: red">{{ $errors->first('start_date') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Selesai Cuti <span class="text-danger">*</span></label>
                                <input type="date" name="end_date"
                                    class="form-control @if($errors->has('end_date')) is-invalid @endif"
                                    placeholder="Selesai Cuti" value="{{ old('end_date') }}" required
                                    oninvalid="this.setCustomValidity('Selesai cuti harus diisi')"
                                    oninput="this.setCustomValidity('')" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                @if($errors->has('end_date'))
                                <small class="help-block" style="color: red">{{ $errors->first('end_date') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Alasan Cuti <span class="text-danger">*</span></label>
                                <textarea name="description"
                                    class="form-control @if($errors->has('description')) is-invalid @endif"
                                    placeholder="Alasan Cuti" required
                                    oninvalid="this.setCustomValidity('Alasan cuti harus diisi')"
                                    oninput="this.setCustomValidity('')"></textarea>
                                @if($errors->has('description'))
                                <small class="help-block" style="color: red">{{ $errors->first('description') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span
                            class="fa fa-arrow-left"></span> Kembali</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Mengambil tanggal hari ini
    const today = new Date();
    // Menambahkan 1 hari
    today.setDate(today.getDate() + 1);

    // Format tanggal dalam format YYYY-MM-DD
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const yyyy = today.getFullYear();
    const nextDay = yyyy + '-' + mm + '-' + dd;

    // Menetapkan tanggal minimum pada input
    document.getElementById('start_date_input').setAttribute('min', nextDay);

</script>
