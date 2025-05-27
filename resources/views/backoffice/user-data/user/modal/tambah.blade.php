{{-- <script>
    $(document).ready(function(){
        $('#tambah').modal('show');
    });
</script> --}}

<div class="modal fade show" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form role="form" method="POST" action="/backoffice/user/create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Tambah Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card card-outline card-primary">
                        <div class="card-body">

                            <div class="form-group">
                                <label style="color: black;">Nama <span class="text-danger">*</span></label>
                                <input type="text"  name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Nama" value="{{ old('name') }}"
                                required oninvalid="this.setCustomValidity('Nama harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('name'))
                                <small class="help-block" style="color: red">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Nik <span class="text-danger">*</span></label>
                                <input type="text"  name="nik" class="form-control @if($errors->has('nik')) is-invalid @endif" placeholder="Nik" value="{{ old('nik') }}"
                                required oninvalid="this.setCustomValidity('Nik harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('nik'))
                                <small class="help-block" style="color: red">{{ $errors->first('nik') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Jabatan <span class="text-danger">*</span></label>
                                <input type="text"  name="position" class="form-control @if($errors->has('position')) is-invalid @endif" placeholder="Jabatan" value="{{ old('position') }}"
                                required oninvalid="this.setCustomValidity('Jabatan harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('position'))
                                <small class="help-block" style="color: red">{{ $errors->first('position') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">No hp <span class="text-danger">*</span></label>
                                <input type="text"  name="no_hp" class="form-control @if($errors->has('no_hp')) is-invalid @endif" placeholder="No hp" value="{{ old('no_hp') }}"
                                required oninvalid="this.setCustomValidity('No hp harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('no_hp'))
                                <small class="help-block" style="color: red">{{ $errors->first('no_hp') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Tanggal Masuk <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_masuk" class="form-control @if($errors->has('tgl_masuk')) is-invalid @endif" placeholder="Tanggal Masuk" value=""
                                required oninvalid="this.setCustomValidity('Tanggal Masuk harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('tgl_masuk'))
                                <small class="help-block" style="color: red">{{ $errors->first('tgl_masuk') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Tanggal Habis Kontrak <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_habis_kontrak" class="form-control @if($errors->has('tgl_habis_kontrak')) is-invalid @endif" placeholder="Tanggal Habis Kontrak" value=""
                                required oninvalid="this.setCustomValidity('Tanggal Habis Kontrak harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('tgl_habis_kontrak'))
                                <small class="help-block" style="color: red">{{ $errors->first('tgl_habis_kontrak') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="color: black;">Email <span class="text-danger">*</span></label>
                                <input type="email"  name="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Email" value="{{ old('email') }}"
                                required oninvalid="this.setCustomValidity('Email harus diisi')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('email'))
                                <small class="help-block" style="color: red">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                            {{-- <div class="form-group">
                                <label for="role">Peran <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }} select2" required
                                oninvalid="this.setCustomValidity('Peran harus diisi')" oninput="this.setCustomValidity('')">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ @old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                <small class="text-danger">{{ $errors->first('role') }}</small>
                                @endif
                            </div>   --}}
                            <div class="form-group">
                                <label style="color: black;">Password <span class="text-danger">*</span></label>
                                <input type="password"  name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="Password" value="{{ old('password') }}"
                                required oninvalid="this.setCustomValidity('Password harus diisi minimal 8 karakter')"
                                oninput="this.setCustomValidity('')">
                                @if($errors->has('password'))
                                <small class="help-block" style="color: red">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="fa fa-arrow-left"></span> Kembali</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
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