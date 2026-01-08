@extends('layouts.app')
@section('title', 'Pegawai Management')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman Pegawai</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/pegawai">Pegawai</a></li>
                            <li class="breadcrumb-item active">Data Pegawai</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Data Pegawai</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a class="btn btn-primary" href="#" id="tambahPegawai"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.pegawai.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.pegawai.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Logic untuk Preview Gambar
        $('#image').on('change', function() {
            const file = this.files[0];
            if (file) {
                // Validasi tipe file sederhana di client-side
                const fileType = file.type;
                const validImageTypes = ["image/jpeg", "image/png"];

                if ($.inArray(fileType, validImageTypes) < 0) {
                    toastr.error("Harap pilih file gambar (JPG/PNG)");
                    $(this).val(''); // Reset input
                    $('#previewContainer').hide();
                    return false;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result);
                    $('#previewContainer').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#previewContainer').hide();
            }
        });
        // Event listener untuk tombol tambah pegawai
        $('#tambahPegawai').on('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman jika menggunakan tag <a>
            // Memanggil modal menggunakan Bootstrap 5 function
            $('#modalTambah').modal('show');
            // Opsional: Mengubah judul modal secara dinamis
            $('#modalTambah .modal-title').text('TAMBAH PEGAWAI');
            // Reset form setiap kali modal dibuka
            $('#formTambahPegawai')[0].reset();

            $('#previewContainer').hide();
            $('#imgPreview').attr('src', '#');
        });

        $('#formTambahPegawai').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnSimpanPegawai'); // Pastikan ID tombol sesuai
            // GUNAKAN FormData untuk form yang berisi File/Image
            const formData = new FormData(this);

            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm"></span> Menyimpan...');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false, // WAJIB untuk FormData
                contentType: false, // WAJIB untuk FormData
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#modalTambah').modal('hide');
                    toastr.success("Pegawai berhasil disimpan!");
                    $('#pegawaiTable').DataTable().ajax.reload();

                    // Reset Preview
                    $('#previewContainer').hide();
                },
                error: function(xhr) {
                    toastr.error("Terjadi kesalahan: " + xhr.responseText);
                },
                complete: function() {
                    btn.prop('disabled', false).html('Simpan Pegawai');
                }
            });
        });

        // --- LOGIC: PREVIEW GAMBAR BARU DI MODAL EDIT ---
        $('#imagePegawai').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgPreviewPegawai').attr('src', e.target.result);
                    $('#previewContainerEdit').show();
                }
                reader.readAsDataURL(file);
            }
        });

        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT PEGAWAI');

            // Panggil Service untuk ambil data satu pegawai (AJAX GET)
            $.ajax({
                url: `/pegawai/editPegawai/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    $('#formEditPegawai').find('input[name="namaPegawai"]').val(response
                        .data.nama);
                    $('#formEditPegawai').find('input[name="kontakPegawai"]').val(response
                        .data.kontak);
                    $('#formEditPegawai').find('textarea[name="alamatPegawai"]').val(
                        response.data.alamat);

                    // Handling Preview Gambar Lama
                    if (response.data.image) {
                        const path = `/storage/pegawai/image/${response.data.image}`;
                        $('#imgPreviewPegawai').attr('src', path);
                        $('#previewContainerEdit').show(); // Gunakan ID unik container edit
                    }

                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditPegawai').attr('action', `/pegawai/updatePegawai/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data pegawai");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT PEGAWAI ---
        $('#formEditPegawai').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnUpdatePegawai');
            const formData = new FormData(this); // Sudah benar menggunakan FormData
            const url = $(this).attr('action');

            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm"></span> Updating...');

            $.ajax({
                url: url,
                type: 'POST', // Tetap gunakan POST karena kita sudah append _method PUT di atas
                data: formData,

                // --- DUA BARIS INI WAJIB ADA UNTUK UPLOAD FILE ---
                processData: false, // Memberitahu jQuery agar tidak mengubah data menjadi query string
                contentType: false, // Memberitahu browser untuk menggunakan multipart/form-data otomatis

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#modalEdit').modal('hide');

                    toastr.success(response.message || "Data berhasil diperbarui!",
                        "Message", {
                            closeButton: !0,
                            tapToDismiss: !1,
                        });

                    $('#formEditPegawai')[0].reset();
                    $('#previewContainerEdit').hide(); // Reset preview container edit

                    btn.prop('disabled', false).html('Simpan Pegawai');
                    $('#pegawaiTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    let errorMsg = xhr.responseJSON && xhr.responseJSON.message ? xhr
                        .responseJSON.message : xhr.statusText;
                    toastr.error(
                        "Gagal memperbarui data. " + errorMsg,
                        "Error!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                        }
                    );
                    btn.prop('disabled', false).html('Simpan Pegawai');
                }
            });
        });

        // --- LOGIC: HAPUS PEGAWAI DENGAN SWEETALERT2 ---
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pegawai akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Panggil service untuk menghapus data
                    $.ajax({
                        url: `/pegawai/deletePegawai/${id}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data pegawai telah dihapus.',
                                'success'
                            );
                            // Refresh tabel
                            $('#pegawaiTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
