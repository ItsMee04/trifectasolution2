 <div class="table-responsive">
     <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped" id="perjalananTable"
         style="width: 100%">
         <thead class="student-thread">
             <tr>
                 <th>No.</th>
                 <th>Material</th>
                 <th>Tanggal</th>
                 <th>Kode</th>
                 <th>No. Polisi</th>
                 <th>Driver</th>
                 <th>Suplier</th>
                 <th>Volume</th>
                 <th>Berat Total</th>
                 <th>Berat Kendaraan</th>
                 <th>Berat Muatan</th>
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
         initPerjalananTable();
     });

     // 1. Service: Fungsi untuk menyediakan data
     function getPerjalananService() {
         // Kita mengembalikan objek AJAX agar bisa digunakan oleh DataTable
         return {
             "url": "/perjalanan/getPerjalanan", // Menggunakan route name Laravel
             "type": "GET",
             "dataSrc": function(json) {
                 // Memastikan data yang diterima sesuai struktur
                 return json.data;
             }
         };
     }

     // 2. Logic: Fungsi untuk inisialisasi DataTable
     function initPerjalananTable() {
         if ($('#perjalananTable').length > 0) {
             $('#perjalananTable').DataTable({
                 "destroy": true,
                 "pagingType": "simple_numbers", // Menampilkan nomor halaman lengkap
                 "serverSide": false,

                 // PERUBAHAN DI SINI: Gunakan "ajax", bukan "data"
                 "ajax": getPerjalananService(),

                 "columns": [{
                         "data": null,
                         "render": function(data, type, row, meta) {
                             return meta.row + 1;
                         }
                     },
                     {
                         "data": "material.nama"
                     },
                     {
                         "data": "tanggal"
                     },
                     {
                         "data": "kode"
                     },
                     {
                         "data": "kendaraan.no_polisi"
                     },
                     {
                         "data": "driver.nama"
                     },
                     {
                         "data": "suplier.nama"
                     },
                     {
                         "data": "volume"
                     },
                     {
                         "data": "berat_total"
                     },
                     {
                         "data": "berat_kendaraan"
                     },
                     {
                         "data": "berat_muatan"
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
