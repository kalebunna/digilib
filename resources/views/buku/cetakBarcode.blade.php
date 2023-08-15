 @extends('layouts.app')
 @section('style')
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
     <link rel="stylesheet" href="{{ asset('templates/css/editor.dataTables.min.css') }}">
 @endsection
 @section('content')
     <x-breadcrumb :title="'Buku'" :subtitle="'Data'">
         @slot('right')
             <div class="col-8 d-flex justify-content-end">
                 <button type="button" id="btn-add-contact" class="btn btn-info d-flex" onclick="print()" id="btn-tambah"
                     style="margin-right: 4px">
                     <i class="ti ti-users fs-5 me-1 text-white"></i>Print Barcode
                 </button>
             </div>
         @endslot
     </x-breadcrumb>
     <div class="card card-body">
         <div class="table-responsive">
             <table class="table" id="buku_table">
                 <thead class="header-item">
                     <tr>
                         <th></th>
                         <th style="width: 10%">NO</th>
                         <th>Judul Buku</th>
                         <th>Barcode</th>
                         <th>Jumlah Cetak</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($bukus as $buku)
                         <tr>
                             <td></td>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $buku->judul }}</td>
                             <td>{{ $buku->no_barcode }}</td>
                             <td>
                                 <input type="number" class="form-control bg-dark text-white"
                                     value="{{ $buku->eksemplar }}" id="eks{{ $loop->iteration }}"
                                     onchange="updateEks(this)">
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
     <input type="text" value="1" id="test" onchange="update()">
 @endsection
 @section('js')
     <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
     <script src="{{ asset('templates/js/dataTables.editor.min.js') }}"></script>
     <script>
         var table;
         $(function() {
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             table = new DataTable('#buku_table', {
                 columnDefs: [{
                     orderable: false,
                     className: 'select-checkbox',
                     targets: 0,
                     'checkboxes': {
                         'selectRow': true
                     }
                 }],
                 select: {
                     'style': 'multi',
                     selector: 'td:first-child'
                 },
                 order: [
                     [1, 'asc']
                 ]
             });
         });

         function print() {
             var rows_selected = table.rows({
                 selected: true
             }).data();

             let datas = [];
             for (var i = 0; i < rows_selected.length; i++) {
                 let eksId = $(rows_selected[i][4]).attr('id');
                 let print = $("#" + eksId).val();
                 let barcode = rows_selected[i][3];
                 datas.push({
                     'barcode': barcode,
                     'print': print,
                     'name': rows_selected[i][2]
                 })
             }
             console.log(datas);
             let tempdata = {
                 "datas": datas
             }
             console.log(tempdata);
             //  $.post("{{ route('export.buku') }}", tempdata,
             //      function(data) {
             //          console.log(data);
             //          var blob = new Blob([data]);
             //          var link = document.createElement('a');
             //          link.href = window.URL.createObjectURL(blob);
             //          link.download = "myFileName.docx";
             //          link.click();
             //      },
             //  );
             $.ajax({
                 url: '{{ route('export.buku') }}',
                 method: 'POST',
                 data: tempdata,
                 xhrFields: {
                     responseType: 'blob' // Jenis respons adalah blob (binary data)
                 },
                 success: function(response, status, xhr) {
                     // Buat objek URL dari blob dan buat tautan unduh
                     var url = window.URL.createObjectURL(response);
                     var a = document.createElement('a');
                     a.href = url;
                     a.download = xhr.getResponseHeader('Content-Disposition').split('filename=')[
                         1]; // Mengambil nama file dari header respons
                     document.body.appendChild(a);
                     a.click();
                     window.URL.revokeObjectURL(url); // Bebaskan objek URL setelah selesai
                 },
                 error: function(xhr, status, error) {
                     console.error('Gagal mengunduh file:', error);
                 }
             });
         }
     </script>
 @endsection
