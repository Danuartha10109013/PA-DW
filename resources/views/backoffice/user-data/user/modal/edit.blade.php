<div class="modal fade" id="edit-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form role="form" method="POST" action="/backoffice/user/{{ $user->id }}/update-by-admin" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Ubah Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label for="role">Peran <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }} select2">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                <small class="text-danger">{{ $errors->first('role') }}</small>
                                @endif
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="office">Kantor <span class="text-danger">*</span></label>
                                <select name="office" id="office" class="form-control {{ $errors->has('office') ? 'is-invalid' : '' }} select2">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}" {{ $user->office_id == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('office'))
                                <small class="text-danger">{{ $errors->first('office') }}</small>
                                @endif
                            </div> --}}
                            <div class="form-group">
                                <label style="color: black;">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="nama" value="{{ $user->name }}"
                                required oninvalid="this.setCustomValidity('Nama harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('name'))
                                <small class="help-block" style="color: red">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Nik <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control @if($errors->has('nik')) is-invalid @endif" placeholder="Nik" value="{{ $user->nik }}"
                                required oninvalid="this.setCustomValidity('Nik harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('nik'))
                                <small class="help-block" style="color: red">{{ $errors->first('nik') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="position" class="form-control @if($errors->has('position')) is-invalid @endif" placeholder="Jabatan" value="{{ $user->position }}"
                                required oninvalid="this.setCustomValidity('Jabatan harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('position'))
                                <small class="help-block" style="color: red">{{ $errors->first('position') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Tanggal Masuk <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_masuk" class="form-control @if($errors->has('tgl_masuk')) is-invalid @endif" placeholder="Tanggal Masuk" value="{{ $user->tgl_masuk }}"
                                required oninvalid="this.setCustomValidity('Tanggal Masuk harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('tgl_masuk'))
                                <small class="help-block" style="color: red">{{ $errors->first('tgl_masuk') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Tanggal Habis Kontrak <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_habis_kontrak" class="form-control @if($errors->has('tgl_habis_kontrak')) is-invalid @endif" placeholder="Tanggal Habis Kontrak" value="{{ $user->tgl_habis_kontrak }}"
                                required oninvalid="this.setCustomValidity('Tanggal Habis Kontrak harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('tgl_habis_kontrak'))
                                <small class="help-block" style="color: red">{{ $errors->first('tgl_habis_kontrak') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Kembali</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-edit"></span> Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--  --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function previewImg() {
        const image = document.querySelector('#image')
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block'

        const oFReader = new FileReader()
        oFReader.readAsDataURL(image.files[0])

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result
        }
    }
</script>
{{--  --}}