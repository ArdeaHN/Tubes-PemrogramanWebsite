<!DOCTYPE html>
<html lang="id">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Group-3-capstone">

    <script>
        // Render blocking JS:
        if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
    </script>


    <!-- Libs CSS -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('customCss')
    <style>
        #navbar {
            transition: top 0.75s ease-in-out;
            /* Animasi perubahan posisi */
            position: sticky;
            top: 0;
            /* Sembunyikan navbar ke atas */
            width: 100%;
            z-index: 1000;
            /* Z-index untuk memastikan navbar muncul di atas konten lain */
        }

        .spinner-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s;
        }
    </style>


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
    <title>Home</title>
</head>

<body style="margin-top: 0px;">
    @include('sweetalert::alert')

    <!-- spinner wrapper -->
    <div class="spinner-wrapper bg-body">
        <!-- primary spinner -->
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <main>
        <nav class="navbar navbar-expand-lg" id="navbar">
            @include('layouts.partials.navbar')
        </nav>
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>


    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>


    <script>
        const spinnerWrapperEl = document.querySelector('.spinner-wrapper');

        window.addEventListener('load', () => {
            spinnerWrapperEl.style.opacity = '0';

            setTimeout(() => {
                spinnerWrapperEl.style.display = 'none';
            }, 200);
        });

        var prevScrollpos = window.pageYOffset; /* Mengambil posisi scroll sebelumnya */

        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0"; /* Munculkan navbar saat scroll ke atas */
            } else {
                document.getElementById("navbar").style.top =
                    "-100px"; /* Sembunyikan navbar ke atas saat scroll ke bawah */
            }
            prevScrollpos = currentScrollPos;
        };

        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault()
            let cart_id = $(this).data('id');
            let product_id = $(this).data('product-id');
            let token = "{{ csrf_token() }}";
            let route_path = "{{ route('buyer.cart.delete') }}";

            $.ajax({
                url: route_path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    product_id: product_id,
                    _token: token
                },
                success: function(data) {
                    $('body #navbar').html(data['header'])
                },
                error: function(err) {
                    console.info(err)
                }
            });

        })
    </script>
    @stack('customJs')

</body>

</html>
