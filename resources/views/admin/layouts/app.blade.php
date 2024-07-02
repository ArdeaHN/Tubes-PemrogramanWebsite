<!DOCTYPE html>
<html lang="id">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <script>
        // Render blocking JS:
        if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
    </script>

    <!-- Libs CSS -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">



    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">

    <style>
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
    @stack('customCss')
    <title>Home</title>
</head>

<body>
    @include('sweetalert::alert')

    <!-- spinner wrapper -->
    <div class="spinner-wrapper bg-body">
        <!-- primary spinner -->
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <main id="db-wrapper">
        @include('admin.layouts.partials.sidebar')

        <section id="page-content">

            @include('admin.layouts.partials.navbar')


            <div class="container-fluid p-4">

                @yield('content')

            </div>
        </section>

    </main>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>


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
        const header = document.querySelector('#navbar');
        const headerHeight = header.offsetHeight; // Mengambil tinggi header
        const navbarVertical = document.querySelector('.navbar-vertical');
        window.addEventListener('scroll', function() {
            const {
                scrollY
            } = window;

            if (scrollY > headerHeight) {
                header.classList.add('fixed-top'); // Menambahkan kelas fixed-top saat di-scroll ke bawah
                navbarVertical.style.marginTop = headerHeight + 'px';
            } else {
                header.classList.remove('fixed-top'); // Menghapus kelas fixed-top saat kembali ke atas
                navbarVertical.style.marginTop = '0';
            }
        });
    </script>
    @stack('customJs')
</body>

</html>
