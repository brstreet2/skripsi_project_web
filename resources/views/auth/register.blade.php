@extends('layouts.layout')

@section('content')
    <form action="{{ route('auth.register.post') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col mb-2 ">
                <div class="card border-0" style="border-radius: 2rem">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="card registerimg border-0 justify-content-center"
                                style="border-radius: 1rem 0 0 1rem">
                                <div class="row g-0">
                                    <div class="col-1 p-0"></div>
                                    <div class="col">
                                        <div class="card glassmorphism align-self-center text-left p-4">
                                            <h4 class="mb-4" style="font-weight: 700; color:#fcfcfc">TimKerjaKu</h4>
                                            <p style="color:#fcfcfc">Apliakasi Sistem Pengelolaan Sumber Daya Manusia</p>
                                        </div>
                                    </div>
                                    <div class="col-1 p-0"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card px-4 py-3 border-0" style="border-radius: 0 1rem 1rem 0">
                                <h3 class="text-center mt-5 mb-2 daftarakun">Daftar Akun</h3>
                                <p class="text-center mb-4">Sudah memiliki akun? Masuk <a
                                        href="{{ route('auth.login.form') }}"
                                        style="text-decoration:underline; font-weight:700; color:#444EFF">disini</a></p>
                                </h6>
                                <div class="row g-0">
                                    <div class="col">

                                    </div>
                                    <div class="col-10">
                                        <form method="POST" action="{{ route('auth.register.post') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group mb-3">
                                                <label for="inputName" class="mb-1">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="inputName" aria-describedby="nameHelp" required
                                                    placeholder="Masukkan Nama Anda" style="border-radius: .75rem;">
                                            </div>
                                            @error('name')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group mb-3">
                                                <label for="inputEmail" class="mb-1">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="inputEmail" aria-describedby="emailHelp" required
                                                    placeholder="example@email.com" style="border-radius: .75rem">
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="inputPassword" class="mb-1">Password</label>
                                            <div class="form-group mb-3">
                                                <div class="input-group flex-nowrap">
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" id="inputPassword" required
                                                        placeholder="Minimal 8 Karakter"
                                                        style="border-radius: .75rem 0 0 .75rem">
                                                    <button class="btn btnprimary" type="button" id="basic-addon2"
                                                        style="border-radius: 0 .75rem .75rem 0"
                                                        onclick="password_show_hide();">
                                                        <i class="fa-regular fa-eye" id="show_eye"></i>
                                                        <i class="fa-regular fa-eye-slash d-none" id="hide_eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('password')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <label for="inputPassword" class="mb-1">Konfirmasi Password</label>
                                            <div class="form-group mb-3">
                                                <div class="input-group flex-nowrap">
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation" id="password_confirmation" required
                                                        placeholder="Minimal 8 Karakter"
                                                        style="border-radius: .75rem 0 0 .75rem">
                                                    <button class="btn btnprimary" type="button" id="basic-addon2"
                                                        style="border-radius: 0 .75rem .75rem 0"
                                                        onclick="password_confirmation_show_hide();">
                                                        <i class="fa-regular fa-eye" id="show_eye2"></i>
                                                        <i class="fa-regular fa-eye-slash d-none" id="hide_eye2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check mb-5">
                                                <input type="checkbox" class="form-check-input" id="termCondition">
                                                <small class="form-check-label" for="exampleCheck1">Saya telah membaca dan
                                                    menyetujui <a href="#" style="font-weight: 700">Syarat dan
                                                        Ketentuan</a> yang berlaku</small>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-2"></div>
                                                <div class="col d-grid"><button type="submit" id="submitBtn"
                                                        class="btn btn-block btnprimary rounded-pill"
                                                        style="font-weight: 700; height: 3rem;">Daftar</button></div>
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
    </form>
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

        function password_confirmation_show_hide() {
            var x = document.getElementById("inputPassword");
            var show_eye = document.getElementById("show_eye2");
            var hide_eye = document.getElementById("hide_eye2");
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#submitBtn').prop('disabled', true);
            $('#termCondition').click(function() {
                var state = $(this)[0].checked;

                if (state === true) {
                    $('#submitBtn').prop('disabled', false);
                } else if (state === false) {
                    $('#submitBtn').prop('disabled', true);
                }
            });
        });
    </script>
@endpush
