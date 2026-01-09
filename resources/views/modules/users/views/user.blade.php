@extends('layouts.app')
@section('title', 'Users Management')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman Users</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/pegawai">Users</a></li>
                            <li class="breadcrumb-item active">Data Users</li>
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
                                    <h3 class="page-title">Data Users</h3>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.users.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.users.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        loadRoles();
        // --- LOGIC: LOAD ROLE KE SELECT OPTION ---
        function loadRoles() {
            let select = $('#selectRole');

            $.ajax({
                url: '/role/getRole', // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Kosongkan select dan beri opsi default
                        select.empty();
                        select.append('<option value="">Pilih Role</option>');

                        // Looping data dari backend
                        $.each(response.data, function(key, role) {
                            select.append(
                                `<option value="${role.id}">${role.role}</option>`);
                        });
                    }
                },
                error: function() {
                    select.html('<option value="">Gagal memuat data</option>');
                }
            });
        }
        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT USERS');

            // Panggil Service untuk ambil data satu users (AJAX GET)
            $.ajax({
                url: `/users/editUsers/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    $('#formEditUsers').find('input[name="namaPegawai"]').val(response
                        .data.pegawai.nama);

                    $('#formEditUsers').find('input[name="emailPegawai"]').val(response
                        .data.email);

                    $('#formEditUsers').find('input[name="passwordPegawai"]').val(response
                        .data.password);

                    $('#formEditUsers').find('#selectRole').val(response.data.role_id).change();
                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditUsers').attr('action', `/users/updateUsers/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data users");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT PEGAWAI ---
        $('#formEditUsers').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnUpdateUsers');
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

                    $('#formEditUsers')[0].reset();

                    btn.prop('disabled', false).html('Simpan Users');
                    $('#usersTable').DataTable().ajax.reload();
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
                    btn.prop('disabled', false).html('Simpan Users');
                }
            });
        });

        // --- LOGIC: HAPUS USERS DENGAN SWEETALERT2 ---
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
