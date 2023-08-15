 @extends('layouts.app')
 @section('content')
     <x-breadcrumb :title="'Buku'" :subtitle="'Data'">
         @slot('right')
             <div class="col-8 d-flex justify-content-end">
                 <a href="#" id="btn-add-contact" class="btn btn-info d-flex" id="btn-tambah" data-bs-toggle="modal"
                     data-bs-target="#modal-tambah" style="margin-right: 4px">
                     <i class="ti ti-users fs-5 me-1 text-white"></i> Tambah Data
                 </a>
                 <a href="{{ route('buku.export') }}" class="btn btn-primary d-flex" style="margin-right: 4px">
                     <i class="ti ti-users fs-5 me-1 text-white"></i>Export Barcode
                 </a>

                 <div class="dropdown">
                     <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         Import Data
                     </a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                 data-bs-target="#modal-import">Import Data</a></li>
                         <li><a class="dropdown-item" href="{{ route('download', 'buku') }}">Download Templates</a></li>
                     </ul>
                 </div>
                 {{-- <div class="btn-group mb-2">
                     <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton">
                         Action
                     </button>

                 </div> --}}
             </div>
         @endslot
     </x-breadcrumb>
     <div class="card card-body">
         <div class="table-responsive">
             <table class="table" id="kategori_table">
                 <thead class="header-item">
                     <tr>
                         <th style="width: 10%">NO</th>
                         <th>Judul Buku</th>
                         <th>Kategori</th>
                         <th>Pengarang</th>
                         <th>Penerbit</th>
                         <th>ISBN</th>
                         <th>EKS</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                 </tbody>
             </table>
         </div>
     </div>


     <!-- Modal tambah-->
     <div class="modal fade modal-lg" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <form method="POST" id="form-tambah" action="{{ route('buku.store') }}">
                     <div class="modal-header d-flex align-items-center">
                         <h5 class="modal-title">Tambah Data</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Judul
                                     Buku</label>
                                 <input type="text" class="form-control" required name="judul" id="judul">
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                     </span>Kategori</label>
                                 <select name="kategori_id" id="kategori_id" class="form-control" required>
                                     <option value="">--Pilih Kategori--</option>
                                     @foreach ($kategoris as $kategori)
                                         <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>Barcode</label>
                                 <input type="text" class="form-control" name="barcode" id="barcode">
                                 <p class="text-warning">Kosongkan Untuk Generate</p>
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>pengarang</label>
                                 <input type="text" class="form-control" required name="pengarang" id="pengarang">
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1">Penerbit</label>
                                 <input type="text" class="form-control" required name="penerbit" id="penerbit">
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1">Tahun Terbit</label>
                                 <input type="number" class="form-control" required name="thn_terbit" id="thn_terbit">
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>ISBN</label>
                                 <input type="text" class="form-control" required name="no_isbn" id="no_isbn">
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>Eksemplar</label>
                                 <input type="number" class="form-control" required name="eksemplar" id="eksemplar">
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal" type="button"> kembali
                         </button>
                         <button id="btn-add" class="btn btn-success rounded-pill px-4" type="submit">Simpan</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     {{-- Modal Hapus --}}
     <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Akan
                     Menghapus <i id="modal_nama_kategori"></i>
                 </div>
                 <div class="modal-footer">
                     <form method="POST" id="form-delete">
                         <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">No</button>
                         <button type="submit" class="btn btn-danger px-3 py-1">Yes</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     {{-- Modal End --}}

     <!-- Modal edit-->
     <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
             <div class="modal-content">
                 <form method="POST" id="form-update">
                     @method('put')
                     <div class="modal-header d-flex align-items-center">
                         <h5 class="modal-title">Update Data</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Judul
                                     Buku</label>
                                 <input type="text" class="form-control" required name="judul" id="judul-update">
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                     </span>Kategori</label>
                                 <select name="kategori_id" id="kategori_id-update" class="form-control" required>
                                     <option value="">--Pilih Kategori--</option>
                                     @foreach ($kategoris as $kategori)
                                         <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>Barcode</label>
                                 <input type="text" class="form-control" name="no_barcode" id="no_barcode-update"
                                     required>
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>pengarang</label>
                                 <input type="text" class="form-control" required name="pengarang"
                                     id="pengarang-update">
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1">Penerbit</label>
                                 <input type="text" class="form-control" required name="penerbit"
                                     id="penerbit-update">
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1">Tahun Terbit</label>
                                 <input type="number" class="form-control" required name="thn_terbit"
                                     id="thn_terbit-update">
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>ISBN</label>
                                 <input type="text" class="form-control" required name="no_isbn" id="no_isbn-update">
                             </div>
                             <div class="col-6 mb-2">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">
                                     </span>Eksemplar</label>
                                 <input type="number" class="form-control" required name="eksemplar"
                                     id="eksemplar-update">
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal" type="button"> kembali
                         </button>
                         <button id="btn-add" class="btn btn-success rounded-pill px-4" type="submit">Simpan</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     {{-- modal import    --}}
     <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>

                 <form method="POST" id="form-import">
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-12">
                                 <label for="" class="fw-bold mb-1"><span class="text-danger">*
                                     </span>Gambar</label>
                                 <input type="file" class="form-control" name="file" id="file">
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">No</button>
                         <button type="submit" class="btn btn-danger px-3 py-1">Yes</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 @endsection
 @section('js')
     <script>
         var table;
         $(function() {
             table = $('#kategori_table').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: "{{ route('buku.index') }}",
                 columns: [{
                         data: 'DT_RowIndex',
                         name: 'DT_RowIndex'
                     },
                     {
                         data: 'judul',
                         name: 'judul'
                     },
                     {
                         data: 'kategori',
                         name: 'kategori'
                     },
                     {
                         data: 'pengarang',
                         name: 'pengarang'
                     },
                     {
                         data: 'penerbit',
                         name: 'penerbit'
                     },
                     {
                         data: 'no_isbn',
                         name: 'no_isbn'
                     },
                     {
                         data: 'eksemplar',
                         name: 'eksemplar'
                     },
                     {
                         data: 'action',
                         name: 'action',
                         orderable: false,
                         searchable: false
                     },
                 ]
             });
         });

         $("#form-tambah").submit(function(e) {
             e.preventDefault();
             $.ajax({
                 url: "{{ route('buku.store') }}",
                 type: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 dataType: 'json',
                 data: $("#form-tambah").serializeArray(),
                 success: function(data) {
                     console.log(data);
                     $('#modal-tambah').modal('hide');
                     table.ajax.reload();
                     toastSuccess("Berhasil Di Tambah")
                 },
                 error: function(data) {
                     toastError("Berhasil Gagal di Tamabh");
                 }
             });
         });

         function hapus(prm) {
             var url = "{{ route('buku.destroy', ':id') }}";
             url = url.replace(':id', prm);
             $("#form-delete").attr("action", url);
         }

         $("#form-delete").submit(function(e) {
             e.preventDefault();
             $.ajax({
                 type: 'post',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: $(this).attr('action'),
                 data: {
                     '_method': 'delete'
                 },
                 success: function(response) {
                     $('#modal-delete').modal('hide');
                     table.ajax.reload();
                     toastSuccess("Data Buku Berhasil Di Hapus")
                 },
                 error: function(data) {
                     toastError("Data Buku Gagal Di Hapus");
                 }

             });
         })

         function edit(prm) {
             var url = "{{ route('buku.update', ':id') }}";
             url = url.replace(':id', $(prm).data('id'));
             $("#form-update").attr("action", url);
             $("#judul-update").val($(prm).data("judul"));
             $("#no_barcode-update").val($(prm).data("no_barcode"));
             $("#pengarang-update").val($(prm).data("pengarang"));
             $("#penerbit-update").val($(prm).data("penerbit"));
             $("#thn_terbit-update").val($(prm).data("thn_terbit"));
             $("#eksemplar-update").val($(prm).data("eksemplar"));
             $("#no_isbn-update").val($(prm).data("no_isbn"));
             $("#kategori_id-update").val($(prm).data("kategori_id"));
         }

         $("#form-update").submit(function(e) {
             e.preventDefault();
             $.ajax({
                 url: $("#form-update").attr("action"),
                 type: 'PUT',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 dataType: 'json',
                 data: $("#form-update").serializeArray(),
                 success: function(data) {
                     $('#modal_edit').modal('hide');
                     table.ajax.reload();
                     toastSuccess("Berhasil Di Perbarui")
                 },
                 error: function(data) {
                     $('#modal_edit').modal('hide');
                     toastError("Gagal di Perbarui");
                 }
             });
         });

         $("#form-import").submit(function(e) {
             e.preventDefault();
             var Data = new FormData(this);
             $.ajax({
                 url: "{{ route('buku.import') }}",
                 type: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 dataType: 'json',
                 cache: false,
                 contentType: false,
                 processData: false,
                 data: Data,
                 success: function(data) {},
                 error: function(data) {}
             });
         });
     </script>
 @endsection
