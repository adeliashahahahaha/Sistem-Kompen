@empty($aManageMahasiswaKompen)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/aManageMahasiswaKompen') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/aManageMahasiswaKompen/' . $aManageMahasiswaKompen->id_alpha . '/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kompen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input value="{{ $aManageMahasiswaKompen->mahasiswa->nama }}" type="text" name="id_admin" id="id_admin" class="form-control" required>
                    <small id="error-id_admin" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input value="{{ $aManageMahasiswaKompen->mahasiswa->nim }}" type="text" name="id_admin" id="id_admin" class="form-control" required>
                    <small id="error-id_admin" class="error-text form-text text-danger"></small>
                </div> -->
                <div class="form-group">
                    <label>Jumlah Alpha</label>
                    <input value="{{ $aManageMahasiswaKompen->jumlah_alpha }}" type="text" name="jumlah_alpha" id="jumlah_alpha" class="form-control" required>
                    <small id="error-jumlah_alpha" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jumlah Alpha Terbayar</label>
                    <input value="{{ $aManageMahasiswaKompen->kompen_dibayar }}" type="text" name="kompen_dibayar" id="kompen_dibayar" class="form-control" required>
                    <small id="error-kompen_dibayar" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-edit").validate({
            rules: {
                jumlah_alpha: {
                    required: true,
                },
                kompen_dibayar: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataLevel.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endempty