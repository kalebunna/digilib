@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('templates/vendor/selectsize/css.css') }}" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Cari Anggota</h5>
                    <div class="input-group mb-2 mt-3">
                        <div class="input-group-text">
                            <i class="ti ti-qrcode fs-4"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Masukkan kode Anggota"
                            aria-label="id_anggota" name="kode_anggota" id="kode_anggota">
                    </div>
                    <div class="d-flex align-content-center">
                        <select id="cari_anggota" name="cari_anggota" placeholder="Cari Member ...." class="w-100">
                            <option value="">Cari Member ....</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" data-nama="{{ $member->nama }}">
                                    {{ $member->nama }}
                                    ||
                                    {{ $member->nisn }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                </div>
                <div class="bg-light-info card-body shadow-none">
                    <h6>
                        <input type="hidden" disabled id="member_id">
                        Nama &nbsp; : <strong id="namaMember"></strong><br>
                        Kelas&nbsp; : <strong id="kelas"></strong><br>
                        Gender&nbsp; : <strong id="gender"></strong>
                    </h6>
                </div>
            </div>

            <div class="card bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between text-white">
                        <div class="border-end w-100 text-center">
                            <h6 class="fw-normal">Durasi</h6>
                            <b class="fw-semibold">7 Hari</b>
                        </div>
                        <div class="border-end w-100 ms-3 pe-3 text-center">
                            <h6 class="fw-normal">Pinjam</h6>
                            <b>{{ $today }}</b>
                        </div>
                        <div class="w-100 ms-3 text-center">
                            <h6 class="fw-normal">Tenggat</h6>
                            <b>{{ $dedlen }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Cari Buku</h5>
                    <form>
                        <div class="input-group mb-2 mt-3">
                            <div class="input-group-text">
                                <i class="ti ti-qrcode fs-4"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Masukkan kode Buku" aria-label="id_book"
                                id="kode_buku" name="kode_buku">
                        </div>
                    </form>
                    <form id="form-cari-buku" name="form-cari-buku">
                        <div class="d-flex align-content-center">
                            <select id="cari_buku" name="cari_buku" placeholder="Cari Buku ...." class="form-control">
                                <option value="">Cari Buku ....</option>
                                @foreach ($bukus as $book)
                                    <option value="{{ $book->no_barcode }}">
                                        {{ $book->judul }}&nbsp;||&nbsp;<b>{{ $book->no_barcode }}</b>
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn waves-effect waves-light btn-outline-warning"
                                style="margin-left:
                        10px"><i
                                    class="ti ti-square-plus fs-4"></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body border-top">
                    <table class="table align-middle" id="buku_table">
                        <thead>
                            <tr class="text-muted fw-semibold">
                                <th scope="col" class="ps-0">Buku</th>
                                <th scope="col">Pengarang</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="first">
                        </tbody>
                    </table>
                    <button class="btn btn-success w-100" id="simpan" onclick="simpan()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('templates/vendor/selectsize/js.js') }}"></script>
    <script src="https://rawgit.com/kabachello/jQuery-Scanner-Detection/master/jquery.scannerdetection.js"></script>

    <script>
        $("#kode_buku").scannerDetection({
            timeBeforeScanTest: 200, // wait for the next character for upto 200ms
            avgTimeByChar: 100, // it's not a barcode if a character takes longer than 100ms
            onComplete: function(barcode, qty) {
                get_book_barcode(barcode);
                $("#kode_buku").val('');
            }
        });

        var cari_buku;
        $(function(param) {
            $('#cari_anggota').selectize({
                labelField: 'title',
                searchField: 'title',
                sortField: 'text',
                onChange: function(e) {
                    let data = this.options[e];
                    // console.log(data.value);
                    let id = data.value;
                    console.log(id);
                    var url = "{{ route('member.show', ':id') }}";
                    url = url.replace(':id', id);
                    console.log(url);
                    $.get(url,
                        function(data) {
                            console.log(data);
                            $("#namaMember").html(data.nama);
                            $("#gender").html(data.gender);
                            $("#kelas").html(data.kelas);
                            $("#member_id").val(data.id);
                        },
                        "json"
                    );
                },

            });

            cari_buku = $('#cari_buku').selectize({
                sortField: 'text'
            });
        });

        function add_book_to_table(id, name, pengarang, ISBN) {
            let status = true;
            $('#buku_table tr').each(function(a, b) {
                let book_id = $("#book_id", b).text();
                if (book_id == id) {
                    status = false;
                }
            });
            if (status) {
                $('#buku_table > tbody:first').append(`
            <tr>
                <td id="book_id" style="display:none;">` + id + `</td>
                    <td class="ps-0">
                        <h6 class="fw-semibold mb-0" id="namaMember">` + name + `</h6>
                    </td>
                        <td>
                                    <p class="mb-0">` + pengarang + `</p>
                                </td>
                                <td class="text-dark">
                                    <p class="mb-0">` + ISBN + `</p>
                                </td>
                                <td>
                                    <a class="btn btn-dark btn-sm">
                                        <i class="ti ti-trash fs-5" onclick="delete_book_row(this)"></i>
                                    </a>
                                </td>
                            </tr>`);
            }

        }

        function get_book_barcode(barcode) {
            $.ajax({
                url: "{{ route('buku.barcode') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "no_barcode": barcode,
                },
                success: function(response) {
                    console.log(response);
                    add_book_to_table(response.id, response.judul, response.pengarang, response
                        .no_isbn);
                    //show success message
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        $('#form-cari-buku').submit(function(e) {
            e.preventDefault();
            get_book_barcode($(this.cari_buku).val())
            // $("#form-cari-buku")[0].reset();
            let tes = cari_buku[0].selectize;
            tes.clear();
            console.log("tes");
        });

        function delete_book_row(e) {
            $(e).parent().parent().parent().remove();
        }

        function simpan() {
            var ids = [];
            $('#buku_table tr').each(function(a, b) {
                let id = $("#book_id", b).text();
                if (id) {
                    ids.push({
                        buku_id: id
                    });
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('transaksi.peminjaman') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    member_id: $("#member_id").val(),
                    books: ids
                },
                dataType: "json",
                success: function(response) {
                    toastSuccess("Peminjaman Berhasil")
                },
                error: function() {
                    toastError("Peminjaman Gagal")
                }
            });
        }
    </script>
@endsection
