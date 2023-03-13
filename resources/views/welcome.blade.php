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
                    <div class="card px-6 py-5">
                        <h1 class="title has-text-weight-bold has-text-centered	mt-5">Daftar Akun</h1>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                              <input class="input" type="text" placeholder="Masukkan Nama Anda">
                            </div>
                          </div>
                          
                          <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left has-icons-right">
                              <input class="input" type="email" placeholder="example@email.com">
                              <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                              </span>
                              <span class="icon is-small is-right">
                                <i class="fas fa-check"></i>
                              </span>
                            </div>
                            {{-- <p class="help is-success">This username is available</p> --}}
                          </div>
                          
                          <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left has-icons-right">
                              <input class="input" type="password" placeholder="Minimal 8 Karakter ">
                              <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                              </span>
                              <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                              </span>
                            </div>
                            {{-- <p class="help is-danger">This email is invalid</p> --}}
                          </div>
                          
                          <div class="field">
                            <div class="control">
                              <label class="checkbox">
                                <input type="checkbox">
                                I agree to the <a href="#">terms and conditions</a>
                              </label>
                            </div>
                          </div>
                          
                          <div class="field has-text-centered mt-5 mb-5">
                            <div class="control">
                              <button class="button is-link is-rounded is-responsive has-text-weight-semibold" style="width: 15rem">Daftar</button>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </body>
</html>
