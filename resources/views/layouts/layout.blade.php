<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- CSS --}}
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container-fluid">
      {{-- Navbar --}}
      <nav class="navbar fixed-top navbar-expand-lg bg-light navbar-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand mx-1" href="#"><h5>Skripsi</h5></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                    <a class="nav-item nav-link mx-1" href="#"><span>Beranda</span></a>
                    <a class="nav-item nav-link mx-1" href="#"><span>Tentang</span></a>
                    <a class="nav-item nav-link mx-1" href="#"><span>Produk</span></a>
                    <a class="nav-item nav-link mx-1" href="#"><span>Kontak</span></a>
                </div>
                <a class="nav-item nav-link" href="#"><button type="button" class="btn btn-primary px-4">Login</button></a>
              </div>
            </div>
      </nav>
        {{--  --}}

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