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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.product.index') }}">Product</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="py-lg-16 py-6">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class=" col-xxl-5  col-xl-6 col-lg-6 col-12">
          <div>
            <h1 class="display-2 fw-bold mb-3">{{ $product->name }}</span></u></h1>
            <p class="lead mb-4">Kategori: {{ $product->category->name }}</p>
            <p class="lead mb-4">Price: {{ $product->price }}</p>
            <p class="lead mb-4">Stock: {{ $product->stock }}</p>
            <p class="lead mb-4">Berat: {{ $product->weight }} Gr</p>
            <p class="lead mb-4">Description: {{ $product->description }}</p>
            <div>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Kembali</a>
            </div>
          </div>
        </div>
        <div class="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6 col-12 d-lg-flex justify-content-end">
          <div class="mt-12 mt-lg-0 position-relative">
            <img src="{{ asset('storage/' . $product->image) }}" alt="online course" class="img-fluid rounded-4 w-100 z-1 position-relative">
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
