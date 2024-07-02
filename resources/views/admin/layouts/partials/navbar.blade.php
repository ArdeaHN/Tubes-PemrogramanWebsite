<div class="header">
    <!-- navbar -->
    <nav class="navbar-default navbar navbar-expand-lg" id="navbar">
        <a id="nav-toggle" href="#">
            <i class="fe fe-menu"></i>
        </a>
        <div class="ms-lg-3 d-none d-md-none d-lg-block">
            <!-- Form -->
            <form class="d-flex align-items-center">
                <span class="position-absolute ps-3 search-icon">
                    <i class="fe fe-search"></i>
                </span>
                <input type="search" class="form-control ps-6" placeholder="Cari...">
            </form>
        </div>
        <!--Navbar nav -->
        <div class="ms-auto d-flex">
            <a href="#" class="form-check form-switch theme-switch btn btn-light btn-icon rounded-circle ">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault"></label>

            </a>
            @auth
                <ul class="navbar-nav navbar-right-wrap ms-2 d-flex nav-top-wrap">
                    <li class="dropdown stopevent">
                        <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted"
                            href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fe fe-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg"
                            aria-labelledby="dropdownNotification">
                            <div>
                                <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                                    <span class="h4 mb-0">Notifikasi</span>
                                    <a href="# " class="text-muted">
                                        <span class="align-middle">
                                            <i class="fe fe-settings me-1"></i>
                                        </span>
                                    </a>
                                </div>
                                <!-- List group -->
                                <ul class="list-group list-group-flush" data-simplebar style="max-height: 300px;">
                                    <li class="list-group-item bg-light">
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-body" href="#">
                                                    <div class="d-flex">
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Promo</h5>
                                                            <p class="mb-3">
                                                                Wow ada promo untuk keripik udang
                                                            </p>
                                                            <span class="fs-6 text-muted">2
                                                                jam yang lalu,</span>
                                                            <span class="ms-1">2:19 PM</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-auto text-center me-2">
                                                <a href="#" class="badge-dot bg-info" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Mark as read">
                                                </a>
                                                <div>
                                                    <a href="#" class="bg-transparent" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Remove">
                                                        <i class="fe fe-x text-muted"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-body" href="#">
                                                    <div class="d-flex">
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Dalam Perjalanan</h5>
                                                            <p class="mb-3">
                                                                Pesanan keripik udangmu sudah diserahkan ke kurir
                                                            </p>
                                                            <span class="fs-6 text-muted">2
                                                                jam yang lalu,</span>
                                                            <span class="ms-1">2:19 PM</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-auto text-center me-2">
                                                <a href="#" class="badge-dot bg-info" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Mark as read">
                                                </a>
                                                <div>
                                                    <a href="#" class="bg-transparent" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Remove">
                                                        <i class="fe fe-x text-muted"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border-top px-3 pt-3 pb-0">
                                    <a href="#" class="text-link fw-semibold">
                                        Lihat Semua
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- List -->
                    <li class="dropdown ms-2">
                        <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ asset('assets/images/avatar/avatar-dummy.png') }}"
                                    class="rounded-circle">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                            <div class="dropdown-item">
                                <div class="d-flex">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="{{ asset('assets/images/avatar/avatar-dummy.png') }}"
                                            class="rounded-circle">
                                    </div>
                                    <div class="ms-3 lh-1">
                                        <h5 class="mb-1">{{ Auth::user()->first_name }}</h5>
                                        <p class="mb-0 text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fe fe-user me-2"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fe fe-settings me-2"></i> Pengaturan
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled">
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">

                                            <i class="fe fe-power me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            @endauth
        </div>
    </nav>
</div>
