@extends('layouts.app')
@push('customCss')
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
@endpush
@push('customJs')
    <script src="{{ asset('assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

    <script>
        $(document).on('click', '#apply-coupon', function(e) {
            e.preventDefault();

            const code = $('input[name=code]').val();

            $.ajax({
                url: "{{ route('coupon.apply') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    code: code,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#apply-coupon').html('<i class="fe fe-loader"></i> PROSES....');
                },
                success: function(response) {
                    $('#apply-coupon').html('Klaim');

                    if (response.status == false) {
                        $('#codeInput').addClass('is-invalid')
                        $('.invalid-feedback').html(response.message)
                    }
                    if (response.status == true) {
                        $('#couponCode').html(`( ${response.code}) `)
                        if (response.discount > 0) {
                            $('#discountAmount').html(response.discount)
                        } else {
                            $('#discountAmount').html('0')
                        }

                        if (response.grand_total > 0) {
                            $('#grandTotal').html(response.grand_total.toLocaleString('id-ID', {
                                minimumFractionDigits: 0
                            }));
                        } else {
                            $('#grandTotal').html('0')
                        }

                    }
                },
                error: function(err) {
                    alert(err);
                }
            });

        });
    </script>
@endpush
@section('content')
    @if (App\Models\CartItem::getCount() > 0)
        <section class="container-fluid p-4">
            <div class="row ">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Page header -->
                    <div class="border-bottom pb-3 mb-3 ">
                        <div class="mb-2 mb-lg-0">
                            <h1 class="mb-0 h2 fw-bold">Shopping Cart </h1>

                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12 mb-2">
                    <!-- alert -->
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Gunakan Kode Kupon <strong>(ZMPO15%)</strong> dan dapatkan diskon 10% !
                    </div>
                </div>
                <div class="col-lg-8">
                    <!-- card -->
                    <div class="card">
                        <!-- card header -->
                        <div class="card-header">
                            <div class="d-flex ">
                                <!-- heading -->
                                <h4 class="mb-0">Shopping Cart <span
                                        class="text-muted ">({{ App\Models\CartItem::getCount() }} Items)</span> </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->

                                        @foreach (Auth::user()->cartItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div>
                                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                                alt="" class="img-4by3-md rounded">
                                                        </div>
                                                        <div class="ms-4 mt-2 mt-lg-0">
                                                            <h4 class="mb-1 text-primary-hover">
                                                                {{ $item->product->name }}
                                                            </h4>
                                                            <div> <span>Berat: <span class="text-dark fw-medium">100
                                                                        gr</span>
                                                            </div>
                                                            <div class="mt-4">
                                                                <a href="#" class="text-body ms-3"><i
                                                                        class="fe fe-trash"></i> Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h4 class="mb-0">Rp
                                                        {{ number_format($item->product->price, 0, '.', '.') }}
                                                    </h4>
                                                </td>
                                                <td>
                                                    <div class="input-group  flex-nowrap justify-content-center ">
                                                        <input type="button" value="-"
                                                            class="button-minus form-control  text-center flex-xl-none w-xl-30 w-xxl-10 px-0 py-1 "
                                                            data-field="quantity">
                                                        <input type="number" step="1" max="10"
                                                            value="{{ $item->quantity }}" name="quantity"
                                                            class="quantity-field form-control text-center flex-xl-none w-xl-30 w-xxl-10 px-0 py-1">
                                                        <input type="button" value="+"
                                                            class="button-plus form-control  text-center flex-xl-none w-xl-30  w-xxl-10 px-0 py-1 "
                                                            data-field="quantity">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h4 class="mb-0">Rp
                                                        {{ number_format($item->product->price * $item->quantity, 0, '.', '.') }}
                                                    </h4>
                                                </td>
                                            </tr>
                                        @endforeach


                                        <tr>
                                            <td class="align-middle border-top-0 border-bottom-0 ">
                                            </td>
                                            <td class="align-middle border-top-0 border-bottom-0 ">
                                                <h4 class="mb-0">Total</h4>
                                            </td>
                                            <td class="align-middle border-top-0 border-bottom-0 text-center ">
                                                <span class="fs-4">{{ App\Models\CartItem::getCount() }}
                                                    (items)</span>

                                            </td>
                                            <td>
                                                <h4 class="mb-0">Rp
                                                    {{ number_format(App\Models\CartItem::getSubTotal(Auth::user()), 0, '.', '.') }}
                                                </h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('catalog') }}" class="btn btn-outline-primary">Kembali Berbelanja</a>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- card -->
                    <div class="card mb-4 mt-4 mt-lg-0">
                        <!-- card body -->
                        <div class="card-body">
                            <h4 class="mb-3">Tambahkan Kupon</h4>
                            <!-- row -->
                            <div class="row g-3">
                                <!-- col -->
                                <div class="col">
                                    <input type="text" class="form-control" id="codeInput" name="code"
                                        placeholder="GKDIS15%">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <!-- col -->
                                <div class="col-auto">
                                    <button id="apply-coupon" class="btn btn-dark">Klaim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- text -->
                            <h4 class="mb-3">Order Summary</h4>
                            <!-- list group -->
                            <ul class="list-group list-group-flush">
                                <!-- list group item -->
                                <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">
                                    <span>Sub Total :</span>
                                    <span>Rp
                                        {{ number_format(App\Models\CartItem::getSubTotal(Auth::user()), 0, '.', '.') }}</span>
                                </li>
                                <!-- list group item -->
                                <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">
                                    <span>Discount <span class="text-muted" id="couponCode">
                                            @if (Session::has('couponCode'))
                                                {{ Session::get('couponCode') }}
                                            @endif
                                        </span>: </span>
                                    <span>-Rp <span id='discountAmount'>
                                            @if (Session::has('discount'))
                                                {{ Session::get('discount') }}
                                            @else
                                                0
                                            @endif

                                        </span></span>
                                </li>


                            </ul>
                        </div>
                        <!-- card footer -->
                        <div class="card-footer">
                            <div class=" px-0 d-flex justify-content-between fs-5 text-dark fw-semibold">
                                <span>Total (RUPIAH)</span>
                                <span>Rp <span id="grandTotal">
                                        @if (Session::has('grandTotal'))
                                            {{ number_format(Session::get('grandTotal'), 0, '.', '.') }}
                                        @else
                                            {{ number_format(App\Models\CartItem::getSubTotal(Auth::user()), 0, '.', '.') }}
                                        @endif

                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="container-fluid py-4">
            <div style="min-height: 70vh">
                <h5 class="text-center mt-10">-- Keranjangmu Kosong --</h5>
            </div>
        </div>
    @endif
@endsection
