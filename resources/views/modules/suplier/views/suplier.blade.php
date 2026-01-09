@extends('layouts.app')
@section('title', 'Suplier')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman Suplier</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/suplier">Suplier</a></li>
                            <li class="breadcrumb-item active">Data Suplier</li>
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
                                    <h3 class="page-title">Data Suplier</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a class="btn btn-primary" href="#" id="tambahSuplier"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.suplier.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.suplier.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol tambah suplier
        $('#tambahSuplier').on('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman jika menggunakan tag <a>
            // Memanggil modal menggunakan Bootstrap 5 function
            $('#modalTambah').modal('show');
            // Opsional: Mengubah judul modal secara dinamis
            $('#modalTambah .modal-title').text('TAMBAH SUPLIER');
            // Reset form setiap kali modal dibuka
            $('#formTambahSuplier')[0].reset();
        });

        $('#formTambahSuplier').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnSimpanSuplier'); // Pastikan ID tombol sesuai
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
                    toastr.success("Suplier berhasil disimpan!");
                    $('#suplierTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    toastr.error("Terjadi kesalahan: " + xhr.responseText);
                },
                complete: function() {
                    btn.prop('disabled', false).html('Simpan Suplier');
                }
            });
        });

        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT SUPLIER');

            // Panggil Service untuk ambil data satu suplier (AJAX GET)
            $.ajax({
                url: `/suplier/editSuplier/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    $('#formEditSuplier').find('input[name="editkode"]').val(response
                        .data.kode);
                    $('#formEditSuplier').find('input[name="editnama"]').val(response
                        .data.nama);
                    $('#formEditSuplier').find('input[name="editkontak"]').val(response
                        .data.kontak);
                    $('#formEditSuplier').find('textarea[name="editalamat"]').val(response
                        .data.alamat);

                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditSuplier').attr('action', `/suplier/updateSuplier/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data suplier");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT SUPLIER ---
        $('#formEditSuplier').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnUpdateSuplier');
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

                    $('#formEditSuplier')[0].reset();

                    btn.prop('disabled', false).html('Simpan Suplier');
                    $('#suplierTable').DataTable().ajax.reload();
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
                    btn.prop('disabled', false).html('Simpan Suplier');
                }
            });
        });

        // --- LOGIC: HAPUS SUPLIER DENGAN SWEETALERT2 ---
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data suplier akan dihapus secara permanen!",
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
                        url: `/suplier/deleteSuplier/${id}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data suplier telah dihapus.',
                                'success'
                            );
                            // Refresh tabel
                            $('#suplierTable').DataTable().ajax.reload();
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
