{{-- Modal START --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Kategory</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="enter category">
                            <br>
                            <label for="description" class="form-label">Deskripsi</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="enter description">
                            @error('name')
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
</div>
