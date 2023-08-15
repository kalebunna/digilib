@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css"
        integrity="sha512-Ars0BmSwpsUJnWMw+KoUKGKunT7+T8NGK0ORRKj+HT8naZzLSIQoOSIIM3oyaJljgLxFi0xImI5oZkAWEFARSA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="p-6">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="ti ti-qrcode fs-4"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Masukkan kode Anggota"
                            aria-label="id_anggota" name="kode_anggota" id="kode_anggota">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-light-primary">
                    <h6 class="text-primary">Cari Data</h6>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-primary w-100 rounded-pill mt-2" onclick="" data-bs-toggle="modal"
                        data-bs-target="#modal-peminjam ">Cari Peminjam</a>
                    <a href="#" class="btn btn-secondary w-100 rounded-pill mt-2" onclick="simpan()">Simpan</a>
                    <a href="#" class="btn btn-danger w-100 rounded-pill mt-2 mt-2" onclick="reset()">Batal</a>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="bg-light rounded-1 d-inline-flex align-items-center justify-content-center mb-3 p-6">
                        <i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
                    </div>
                    <h5 class="fs-5 fw-semibold mb-3">Detail Peminjaman</h5>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Kode Peminjaman:</label>
                        <div class="col-md-9">
                            <span class="badge fw-semibold w-85 bg-light-warning text-warning py-1" id="kode"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Nama</label>
                        <div class="col-md-9">
                            <h6 class="form-control-static" id="nama"></h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Kelas</label>
                        <div class="col-md-9">
                            <h6 class="form-control-static" id="kelas"></h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Tanggal Pinjam</label>
                        <div class="col-md-9">
                            <h6 class="form-control-static" id="tgl_pinjam"></h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Tenggat</label>
                        <div class="col-md-9">
                            <h6 class="form-control-static" id="tgl_pengembalian"></h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">status</label>
                        <div class="col-md-9" id="status">
                        </div>
                    </div>
                    <hr>
                    <h4 class="text-right">Denda : <strong id="denda"></strong></h4>
                    <hr>
                    <div class="table-responsive" style="clear: both">
                        <table class="table-hover table" id="buku-table">
                            <thead>
                                <!-- start row -->
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Buku</th>
                                    <th scope="col">Pengarang</th>
                                    <th scope="col">ISBN</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody id="first">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal tambah-->
    <div class="modal fade" id="modal-peminjam" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="w-100 table" id="peminjaman-table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Transaksi</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Pimjam</th>
                                    <th>Pengembalian</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-add" class="btn btn-success rounded-pill px-4" type="submit">Simpan</button>
                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> kembali </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal konfirmasi --}}
    <div class="modal fade" id="modal-konfir" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Mengembalikan Peminjaman
                    <i id="konfirNamaPeminjam"></i>
                </div>
                <div class="modal-footer">
                    <form method="POST" id="form-simpan">
                        <input type="hidden" name="kodeTransaksi" id="kodeTransaksi">
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table = $('#peminjaman-table').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                ajax: "{{ route('pengembalian') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kodeTransaksi',
                        name: 'kodeTransaksi',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                    },
                    {
                        data: 'tgl_pinjam',
                        name: 'tgl_pinjam',
                    },
                    {
                        data: 'tgl_pengembalian',
                        name: 'tgl_pengembalian',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                ]
            });
        });

        $("#peminjaman-table tbody").on('click', 'tr', (e) => {
            let classList = e.currentTarget.classList;

            if (classList.contains('selected')) {
                classList.remove('selected');
            } else {
                table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');
            }
            let data = table.rows('.selected').data();
            // console.log(data[0].kodeTransaksi);
            getDataByKodeTransaksi(data[0].kodeTransaksi);
        });

        function getDataByKodeTransaksi(kodeTransaksi) {
            data = {
                kodeTransaksi: kodeTransaksi
            }
            $.post("{{ route('pengambalian.cari') }}", data,
                function(data) {
                    reset();
                    $("#kode").html(data.kodeTransaksi);
                    $("#nama").html(data.member.nama);
                    $("#kelas").html(data.member.kelas);
                    $("#tgl_pinjam").html(data.tgl_pinjam);
                    $("#tgl_pengembalian").html(data.tgl_pengembalian);
                    $("#status").html(data.status);

                    data.buku.forEach(element => {
                        $('#buku-table > tbody:first').append(`
            <tr>
                    <td class="ps-0">
                        <h6 class="fw-semibold mb-0">` + element.judul + `</h6>
                    </td>
                        <td>
                                    <p class="mb-0">` + element.pengarang + `</p>
                                </td>
                                <td class="text-dark">
                                    <p class="mb-0">` + element.no_isbn + `</p>
                                </td>
                            </tr>`);
                    });
                },
                "json"
            );
        }

        function reset() {
            $("#kode").html("");
            $("#nama").html("");
            $("#kelas").html("");
            $("#tgl_pinjam").html("");
            $("#tgl_pengembalian").html("");
            $("#status").html("");
            $("#buku-table > tbody:first").empty();
        }

        function simpan() {
            if ($("#kode").html() === "") {
                toastError("Pilih Data Transaksi Terlebih Dhulu");
            } else {
                $("#konfirNamaPeminjam").html($("#nama").html())
                $("#kodeTransaksi").val($("#kode").html())
                $("#modal-konfir").modal('show');
            }

        }

        $("#form-simpan").submit(function(e) {
            e.preventDefault();
            let data = $("#form-simpan").serializeArray();
            $.post("{{ route('transaksi.pengembalian') }}", data,
                function(data) {
                    reset();
                    toastSuccess("Berhasil!! Pengembalian Berhasil");
                    $("#modal-konfir").modal('hide');
                },
                "json"
            ).fail(() => {
                reset();
                toastError("Gagal!! Terjadi Kesalahan");
                $("#modal-konfir").modal('hide');
            });
        });
    </script>
@endsection
