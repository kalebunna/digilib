<!DOCTYPE html>
<html lang="en">


<head>
    <!-- --------------------------------------------------- -->
    <!-- Title -->
    <!-- --------------------------------------------------- -->
    <title>Digilib</title>
    <!-- --------------------------------------------------- -->
    <!-- Required Meta Tag -->
    <!-- --------------------------------------------------- -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- --------------------------------------------------- -->
    <!-- Favicon -->
    <!-- --------------------------------------------------- -->
    <link rel="shortcut icon" type="image/png" href="favicon.ico">
    <!-- --------------------------------------------------- -->
    <!--datatables -->
    <link rel="stylesheet" href="{{ asset('templates/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/vendor/select2/css.css') }}" />
    <!-- --------------------------------------------------- -->
    <!-- Core Css -->
    <!-- --------------------------------------------------- -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('templates/css/style.min.css') }}">
    <!-- --------------------------------------------------- -->
    @yield('style')
</head>

<body>


    <div id="main-wrapper">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-7">
                        <div class="card mb-0">

                            <div class="card-body pt-5">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="text-center">
                                            <h1>Selamat Datang Di Perpustakaan Digital</h1>
                                            <h1>MTs. Nasy'atul Muta'allimin</h1>
                                        </div>
                                        <h5 class="text-center">Masukkan Nama Kamu Di Bawah Ini</h5>
                                        <form class="position-relative w-100">
                                            <select id="input_member" class="form-control search-chat py-2 ps-5"
                                                id="text-srh" placeholder="Ketikkan Nama Anda">
                                                <i
                                                    class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                                                <option value="">Cari Data</option>
                                                @foreach ($members as $item)
                                                    <option value="{{ $item->id }}" data-nik="{{ $item->nik }}">
                                                        {{ $item->nama }} ||
                                                        {{ $item->kelas }} || {{ $item->kecamatan }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <table class="table border table-sm mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td><strong id="nama"></strong></td>
                                                    <td>Kelas</td>
                                                    <td><strong id="kelas"></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Tempat Tanggal Lahir</td>
                                                    <td><Strong id="tetala"></Strong></td>
                                                    <td>Jenis Kelamin</td>
                                                    <td> <strong id="gender"></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>NISN</td>
                                                    <td><strong id="nisn"></strong></td>
                                                    <td>Desa</td>
                                                    <td><strong id="desa"></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Kecamatan</td>
                                                    <td><strong id="kecamatan"></strong></td>
                                                    <td>Nama Ayah</td>
                                                    <td><strong id="nama_ayah"></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Ibu</td>
                                                    <td><strong id="nama_ibu"></strong></td>
                                                    <td>NIK</td>
                                                    <td><strong id="nik"></strong></td>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <button class="btn btn-success w-100 mt-3" onclick="sayaHadir()">Saya Hadir
                                            !</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Import Js Files -->
    <!-- ---------------------------------------------- -->
    <script src="{{ asset('templates/js/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('templates/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ---------------------------------------------- -->
    <!-- core files -->
    <!-- ---------------------------------------------- -->
    <script src="{{ asset('templates/js/app.min.js') }}"></script>
    <script src="{{ asset('templates/js/app.init.js') }}"></script>
    <script src="{{ asset('templates/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('templates/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('templates/js/custom.js') }}"></script>
    <!-- ---------------------------------------------- -->
    <!-- current page js files -->
    <!-- ---------------------------------------------- -->
    <script src="{{ asset('templates/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/js/toastr.js') }}"></script>
    <script src="{{ asset('templates/vendor/select2/js.js') }}"></script>

    <script src="{{ asset('templates/vendor/sweetalert/js.js') }}"></script>
    <script lang="javascript" src="{{ asset('templates/vendor/xlsx/js.js') }}"></script>
    @yield('js')

    <script>
        function toastSuccess(text) {
            toastr.success(
                text,
                "Berhasil!", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    timeOut: 1000
                }
            );
        }

        function toastError(text) {
            toastr.error(
                text,
                "GAGAL !", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    timeOut: 1000
                }
            );
        }
    </script>

    <script>
        var member_id = 0;
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#input_member").select2();
            $('#input_member').on('select2:select', function(e) {
                var data = e.params.data;
                member_id = data.id;
                var url = "{{ route('kehadiran.getMember', ':id') }}";
                url = url.replace(':id', data.id);
                $.post(url,
                    function(response) {
                        $("#nama").html(response.nama)
                        $("#kelas").html(response.kelas)
                        $("#nik").html(response.nik)
                        $("#nisn").html(response.nisn)
                        $("#nama_ayah").html(response.nama_ayah)
                        $("#nama_ibu").html(response.nama_ibu)
                        $("#gender").html(response.gender)
                        $("#desa").html(response.desa)
                        $("#kecamatan").html(response.kecamatan)
                        $("#kelas").html(response.kelas)
                        $("#tetala").html(response.tempat_tanggal_lahir)
                    },
                    "json"
                ).fail(function(response) {
                    console.log(response);
                });
            });

        });

        function sayaHadir() {
            console.log(member_id);
            $.post("{{ route('kehadiran.store') }}", {
                    member_id: member_id
                },
                function(data) {
                    if (data.res == "success") {
                        toastSuccess(data.nama + " " + data.message)
                    } else {
                        toastError(data.nama + " " + data.message)
                    }
                },
                "json"
            ).fail(function(data) {
                toastError(data.nama + " " + data.message)
            });
        }
    </script>
</body>

</html>
