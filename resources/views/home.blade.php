@extends('layouts.app')

@push('customCss')
    <link href="assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet">
@endpush
@push('customJs')
    <script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>

    <script src="{{ asset('assets/js/vendors/tnsSlider.js') }}"></script>
    <!-- Add to cart -->
    <script type="text/javascript">
        $(document).on('click', '.add_to_cart', function(e) {
            e.preventDefault();
            let product_id = $(this).data('product-id');
            let quantity = $(this).data('quantity');

            let token = "{{ csrf_token() }}";
            let route_path = "{{ route('buyer.cart.store') }}";

            $.ajax({
                url: route_path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    quantity: quantity,
                    _token: token
                },
                beforeSend: function() {
                    $('#add_to_cart' + product_id).html('<i class="fe fe-loader"></i>')
                },
                complete: function() {
                    $('#add_to_cart' + product_id).html('<i class="fe fe-shopping-cart"></i>')
                },
                success: function(data) {
                    console.log(data)
                    $('body #navbar').html(data['header'])
                }
            });
        });
    </script>
@endpush
@section('content')
    <section class="py-lg-16 py-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class="col-lg-6 mb-6 mb-lg-0">
                    <div class="">
                        <!-- heading -->
                        <h5 class="text-dark mb-4"><i
                                class="fe fe-check icon-xxs icon-shape  text-success rounded-circle me-2"></i>Zemilan
                            Keripik Baso Goreng</h5>
                        <!-- heading -->
                        <h1 class="display-3 fw-bold mb-3">Zemilan Keripik Baso Goreng</h1>
                        <!-- para -->
                        <p class="pe-lg-10 mb-5">Selamat Datang di Zemilan Keripik Baso Goreng! Rasakan Sensasi Nikmat
                            Keripik Baso Goreng Kami Kualitas Terbaik, Harga Terjangkau.</p>
                        <!-- btn -->
                        <a href="{{ route('catalog') }}" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
                <!-- col -->
                <div class="col-lg-6 d-flex justify-content-center justify-content-md-end">
                    <!-- images -->
                    <div class=" col-12 col-md-9">
                        <img src="{{ asset('assets/images/background/coba1.JPG') }}" alt=""
                            class="rounded-circle img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-lg-12 pb-lg-3 pb-6 pt-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <h4 class="mb-0">Produk Favorit</h4>
                </div>
            </div>
            <div class="position-relative">
                <ul class="controls" id="sliderFirstControls">
                    <li class="prev">
                        <i class="fe fe-chevron-left"></i>
                    </li>
                    <li class="next">
                        <i class="fe fe-chevron-right"></i>
                    </li>
                </ul>
                <div class="sliderFirst">
                    @foreach ($products as $product)
                        <div class="item">
                            <!-- Medium-sized Card -->
                            <div class="card card-hover mb-4">
                                <img src="{{ asset('storage/' . $product->image) ?? 'https://source.unsplash.com/480x480?food' }}"
                                    alt="" class="card-img-top">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <a href="#" class="fs-5"><i class="fe fe-heart align-middle"></i></a>
                                    </div>
                                    <h4 class="mb-2 text-truncate">{{ $product->name }}</h4>
                                    <small>Stock: {{ $product->stock }}</small>
                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <h5 class="mb-0">Rp. {{ $product->price }}</h5>
                                        <div class="d-flex gap-2">
                                            <div>
                                                <button type="button" data-product-id="{{ $product->id }}"
                                                    data-quantity="1" class="btn btn-primary add_to_cart"
                                                    id="add_to_cart{{ $product->id }}">
                                                    <i class="fe fe-shopping-cart text-white align-middle"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('order.store', $product) }}" method="post">
                                                <div>
                                                    @csrf
                                                    <button type="submit" class="btn  btn-success ml-2"
                                                        onclick="checkoutNow({{ $product->id }})">
                                                        Beli
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>
@endsection
