<!-- --------------------------------------------------- -->
<!-- Header Start -->
<!-- --------------------------------------------------- -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>
        <div class="navbar-collapse justify-content-end collapse" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
                <ul class="navbar-nav align-items-center justify-content-center ms-auto flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-bell-ringing"></i>
                            <div class="notification bg-primary rounded-circle"></div>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop2">
                            <div class="d-flex align-items-center justify-content-between px-7 py-3">
                                <h5 class="fs-5 fw-semibold mb-0">Notifications</h5>
                                <span class="badge bg-primary rounded-4 lh-sm px-3 py-1">5 new</span>
                            </div>
                            <div class="message-body" data-simplebar="">
                            </div>
                            <div class="mb-1 px-7 py-6">
                                <button class="btn btn-outline-primary w-100"> See All Notifications
                                </button>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="user-profile-img">
                                    <img src="{{ asset('templates/images/user-1.jpg') }}" class="rounded-circle"
                                        width="35" height="35" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1">
                            <div class="profile-dropdown position-relative" data-simplebar="">
                                <div class="px-7 py-3 pb-0">
                                    <h5 class="fs-5 fw-semibold mb-0">User Profile</h5>
                                </div>
                                <div class="d-flex align-items-center border-bottom mx-7 py-9">
                                    <img src="images/user-1.jpg" class="rounded-circle" width="80" height="80"
                                        alt="">
                                    <div class="ms-3">
                                        <h5 class="fs-3 mb-1">{{ auth()->user()->name }}</h5>
                                        <span class="d-block text-dark mb-1">Petugas</span>
                                        <p class="d-flex text-dark align-items-center mb-0 gap-2">
                                            <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                </div>

                                <div class="d-grid px-7 py-4 pt-8">
                                    <a href="{{ route('logout') }}" class="btn btn-outline-primary"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- --------------------------------------------------- -->
<!-- Header End -->
<!-- --------------------------------------------------- -->
