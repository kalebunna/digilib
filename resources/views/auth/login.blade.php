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
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="../../dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="../../dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative radial-gradient min-vh-100 overflow-hidden">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="./index.html" class="text-nowrap logo-img d-block w-100 px-4 py-9">
                            <img src="../../dist/images/logos/dark-logo.svg" width="180" alt="">
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="{{ asset('templates/images/login-security.svg') }}" alt=""
                                class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                <h2 class="fs-7 fw-bolder mb-3">Welcome to Digilib</h2>
                                <p class="mb-9">Login As Petugas</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="text-md-end">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="text-md-end">{{ __('Password') }}</label>

                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 rounded-2 mb-4 py-8">
                                        {{ __('Login') }}
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>

</html>
