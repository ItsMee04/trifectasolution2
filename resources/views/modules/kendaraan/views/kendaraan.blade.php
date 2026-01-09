@extends('layouts.app')
@section('title', 'Kendaraan')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman Kendaraan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/kendaraan">Kendaraan</a></li>
                            <li class="breadcrumb-item active">Data Kendaraan</li>
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
                                    <h3 class="page-title">Data Kendaraan</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a class="btn btn-primary" href="#" id="tambahKendaraan"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.kendaraan.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.kendaraan.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol tambah kendaraan
        $('#tambahKendaraan').on('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman jika menggunakan tag <a>
            // Memanggil modal menggunakan Bootstrap 5 function
            $('#modalTambah').modal('show');
            // Opsional: Mengubah judul modal secara dinamis
            $('#modalTambah .modal-title').text('TAMBAH KENDARAAN');
            // Reset form setiap kali modal dibuka
            $('#formTambahKendaraan')[0].reset();
        });

        $('#formTambahKendaraan').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnSimpanKendaraan'); // Pastikan ID tombol sesuai
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
                    toastr.success("Kendaraan berhasil disimpan!");
                    $('#kendaraanTable').DataTable().ajax.reload();

                    // Reset Preview
                    $('#previewContainer').hide();
                },
                error: function(xhr) {
                    toastr.error("Terjadi kesalahan: " + xhr.responseText);
                },
                complete: function() {
                    btn.prop('disabled', false).html('Simpan Kendaraan');
                }
            });
        });

        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT KENDARAAN');

            // Panggil Service untuk ambil data satu kendaraan (AJAX GET)
            $.ajax({
                url: `/kendaraan/editKendaraan/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    $('#formEditKendaraan').find('input[name="editkode"]').val(response
                        .data.kode);
                    $('#formEditKendaraan').find('input[name="editnama"]').val(response
                        .data.kendaraan);
                    $('#formEditKendaraan').find('input[name="editjenis"]').val(response
                        .data.jenis);
                    $('#formEditKendaraan').find('input[name="editnomor"]').val(response
                        .data.nomor);

                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditKendaraan').attr('action', `/kendaraan/updateKendaraan/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data kendaraan");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT kendaraan ---
        $('#formEditKendaraan').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnUpdateKendaraan');
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

                    $('#formEditKendaraan')[0].reset();

                    btn.prop('disabled', false).html('Simpan Kendaraan');
                    $('#kendaraanTable').DataTable().ajax.reload();
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
                    btn.prop('disabled', false).html('Simpan Kendaraan');
                }
            });
        });

        // --- LOGIC: HAPUS KENDARAAN DENGAN SWEETALERT2 ---
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kendaraan akan dihapus secara permanen!",
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
                        url: `/kendaraan/deleteKendaraan/${id}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data Kendaraan telah dihapus.',
                                'success'
                            );
                            // Refresh tabel
                            $('#kendaraanTable').DataTable().ajax.reload();
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
