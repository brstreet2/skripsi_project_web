@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col mb-2 ">
            <div class="card border-0" style="border-radius: 2rem">
                <div class="row g-0">
                    <div class="col">
                        <div class="card px-4 py-3 border-0" style="border-radius: 1rem">
                            <h3 class="text-center mt-5 daftarakun">Reset Password</h3>
                            </h6>
                            <div class="row g-0 mt-3">
                                <div class="col">

                                </div>
                                <div class="col-10">
                                    <form method="POST" action="{{ route('auth.login.post') }}">
                                        {{ csrf_field() }}
                                        <label for="inputPassword" class="mb-1">Password Baru</label>
                                        <div class="form-group mb-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="inputPassword" placeholder="Minimal 8 Karakter"
                                                    required style="border-radius: .75rem 0 0 .75rem">
                                                <button class="btn btnprimary" type="button" id="basic-addon2"
                                                    style="border-radius: 0 .75rem .75rem 0"
                                                    onclick="password_show_hide();">
                                                    <i class="fa-regular fa-eye" id="show_eye"></i>
                                                    <i class="fa-regular fa-eye-slash d-none" id="hide_eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <label for="inputPassword2" class="mb-1">Ulangi Password</label>
                                        <div class="form-group mb-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="inputPassword2" placeholder="Pastikan Password Sama" style="border-radius: .75rem" required>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="row mt-5 mb-5">
                                            <div class="col-2"></div>
                                            <div class="col d-grid"><button type="submit" id="submitBtn"
                                                    class="btn btn-block btnprimary rounded-pill"
                                                    style="font-weight: 700;
                                            height: 3rem;">Simpan</button>
                                            </div>
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
