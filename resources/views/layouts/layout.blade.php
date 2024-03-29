<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" />

    <title>TimKerjaKu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('index.css') }}">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    {{-- icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    
    {{-- landing page --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.1.0/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">


    

</head>

<body>
    <div class="container-fluid">
        {{-- Navbar --}}
        <nav class="navbar navigation fixed-top navbar-expand-lg navbar-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand  title mx-1 fw-bold text-light" href="{{ route('home') }}"><img alt="logo"
                        src="/assets/logo.png" width="30" height="30" class="d-inline-block align-top" />
                    TimKerjaKu</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item  title nav-link mx-1 navbarhover" href="{{ route('home') }}"
                            style="color: #fcfcfc"><span>Beranda</span></a>
                        <a class="nav-item  title nav-link mx-1 navbarhover" id="tentang" href="#tentangkami "
                            style="color: #fcfcfc"><span>Tentang</span></a>
                        <a class="nav-item  title nav-link mx-1 navbarhover" id="produk" href="#produkkami"
                            style="color: #fcfcfc"><span>Produk</span></a>
                        <a class="nav-item  title nav-link mx-1 navbarhover" id="kontak" href="#"
                            style="color: #fcfcfc"><span>Kontak</span></a>
                    </div>
                    @if (!Sentinel::getUser())
                        <a class="nav-item nav-link" href="{{ route('auth.login.form') }}"><button type="button"
                                class="btn px-4 rounded-pill"
                                style="background-color: #FBF8FF; font-weight:700; width:7rem;">Masuk</button></a>
                    @else
                        <a class="nav-item nav-link" href="{{ route('dashboard.index') }}"><button type="button"
                                class="btn px-4 rounded-pill"
                                style="background-color: #FBF8FF; font-weight:700;">Dashboard</button></a>
                    @endif
                </div>
            </div>
        </nav>
        {{--  --}}
    </div>
    <div class="container">
        {{-- Section --}}
        <div class="content" style="margin-top: 5rem">
            @yield('content')
        </div>
    </div>
</body>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>

{{-- JQuery 3.6.4 --}}
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

{{-- landing page --}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js" integrity="sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.1.0/swiper-bundle.min.js" integrity="sha512-4Ooh3fl4STrmn95ZbS/J6l8csp/FvSKPaeDAH/IaPQGJIx9lmpuxXZTCYKR2W5+Bt7i74exPvAT2PsWnac+sow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stack('scripts')

</html>
