@extends('layouts.app')
@section('title', 'Driver')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman Driver</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/driver">Driver</a></li>
                            <li class="breadcrumb-item active">Data Driver</li>
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
                                    <h3 class="page-title">Data Driver</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a class="btn btn-primary" href="#" id="tambahDriver"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.driver.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.driver.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol tambah driver
        $('#tambahDriver').on('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman jika menggunakan tag <a>
            // Memanggil modal menggunakan Bootstrap 5 function
            $('#modalTambah').modal('show');
            // Opsional: Mengubah judul modal secara dinamis
            $('#modalTambah .modal-title').text('TAMBAH DRIVER');
            // Reset form setiap kali modal dibuka
            $('#formTambahDriver')[0].reset();
        });

        $('#formTambahDriver').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnSimpanDriver'); // Pastikan ID tombol sesuai
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
                    toastr.success("Driver berhasil disimpan!");
                    $('#driverTable').DataTable().ajax.reload();

                    // Reset Preview
                    $('#previewContainer').hide();
                },
                error: function(xhr) {
                    toastr.error("Terjadi kesalahan: " + xhr.responseText);
                },
                complete: function() {
                    btn.prop('disabled', false).html('Simpan Driver');
                }
            });
        });

        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT DRIVER');

            // Panggil Service untuk ambil data satu driver (AJAX GET)
            $.ajax({
                url: `/driver/editDriver/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    $('#formEditDriver').find('input[name="editkode"]').val(response
                        .data.kode);
                    $('#formEditDriver').find('input[name="editnama"]').val(response
                        .data.nama);
                    $('#formEditDriver').find('input[name="editkontak"]').val(response
                        .data.kontak);
                    $('#formEditDriver').find('textarea[name="editalamat"]').val(response
                        .data.alamat);

                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditDriver').attr('action', `/driver/updateDriver/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data driver");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT DRIVER ---
        $('#formEditDriver').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnUpdateDriver');
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

                    $('#formEditDriver')[0].reset();

                    btn.prop('disabled', false).html('Simpan Driver');
                    $('#driverTable').DataTable().ajax.reload();
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
                    btn.prop('disabled', false).html('Simpan Driver');
                }
            });
        });

        // --- LOGIC: HAPUS DRIVER DENGAN SWEETALERT2 ---
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data driver akan dihapus secara permanen!",
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
                        url: `/driver/deleteDriver/${id}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data driver telah dihapus.',
                                'success'
                            );
                            // Refresh tabel
                            $('#driverTable').DataTable().ajax.reload();
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
