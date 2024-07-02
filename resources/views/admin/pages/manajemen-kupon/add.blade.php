@extends('admin.layouts.app')

@push('customCss')
@endpush
@push('customJs')
    <script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/flatpickr.js') }}"></script>
    @include('admin.pages.manajemen-kupon.scripts._index-script');
@endpush

@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Tambah Data Kupon</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('coupon.index') }}">Kupon</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('coupon.index') }}" class="btn btn-secondary"><i class="fe fe-arrow-left-circle"></i>
                        Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12 text-break">
            @include('generals._validation')
        </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <form action="{{ route('coupon.store') }}" method="post">
            @csrf

            <div class="d-flex flex-wrap col-12">

                <!-- Input -->
                <div class="px-2 col-12 col-md-6  col-xl-4">
                    <div class="mb-3 ">
                        <label class="form-label" for="codeInput">Kode</label>
                        <input name="code" type="text" id="codeInput" class="form-control"
                            placeholder="cth. KUPON-PEDAS">
                    </div>
                </div>
                <!-- Select Option -->
                <div class="px-2 col-12 col-md-6 col-xl-4">

                    <div class="mb-3 ">
                        <label class="form-label" for="selectType">Tipe Kupon</label>
                        <select class="form-select" aria-label="Default select example" name="type" id="typeCoupon">
                            <option selected>--> Pilih Tipe <-- </option>
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                        </select>
                    </div>
                </div>
                <div class="px-2 col-12 col-md-6 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="valueInput">Nilai</label>
                        <input name="value" type="text" id="valueInput" class="form-control" placeholder="cth. 100">
                    </div>
                </div>

                <div class="px-2 col-12 col-md-6 col-xl-4">
                    <!-- Input -->
                    <div class="mb-3">
                        <label class="form-label" for="maxUserUsesInput">Maksimal Klaim Satu User</label>
                        <input name="max_uses_user" type="number" id="codeInput" class="form-control" placeholder="1">
                    </div>
                </div>

                <div class="px-2 col-12 col-md-6 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="maxUsesInput">Total Kupon</label>
                        <input name="max_uses" type="number" id="codeInput" class="form-control" placeholder="1">
                    </div>
                </div>
                <div class="px-2 col-12 col-md-6 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="startInput">Mulai Berlaku</label>
                        <input type="text" class="form-control flatpickr flatpickr-input" name="start_date"
                            placeholder="">
                    </div>
                </div>
                <div class="px-2 col-12 col-md-6 col-xl-4">
                    <div class="mb-3">
                        <label class="form-label" for="expirationInput">Mulai Berlaku</label>
                        <input type="text" class="form-control flatpickr flatpickr-input" name="expiration_date"
                            placeholder="">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end px-2">
                    <div>
                        <button type="reset" class="btn btn-secondary"><i class="fe fe-refresh-ccw"></i> Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
