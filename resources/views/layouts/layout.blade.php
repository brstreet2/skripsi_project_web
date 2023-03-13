<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    {{-- CSS --}}
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container is-fluid">
      {{-- Navbar --}}
        <nav class="navbar mb-3" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                    data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item">
                        Beranda
                    </a>

                    <a class="navbar-item">
                        Tentang
                    </a>

                    <a class="navbar-item">
                        Produk
                    </a>

                    <a class="navbar-item">
                        Kontak
                    </a>

                    <div class="buttons ml-5">
                        <a class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                    </div>

                </div>
            </div>

        </nav>
        {{--  --}}

        {{-- Section --}}
        @yield('content')
    </div>
</body>
    {{-- JQuery 3.6.4 --}}
    <script
    src="https://code.jquery.com/jquery-3.6.4.js"
    integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>

    @stack('scripts')

</html>