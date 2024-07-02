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
                            <li class="breadcrumb-item" aria-current="page">Edit Kategory</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('admin.category.update', ['id' => $product_categories->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Kategory</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $product_categories->name }}" placeholder="enter category">
                            <br>
                            <label for="description" class="form-label">Deskripsi</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ $product_categories->description }}" placeholder="enter description">
                            @error('product_category')
                                <div class="alert alert_danger" style="margin-top: 10px">{{ $message }}</div>
                            @enderror
                            @error('description')
                                <div class="alert alert_danger" style="margin-top: 10px">{{ $message }}</div>
                            @enderror
                        </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
