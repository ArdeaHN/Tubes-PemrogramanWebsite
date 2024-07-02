    {{-- Modal START --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Pilihan kategori -->
                        <div class="form-group ">
                            <label for="productKategori" class="form-label">Kategori Product</label>
                            <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id">
                                <option value="">Pilih Kategori</option>
                                @foreach ($product_categories as $category_id)
                                    <option value="{{ $category_id->id }}">{{ $category_id->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="productName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="productDescription" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="productStock" name="stock">
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="productPrice" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="productWeight" class="form-label">Berat</label>
                            <input type="number" class="form-control" id="productPrice" name="weight">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" id="productImage" name="image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
