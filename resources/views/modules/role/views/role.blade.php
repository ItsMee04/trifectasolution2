@extends('layouts.app')
@section('title', 'Role Management')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman Role</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/role">Role</a></li>
                            <li class="breadcrumb-item active">Data Role</li>
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
                                    <h3 class="page-title">Data Role</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a class="btn btn-primary" href="#" id="tambahRole"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.role.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.role.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol tambah role
        $('#tambahRole').on('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman jika menggunakan tag <a>
            // Memanggil modal menggunakan Bootstrap 5 function
            $('#modalTambah').modal('show');
            // Opsional: Mengubah judul modal secara dinamis
            $('#modalTambah .modal-title').text('TAMBAH ROLE');
        });

        $('#formTambahRole').on('submit', function(e) {
            e.preventDefault(); // Menghentikan reload halaman

            const btn = $('#btnSimpanRole');
            const formData = $(this).serialize(); // Mengambil semua input form

            // 1. UI Logic: Disable button & Loading state
            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm"></span> Menyimpan...');

            // 2. Service Call: Mengirim data ke server
            $.ajax({
                url: $(this).attr('action'), // Mengambil /role/storeRole dari atribut form
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // 3. Logic Success: Tutup modal & Refresh data
                    $('#modalTambah').modal('hide');

                    // Notifikasi sukses (Bisa pakai SweetAlert2 atau alert biasa)
                    toastr.success("berhasil disimpan!", "Message", {
                        closeButton: !0,
                        tapToDismiss: !1,
                    });

                    // Reset form setelah sukses
                    $('#formTambahRole')[0].reset();

                    // Kembalikan tombol ke keadaan semula
                    btn.prop('disabled', false).html('Simpan Role');

                    // Sesuai permintaan: Refresh tabel tanpa reload halaman
                    $('#roleTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    // 4. Logic Error: Aktifkan kembali tombol jika gagal
                    toastr.error(
                        "Terjadi kesalahan. + " + xhr.responseText,
                        "Inconceivable!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                        }
                    );
                    btn.prop('disabled', false).html('Simpan Role');
                }
            });
        });

        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            console.log("Tombol edit diklik untuk ID:", id);

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT ROLE');

            // Panggil Service untuk ambil data satu role (AJAX GET)
            $.ajax({
                url: `/role/editRole/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    // Contoh response: { id: 1, role: 'ADMIN' }
                    $('#formEditRole').find('input[name="editRole"]').val(response.data
                        .role);

                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditRole').attr('action', `/role/updateRole/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data role");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT ROLE ---
        $('#formEditRole').on('submit', function(e) {
            e.preventDefault(); // Menghentikan reload halaman

            const btn = $('#btnUpdateRole');
            const formData = $(this).serialize(); // Mengambil input 'editRole'
            const url = $(this).attr(
                'action'); // Mengambil URL yang sudah kita set saat klik tombol edit

            // 1. UI Logic: Disable button & Loading state
            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm"></span> Updating...');

            // 2. Service Call: Mengirim data update ke server
            $.ajax({
                url: url,
                type: 'POST', // Laravel biasanya menggunakan POST dengan method spoofing atau langsung POST ke route update
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // 3. Logic Success: Tutup modal & Refresh data tabel
                    $('#modalEdit').modal('hide');

                    toastr.success("Data berhasil diperbarui!", "Message", {
                        closeButton: !0,
                        tapToDismiss: !1,
                    });

                    // Reset form
                    $('#formEditRole')[0].reset();

                    // Kembalikan tombol ke keadaan semula
                    btn.prop('disabled', false).html('Simpan Role');

                    // Refresh tabel tanpa reload halaman
                    $('#roleTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    // 4. Logic Error: Aktifkan kembali tombol jika gagal
                    toastr.error(
                        "Gagal memperbarui data. " + xhr.statusText,
                        "Error!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                        }
                    );
                    btn.prop('disabled', false).html('Simpan Role');
                }
            });
        });

        // --- LOGIC: HAPUS ROLE DENGAN SWEETALERT2 ---
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data role akan dihapus secara permanen!",
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
                        url: `/role/deleteRole/${id}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data role telah dihapus.',
                                'success'
                            );
                            // Refresh tabel
                            $('#roleTable').DataTable().ajax.reload();
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
