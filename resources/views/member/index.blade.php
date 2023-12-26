@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <x-breadcrumb :title="'Member'" :subtitle="'Data'">
        @slot('right')
            <div class="col-8 d-flex justify-content-end">
                <a href="" id="btn-add-contact" class="btn btn-info d-flex" id="btn-tambah" data-bs-toggle="modal"
                    data-bs-target="#modal-tambah" style="margin-right: 4px">
                    <i class="ti ti-users fs-5 me-1 text-white"></i> Tambah Data
                </a>
                <a href="" id="btn-add-contact" class="btn btn-success d-flex ml-2" id="btn-tambah"
                    data-bs-toggle="modal" data-bs-target="#modal_import_member">
                    <i class="ti ti-users fs-5 me-1 text-white"></i> Import Data Member
                </a>
            </div>
        @endslot
    </x-breadcrumb>
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table" id="member_table">
                <thead class="header-item">
                    <tr>
                        <th style="width: 10%">NO</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>TeTaLa</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
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
                <form method="POST" id="form-tambah" action="{{ route('member.store') }}">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Nama
                                    Anggota</label>
                                <input type="text" class="form-control" required name="nama" id="nama">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Kelas</label>
                                <input type="text" class="form-control" required name="kelas" id="kelas">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Tempat
                                    Lahir</label>
                                <input type="text" class="form-control" required name="tempat_lahir" id="tempat_lahir">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Tanggal
                                    Lahir</label>
                                <input type="date" class="form-control" required name="tanggal_lahir" id="tanggal_lahir">
                            </div>
                            <div class="col-12">
                                <label for="" class="fw-bold mb-1"><span class="text-danger">* </span>Jenis
                                    Kelamin</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
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
    <div class="modal fade" id="modal_import_member" tabindex="-1" role="dialog"
        aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Import Data Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">Templates Import Harus Disesuaikan Dengan Templates Yang Sudah Ada
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <label for="import_file">Pilih File (xls,xlsx,csv,dll)</label>
                            <input type="file" class="form-control" class="m-0" id="files" name="files">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-danger px-3 py-1 w-100" id="import-btn">Import
                                Data</button>
                        </div>
                    </div>
                    <div class="mt-2    row">
                        <div class="col-12">
                            <div class="table-responsive">

                                <table class="table  table-bordered  table-hover table-striped" id="modal_datamemberbaru">
                                    <thead>
                                        <tr>
                                            <th>STATUS</th>
                                            <th>NO</th>
                                            <th>NAMA </th>
                                            <th>NIK SISWA </th>
                                            <th>NISN </th>
                                            <th>KELAS </th>
                                            <th>L/P </th>
                                            <th>TEMPAT TANGGAL LAHIR </th>
                                            <th>Desa </th>
                                            <th>Kec </th>
                                            <th>Kode Pos</th>
                                            <th>AYAH </th>
                                            <th>IBU</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-secondary px-3 py-1"
                        onclick="simpanDataExcel()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var table;
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table = $('#member_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('member.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                    },
                    {
                        data: 'tempat_tanggal_lahir',
                        name: 'tempat_tanggal_lahir',
                    },
                    {
                        data: 'gender',
                        name: 'gender',
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
                url: "{{ route('member.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: $("#form-tambah").serializeArray(),
                success: function(data) {
                    $('#modal-tambah').modal('hide');
                    table.ajax.reload();
                    toastSuccess("Berhasil Di Tambah")
                },
                error: function(data) {
                    toastError("Gagal di Tambah");
                }
            });
        });

        function hapus(prm) {
            var url = "{{ route('member.destroy', ':id') }}";
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
                    toastSuccess("Data Member Berhasil Di Hapus")
                },
                error: function(data) {
                    toastError("Data Member Gagal Di Hapus");
                }

            });
        })

        function edit(prm) {
            var url = "{{ route('member.update', ':id') }}";
            url = url.replace(':id', $(prm).data('id'));
            $("#form-update").attr("action", url);
            $("#nama-update").val($(prm).data("nama"));
            $("#kelas-update").val($(prm).data("kelas"));
            $("#tempat_lahir-update").val($(prm).data("tempat_lahir"));
            $("#tanggal_lahir-update").val($(prm).data("tanggal_lahir"));
            $("#gender-update").val($(prm).data("gender"));
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
                    toastError("Berhasil Gagal di Perbarui");
                }
            });
        });
        $("#import-btn").on("click", function() {
            var inputFile = $("#files")[0].files[0];
            if (inputFile) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var data = new Uint8Array(e.target.result);
                    var workbook = XLSX.read(data, {
                        type: "array"
                    });
                    var sheetName = workbook.SheetNames[0];
                    var sheet = workbook.Sheets[sheetName];
                    var jsonData = XLSX.utils.sheet_to_json(sheet, {
                        header: 1
                    });
                    displayData(jsonData);
                };


                reader.readAsArrayBuffer(inputFile);
            } else {
                alert("Pilih file Excel terlebih dahulu.");
            }
        });

        function displayData(data) {
            var tableBody = $("#modal_datamemberbaru tbody");
            tableBody.empty();

            for (var i = 1; i < data.length; i++) {
                var row = $("<tr>");
                row.append($("<td id='status" + i + "'>").html("<span class='badge bg-info'>queue</span>"));
                row.append($("<td>").text(i));
                for (let j = 1; j <= 11; j++) {
                    row.append($("<td>").text(data[i][j]));
                }
                tableBody.append(row);
            }
        }

        function simpanDataExcel() {
            var dataArray = [];
            $('#modal_datamemberbaru tbody tr').each(function() {
                var rowData = [];

                // Iterasi melalui setiap sel pada baris
                $(this).find('td').each(function() {
                    rowData.push($(this).text());
                });

                // Menambahkan array baris ke array utama
                dataArray.push(rowData);
            });

            var index_table = 1;
            dataArray.forEach(element => {
                $.post("{{ route('member.store') }}", {
                        "nik": element[3],
                        "nama": element[2],
                        "kelas": element[5],
                        "tempat_tanggal_lahir": element[7],
                        "gender": element[6],
                        "nisn": element[4],
                        "desa": element[8],
                        "kecamatan": element[9],
                        "nama_ayah": element[11],
                        "nama_ibu": element[12]
                    },
                    function(response) {
                        if (response.res == "success") {
                            $("#status" + index_table).html("<span class='badge bg-success'>Berhasil</span>")
                            toastSuccess(response.nama + "Berhasil Diinputkan");
                        } else {
                            $("#status" + index_table).html("<span class='badge bg-warning'>Fail</span>")
                            toastError(response.nama + " " + response.message)
                        }
                        index_table++;
                    },
                    "json"
                ).fail(function(response) {
                    console.log(index_table);
                    $("#status" + index_table).html("<span class='badge bg-warning'>Fail</span>")
                    toastError(response.message);
                    index_table++;

                });

            });

        }
    </script>
@endsection
