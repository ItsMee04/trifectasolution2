 <div class="table-responsive">
     <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped" id="driverTable"
         style="width: 100%">
         <thead class="student-thread">
             <tr>
                 <th>No.</th>
                 <th>Kode Driver</th>
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
         initDriverTable();
     });

     // 1. Service: Fungsi untuk menyediakan data
     function getDriverService() {
         // Kita mengembalikan objek AJAX agar bisa digunakan oleh DataTable
         return {
             "url": "/driver/getDriver", // Menggunakan route name Laravel
             "type": "GET",
             "dataSrc": function(json) {
                 // Memastikan data yang diterima sesuai struktur
                 return json.data;
             }
         };
     }

     // 2. Logic: Fungsi untuk inisialisasi DataTable
     function initDriverTable() {
         if ($('#driverTable').length > 0) {
             $('#driverTable').DataTable({
                 "destroy": true,
                 "pagingType": "simple_numbers", // Menampilkan nomor halaman lengkap
                 "serverSide": false,

                 // PERUBAHAN DI SINI: Gunakan "ajax", bukan "data"
                 "ajax": getDriverService(),

                 "columns": [{
                         "data": null,
                         "render": function(data, type, row, meta) {
                             return meta.row + 1;
                         }
                     },
                     {
                         "data": "kode"
                     },
                     {
                         "data": "nama"
                     },
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
