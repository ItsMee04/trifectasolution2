@extends('layouts.app')
@section('title', 'Material')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Halaman AMP</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/perjalanan">Perjalanan</a></li>
                            <li class="breadcrumb-item active">Data Material Masuk</li>
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
                                    <h3 class="page-title">Data Material Masuk</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a class="btn btn-primary" href="#" id="tambahPerjalanan"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE HERE -->
                        @include('modules.amp.components.table')
                        <!-- END TABLE HERE -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HERE -->
    @include('modules.amp.components.modal')
@endsection

<script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // --- LOGIC: MEMBUKA MODAL TAMBAH MATERIAL & LOAD DATA MATERIAL ---
        function loadMaterial() {
            const selectAdd = $('#selectMaterial');
            const selectEdit = $('#editselectMaterial'); // ID di Modal Edit (sesuai kode Anda)

            $.ajax({
                url: '/material/getMaterial',
                type: 'GET',
                success: function(response) {
                    if (response.data) {
                        let options = '<option value="">Pilih Material</option>';
                        $.each(response.data, function(key, item) {
                            options += `<option value="${item.id}">${item.nama}</option>`;
                        });
                        selectAdd.html(options);
                        selectEdit.html(options);
                    }
                }
            });
        }

        // --- LOGIC: LOAD DATA KENDARAAN ---
        function loadKendaraan() {
            const selectAdd = $('#selectKendaraan'); // ID di Modal Tambah
            const selectEdit = $('#editselectKendaraan'); // ID di Modal Edit (sesuai kode Anda)

            $.ajax({
                url: '/kendaraan/getKendaraan',
                type: 'GET',
                success: function(response) {
                    if (response.data) {
                        let options = '<option value="">Pilih No Polisi</option>';
                        $.each(response.data, function(key, item) {
                            options += `<option value="${item.id}">${item.nomor}</option>`;
                        });
                        selectAdd.html(options);
                        selectEdit.html(options);
                    }
                }
            });
        }

        // --- LOGIC: LOAD DATA DRIVER ---
        function loadDriver() {
            const selectAdd = $('#selectDriver'); // ID di Modal Tambah
            const selectEdit = $('#editselectDriver'); // ID di Modal Edit (sesuai kode Anda)

            $.ajax({
                url: '/driver/getDriver',
                type: 'GET',
                success: function(response) {
                    if (response.data) {
                        let options = '<option value="">Pilih Driver</option>';
                        $.each(response.data, function(key, item) {
                            options += `<option value="${item.id}">${item.nama}</option>`;
                        });
                        selectAdd.html(options);
                        selectEdit.html(options);
                    }
                }
            });
        }

        // --- LOGIC: LOAD DATA SUPLIER ---
        function loadSuplier() {
            const selectAdd = $('#selectSuplier'); // ID di Modal Tambah
            const selectEdit = $('#editselectSuplier'); // ID di Modal Edit (sesuai kode Anda)

            $.ajax({
                url: '/suplier/getSuplier',
                type: 'GET',
                success: function(response) {
                    if (response.data) {
                        let options = '<option value="">Pilih Suplier</option>';
                        $.each(response.data, function(key, item) {
                            options += `<option value="${item.id}">${item.nama}</option>`;
                        });
                        selectAdd.html(options);
                        selectEdit.html(options);
                    }
                }
            });
        }

        // Event listener untuk tombol tambah material
        $('#tambahPerjalanan').on('click', function(e) {
            e.preventDefault(); // Mencegah reload halaman jika menggunakan tag <a>
            loadMaterial(); // Panggil fungsi untuk memuat data material
            loadKendaraan(); // Panggil fungsi untuk memuat data kendaraan
            loadDriver(); // Panggil fungsi untuk memuat data driver
            loadSuplier(); // Panggil fungsi untuk memuat data suplier
            // Memanggil modal menggunakan Bootstrap 5 function
            $('#modalTambah').modal('show');
            // Opsional: Mengubah judul modal secara dinamis
            $('#modalTambah .modal-title').text('TAMBAH PERJALANAN');
            // Reset form setiap kali modal dibuka
            $('#formTambahPerjalanan')[0].reset();
        });

        $('#formTambahPerjalanan').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnSimpanMaterial'); // Pastikan ID tombol sesuai
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
                    toastr.success("Material berhasil disimpan!");
                    $('#perjalananTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    toastr.error("Terjadi kesalahan: " + xhr.responseText);
                },
                complete: function() {
                    btn.prop('disabled', false).html('Simpan Perjalanan');
                }
            });
        });

        // --- LOGIC: MEMBUKA MODAL EDIT & AMBIL DATA ---
        $(document).on('click', '.btn-edit', function() {
            loadMaterial(); // Panggil fungsi untuk memuat data material
            loadKendaraan(); // Panggil fungsi untuk memuat data kendaraan
            loadDriver(); // Panggil fungsi untuk memuat data driver
            loadSuplier(); // Panggil fungsi untuk memuat data suplier
            let id = $(this).data('id');

            // Tampilkan Loading pada tombol atau UI
            $('#modalEdit').modal('show');
            $('#modalEdit .modal-title').text('EDIT MATERIAL');

            // Panggil Service untuk ambil data satu material (AJAX GET)
            $.ajax({
                url: `/perjalanan/editPerjalanan/${id}`, // Sesuaikan dengan route Laravel Anda
                type: 'GET',
                success: function(response) {
                    // Isi form modal edit dengan data dari database
                    $('#formEditPerjalanan').find('input[name="editTanggal"]').val(response
                        .data.tanggal);
                    $('#formEditPerjalanan').find('#editselectMaterial').val(response.data
                        .material_id).change();
                    $('#formEditPerjalanan').find('input[name="editKode"]').val(response
                        .data.kode);
                    $('#formEditPerjalanan').find('#editselectKendaraan').val(response.data
                        .kendaraan_id).change();
                    $('#formEditPerjalanan').find('#editselectDriver').val(response.data
                        .driver_id).change();
                    $('#formEditPerjalanan').find('#editselectSuplier').val(response.data
                        .suplier_id).change();
                    $('#formEditPerjalanan').find('input[name="editVolume"]').val(response
                        .data.volume);
                    $('#formEditPerjalanan').find('input[name="editBerat_total"]').val(
                        response
                        .data.berat_total);
                    $('#formEditPerjalanan').find('input[name="editBerat_kendaraan"]').val(
                        response
                        .data.berat_kendaraan);
                    $('#formEditPerjalanan').find('input[name="editBerat_muatan"]').val(
                        response
                        .data.berat_muatan);

                    // Simpan ID di input hidden atau atribut form untuk proses update
                    $('#formEditPerjalanan').attr('action',
                        `/perjalanan/updatePerjalanan/${id}`);
                },
                error: function() {
                    toastr.error("Gagal mengambil data perjalanan");
                }
            });
        });

        // --- LOGIC: SUBMIT FORM EDIT PERJALANAN ---
        $('#formEditPerjalanan').on('submit', function(e) {
            e.preventDefault();

            const btn = $('#btnUpdatePerjalanan');
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

                    $('#formEditPerjalanan')[0].reset();

                    btn.prop('disabled', false).html('Simpan Perjalanan');
                    $('#perjalananTable').DataTable().ajax.reload();
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
                    btn.prop('disabled', false).html('Simpan Perjalanan');
                }
            });
        });

        // --- LOGIC: HAPUS PERJALANAN DENGAN SWEETALERT2 ---
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data perjalanan akan dihapus secara permanen!",
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
                        url: `/perjalanan/deletePerjalanan/${id}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Data perjalanan telah dihapus.',
                                'success'
                            );
                            // Refresh tabel
                            $('#perjalananTable').DataTable().ajax.reload();
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
