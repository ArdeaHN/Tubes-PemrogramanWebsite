@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.index') }}">User</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-0 mt-md-4">
        <div class="col-lg-3 col-md-4 col-12">
            <!-- Side navbar -->
            <nav class="navbar navbar-expand-md shadow-sm mb-4 mb-lg-0 sidenav">
                <!-- Menu -->
                <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
                <!-- Button -->
                <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="fe fe-menu"></span>
                </button>
                <!-- Collapse navbar -->
                <div class="collapse navbar-collapse" id="sidenav">
                    <div class="navbar-nav flex-column">
                        <span class="navbar-header">Pengaturan Akun</span>
                        <!-- List -->
                        <ul class="list-unstyled ms-n2 mb-0">
                            <!-- Nav item -->
                            <li class="nav-item {{ Request::routeIs('admin.user.show') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.user.show', $user) }}">
                                    <i class="fe fe-user nav-icon"></i>
                                    Detail Profile
                                </a>
                            </li>
                            <!-- Nav item -->
                            <li class="nav-item {{ Request::routeIs('admin.user.show.invoice') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('admin.user.show.invoice', $user) }}">
                                    <i class="fe fe-clipboard nav-icon"></i>
                                    Invoice
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9 col-md-8 col-12">
            <!-- Card -->
            @yield('card')

        </div>
    </div>
@endsection
