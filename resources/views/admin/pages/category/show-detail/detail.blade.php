@extends('admin.layouts.app')

@push('customCss')
    <!-- Datatable Css -->
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@push('customJs')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <script type="text/javascript">
        new DataTable('#datatable');
    </script>
@endpush
@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Data Kategory</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ route('admin.category') }}">Kategori</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Detail Kategory</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <section class="py-lg-16 py-6">
            <div class="container">
              <div class="row d-flex align-items-bottom">
                  <div>
                    <h1>{{ $product_categories->name }}</h1>
                    <p class="lead mb-3">Deskripsi: {{ $product_categories->description }}</p>
                    <div>
                        <a href="{{ route('admin.category') }}" class="btn btn-primary">Kembali</a>
                    </div>
                  </div>
              </div>
            </div>
        </section>
    </div>
    @endsection
