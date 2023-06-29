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
                          <h4 class="mb-4" style="font-weight: 700; color:#fcfcfc">TimKerjaKu</h4>
                          <p style="color:#fcfcfc">Aplikasi Sistem Pengelolaan Sumber Daya Manusia</p>
                      </div>
                  </div>
                  <div class="col-1 p-0"></div>
                  </div>
                </div>
              </div>
              <div class="col">
                  <div class="card px-4 py-3 border-0" style="border-radius: 0 1rem 1rem 0">
                      <h3 class="text-center mt-5 mb-2 daftarakun">Masuk</h3>
                      <p class="text-center mb-4">Belum memiliki akun? Daftar <a href="{{ route('auth.register.form') }}" style="text-decoration:underline; font-weight:700; color:#444EFF">disini</a></p></h6>
                      <div class="row g-0">
                          <div class="col">

                          </div>
                          <div class="col-10">
                              <form method="POST" action="{{ route('auth.login.post') }}">
                                  {{ csrf_field() }}
                                <div class="form-group mb-3">
                                  <label for="inputEmail" class="mb-1">Email</label>
                                  <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp" placeholder="example@email.com" style="border-radius: .75rem">
                                </div>
                                
                                <label  abel for="inputPassword" class="mb-1">Password</label>
                                <div class="form-group mb-3">
                                  <div class="input-group flex-nowrap">
                                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Minimal 8 Karakter" style="border-radius: .75rem 0 0 .75rem">
                                        <button class="btn btnprimary" type="button" id="basic-addon2" style="border-radius: 0 .75rem .75rem 0" onclick="password_show_hide();">
                                            <i class="fa-regular fa-eye" id="show_eye"></i>
                                            <i class="fa-regular fa-eye-slash d-none" id="hide_eye"></i>
                                        </button>
                                  </div>
                                </div>
                                    
                                      
                                      <div class="form-check mb-5">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
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
<script>
function password_show_hide() {
  var x = document.getElementById("inputPassword");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
</script>

@endsection
