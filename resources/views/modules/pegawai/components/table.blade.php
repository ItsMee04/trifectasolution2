 <div class="table-responsive">
     <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped" id="pegawaiTable"
         style="width: 100%">
         <thead class="student-thread">
             <tr>
                 <th>No.</th>
                 <th>Nama</th>
                 <th>Kontak</th>
                 <th>Alamat</th>
                 <th>Status</th>
                 <th class="text-end">Action</th>
             </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
 </div>

 <script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
 <script>
     $(document).ready(function() {
         // Panggil fungsi inisialisasi
         initPegawaiTable();
     });

     // 1. Service: Fungsi untuk menyediakan data
     function getPegawaiService() {
         // Kita mengembalikan objek AJAX agar bisa digunakan oleh DataTable
         return {
             "url": "/pegawai/getPegawai", // Menggunakan route name Laravel
             "type": "GET",
             "dataSrc": function(json) {
                 // Memastikan data yang diterima sesuai struktur
                 return json.data;
             }
         };
     }

     // 2. Logic: Fungsi untuk inisialisasi DataTable
     function initPegawaiTable() {
         if ($('#pegawaiTable').length > 0) {
             $('#pegawaiTable').DataTable({
                 "destroy": true,
                 "pagingType": "simple_numbers", // Menampilkan nomor halaman lengkap
                 "serverSide": false,

                 // PERUBAHAN DI SINI: Gunakan "ajax", bukan "data"
                 "ajax": getPegawaiService(),

                 "columns": [{
                         "data": null,
                         "render": function(data, type, row, meta) {
                             return meta.row + 1;
                         }
                     },
                     {
                         "data": "image", // Ini adalah field nama file gambar dari database (misal: "budi.jpg")
                         "render": function(data, type, row) {
                             // Path menuju folder avatar di dalam storage
                             let folderPath = "/storage/pegawai/image/";

                             // Logika pemilihan gambar:
                             // Jika data (nama file) tidak kosong, pakai path storage.
                             // Jika kosong, pakai gambar default.
                             let imgSrc = (data && data !== "") ? folderPath + data :
                                 "/assets/img/profiles/avatar-01.jpg";

                             // Cache busting (opsional) agar saat ganti foto langsung berubah tanpa clear cache
                             let timestamp = new Date().getTime();

                             return `
                            <h2 class="table-avatar">
                                <span class="avatar avatar-sm me-2">
                                    <img class="avatar-img rounded-circle"
                                        src="${imgSrc}?t=${timestamp}"
                                        alt="User Image"
                                        onerror="this.onerror=null;this.src='/assets/img/profiles/avatar-01.jpg';">
                                </span>
                                <span>${row.nama}</span>
                            </h2>`;
                         }
                     }, // Pastikan di JSON Controller key-nya adalah "nama"
                     {
                         "data": "kontak"
                     },
                     {
                         "data": "alamat"
                     },
                     {
                         "data": "status",
                         "render": function(data) {
                             if (data == 1) {
                                 return `<span class="badge bg-success">ACTIVE</span>`;
                             } else {
                                 return `<span class="badge bg-danger">INACTIVE</span>`;
                             }
                         }
                     },
                     {
                         "data": null,
                         "orderable": false,
                         "className": "text-end",
                         "render": function(data, type, row) {
                             return `
                        <div class="actions">
                            <a href="javascript:void(0);" class="btn btn-sm bg-danger-light btn-edit me-2" data-id="${row.id}">
                                <i class="feather-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm bg-danger-light btn-delete" data-id="${row.id}">
                                <i class="feather-trash-2"></i>
                            </a>
                        </div>`;
                         }
                     }
                 ],
                 "language": {
                     "loadingRecords": "Memuat data...",
                     "zeroRecords": "Tidak ada data.",
                     "search": "Cari:",
                     "paginate": {
                         // Gunakan teks atau simbol sesuai keinginan agar mirip gambar
                         "previous": "Previous",
                         "first": "First",
                     }
                 },
                 "drawCallback": function() {
                     // Sesuai permintaan Anda: Feather icons tetap diproses
                     if (typeof feather !== 'undefined') {
                         feather.replace();
                     }
                 }
             });
         }
     }
 </script>
