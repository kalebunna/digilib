@extends('layouts.app')
@section('content')
    <x-breadcrumb :title="'Kategori'" :subtitle="'Data'">
        @slot('right')
            <div class="col-8 d-flex justify-content-end">
                <a href="" id="btn-add-contact" class="btn btn-info d-flex" id="btn-tambah" data-bs-toggle="modal"
                    data-bs-target="#modal-tambah">
                    <i class="ti ti-users fs-5 me-1 text-white"></i> Tambah Data
                </a>
            </div>
        @endslot
    </x-breadcrumb>
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table" id="kategori_table">
                <thead class="header-item">
                    <tr>
                        <th style="width: 10%">NO</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal tambah-->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="form-tambah" action="{{ route('kategori.store') }}">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Nama
                                    Kategori</label>
                                <input type="text" class="form-control" required name="name-create" id="name-create">

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

    <!-- Modal edit-->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="form-update">
                    @method('put')
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Update Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Nama
                                    Kategori</label>
                                <input type="text" class="form-control" required name="name_update" id="name_update">
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
@endsection
@section('js')
    <script>
        var table;
        $(function() {
            table = $('#kategori_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kategori.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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

        function edit(prm) {
            $("#modal_edit").modal('show');
            var url = "{{ route('kategori.update', ':id') }}";
            url = url.replace(':id', $(prm).data('id'));
            $("#form-update").attr("action", url);
            $("#name_update").val($(prm).data('name'));
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
                data: {
                    name: $("#name_update").val(),
                },
                success: function(data) {
                    $('#modal_edit').modal('hide');
                    table.ajax.reload();
                    toastSuccess("Berhasil Di Perbarui")
                },
                error: function(data) {
                    $('#modal_edit').modal('hide');
                    toastError("Berhasil Gagal di Perbarui");
                }
            });
        });


        $("#form-tambah").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $("#form-tambah").attr("action"),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processing: true,
                serverSide: true,
                dataType: 'json',
                data: {
                    name: $("#name-create").val(),
                },
                success: function(data) {
                    $('#modal-tambah').modal('hide');
                    table.ajax.reload();
                    toastSuccess("Data Kategori Berhasil Di Tambah")
                },
                error: function(data) {
                    toastError("Data Kategori Gagal Di Tambah");
                }
            });
        });

        function hapus(prm) {
            var url = "{{ route('kategori.destroy', ':id') }}";
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
                    toastSuccess("Data Kategori Berhasil Di Hapus")
                },
                error: function(data) {
                    toastError("Data Kategori Gagal Di Hapus");
                }

            });
        })
    </script>
@endsection
