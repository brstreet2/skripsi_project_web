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
            <nav class="navbar mb-3" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                  <a class="navbar-item" href="https://bulma.io">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                  </a>
              
                  <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
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

          <div class="card has-background-link p-4">
            <div class="columns">
                <div class="column">

                </div>
                <div class="column">
                    <div class="card p-5">
                        <h1 class="title">Login</h1>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </body>
</html>
