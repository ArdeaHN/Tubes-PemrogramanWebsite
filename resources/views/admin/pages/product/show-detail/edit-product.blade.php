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
                            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('admin.product.index') }}">Produk</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Nama Produk -->
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="editProductName" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="editProductName" name="name" value="{{ $product->name }}">
            </div>
        </div>

        <!-- Pilihan Kategori -->
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="editProductName" class="form-label"> Kategori Produk</label>
                <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id">
                    <option value="{{ $product->category_id }}" selected>
                        {{ $product->category->name }}
                    </option>
                    @foreach ($product_categories as $category_id)
                        <option value="{{ $category_id->id }}">{{ $category_id->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="editProductDescription" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="editProductDescription" name="description" value="{{ $product->description }}">
            </div>
        </div>

        <!-- Stock -->
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="editProductStock" class="form-label">Stock</label>
                <input type="text" class="form-control" id="editProductStock" name="stock" value="{{ $product->stock }}">
            </div>
        </div>

        <!-- Harga -->
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="editProductPrice" class="form-label">Harga</label>
                <input type="text" class="form-control" id="editProductPrice" name="price" value="{{ $product->price }}">
            </div>
        </div>

        <!-- Berat -->
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="editProductWeight" class="form-label">Berat</label>
                <input type="text" class="form-control" id="editProductWeight" name="weight" value="{{ $product->weight }}">
            </div>
        </div>

        <!-- Gambar Produk -->
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="editProductImage" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="editProductImage" name="image">
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </div>
</form>

</section>
@endsection
