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

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

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
    <title> {{ $title }}
    </title>
</head>

<body style="margin-top: 0px;">
    <!-- spinner wrapper -->
    <div class="spinner-wrapper bg-body">
        <!-- primary spinner -->
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <script>
        const spinnerWrapperEl = document.querySelector('.spinner-wrapper');

        window.addEventListener('load', () => {
            spinnerWrapperEl.style.opacity = '0';

            setTimeout(() => {
                spinnerWrapperEl.style.display = 'none';
            }, 200);
        });
    </script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
</body>

</html>
