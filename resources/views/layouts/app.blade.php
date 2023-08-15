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
    <!-- --------------------------------------------------- -->
    <!-- Core Css -->
    <!-- --------------------------------------------------- -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('templates/css/style.min.css') }}">
    <!-- --------------------------------------------------- -->
    @yield('style')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="favicon.ico" alt="loader" class="lds-ripple img-fluid">
    </div>
    <!-- --------------------------------------------------- -->
    <!-- Body Wrapper -->
    <!-- --------------------------------------------------- -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- --------------------------------------------------- -->
        <!-- Sidebar -->
        <!-- --------------------------------------------------- -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <h3>Digilib Nasa</h3>
                    </a>
                    <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8 text-muted"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                @include('layouts.sidebar')

            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- --------------------------------------------------- -->
        <!-- Main Wrapper -->
        <!-- --------------------------------------------------- -->
        <div class="body-wrapper">
            @include('layouts.header')
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- ---------------------------------------------- -->
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
</body>

</html>
