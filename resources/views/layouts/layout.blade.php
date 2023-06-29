<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- CSS --}}
    <link rel="stylesheet" href="index.css">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    {{-- icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
  </head>

<body>
    <div class="container-fluid">
      {{-- Navbar --}}
      <nav class="navbar fixed-top navbar-expand-lg navbar-light mb-4" style="background-color: transparent">
        <div class="container-fluid">
            <a class="navbar-brand mx-1" href="/home  "><h5 class="fw-bold text-white">TimKerjaKu</h5></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                    <a class="nav-item nav-link mx-1 navbarhover" href="/home" style="color: #fcfcfc"><span>Beranda</span></a>
                    <a class="nav-item nav-link mx-1 navbarhover" id="tentang" href="#tentangkami" style="color: #fcfcfc"><span>Tentang</span></a>
                    <a class="nav-item nav-link mx-1 navbarhover" id="produk" href="#produkkami" style="color: #fcfcfc"><span>Produk</span></a>
                    <a class="nav-item nav-link mx-1 navbarhover" id="kontak" href="#" style="color: #fcfcfc"><span>Kontak</span></a>
                </div>
                
                <a class="nav-item nav-link" href="{{ route('auth.login.form') }}"><button type="button" class="btn px-4 rounded-pill" style="background-color: #FBF8FF; font-weight:700; width:7rem;">Login</button></a>
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
    {{-- JQuery 3.6.4 --}}
    <script
    src="https://code.jquery.com/jquery-3.6.4.js"
    integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    @stack('scripts')

</html>