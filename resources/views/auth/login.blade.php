@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-2">

  </div>
  <div class="col mb-2 ">
      <div class="card border-0" style="border-radius: 2rem">
          <div class="row g-0">
              <div class="col-5">
                <div class="card registerimg border-0 justify-content-center" style="border-radius: 1rem 0 0 1rem">
                  <div class="row g-0">
                      <div class="col-1 p-0"></div>
                  <div class="col">
                      <div class="card glassmorphism align-self-center text-left p-4">
                          <h4 class="mb-4" style="font-weight: 700; color:#fcfcfc">Sistem HR Terbaik, <br>Ada Disini</h4>
                          <p style="color:#fcfcfc">Penyedia aplikasi sistem Manajemen Sumber Daya Manusia terbaik </p>
                      </div>
                  </div>
                  <div class="col-1 p-0"></div>
                  </div>
                </div>
              </div>
              <div class="col">
                  <div class="card px-4 py-3 border-0" style="border-radius: 0 1rem 1rem 0">
                      <h3 class="text-center mt-5 mb-2 daftarakun">Masuk</h3>
                      <p class="text-center mb-4">Belum memiliki akun? Daftar <a style="text-decoration:underline; font-weight:700; color:#444EFF">disini</a></p></h6>
                      <div class="row g-0">
                          <div class="col">

                          </div>
                          <div class="col-10">
                              <form method="POST" action="{{ route('auth.register.post') }}">
                       
                                   
                                      <div class="form-group mb-3">
                                        <label for="inputEmail" class="mb-1">Email</label>
                                        <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp" placeholder="example@email.com" style="border-radius: .75rem">
                                      </div>
                                      <div class="form-group mb-3 ">
                                        <label for="inputPassword" class="mb-1">Password</label>
                                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Minimal 8 Karakter" style="border-radius: .75rem">
                                      </div>
                                      <div class="form-check mb-5">
                                        <input type="checkbox" class="form-check-input" id="termCondition">
                                        <small class="form-check-label" for="exampleCheck1" style="font-style: italic">Ingat Akun Saya</small>
                                      </div>
                                   
                                      <div class="row mb-5">
                                          <div class="col-2"></div>
                                          <div class="col d-grid"><button type="submit" id="submitBtn" class="btn btn-block btnprimary rounded-pill"
                                            style="font-weight: 700;
                                            height: 3rem;">Masuk</button></div>
                                          <div class="col-2"></div>
                                      </div>
                                </form>
                          </div>
                          <div class="col">

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-2">

  </div>
</div>
@endsection
