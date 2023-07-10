@extends('backend.layout.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="fw-bold">
            Name
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
                <div class="col col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-md-8 mt-4">
                                <div class="card" style="border-style: none;">
                                    <img class="card-img-top" id="profileImg" src="..." alt="No Logo Yet :("
                                        onerror="this.onerror=null; this.src='assets/no-image.png'";>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                </div>
                <div class="col col-md-6 col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="/profile">Tentang</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="/profile/security">Keamanan</a>
                        </li>
                      </ul>
                    <div class="row mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <p>Password Lama</p>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group flex-nowrap">
                                    <input type="password"
                                        class="form-control"
                                        name="password" id="inputPassword" placeholder="Minimal 8 Karakter"
                                        required style="border-radius: .75rem">
                                    <button class="btn btnprimary" type="button" id="basic-addon2"
                                        style="border-radius: .75rem"
                                        onclick="password_show_hide();">
                                        <i class="fa-regular fa-eye" id="show_eye"></i>
                                        <i class="fa-regular fa-eye-slash d-none" id="hide_eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p>Password Baru</p>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group flex-nowrap">
                                    <input type="password"
                                        class="form-control"
                                        name="password" id="inputPassword2" placeholder="Minimal 8 Karakter"
                                        required style="border-radius: .75rem">
                                    <button class="btn btnprimary" type="button" id="basic-addon2"
                                        style="border-radius: .75rem"
                                        onclick="password_show_hide2();">
                                        <i class="fa-regular fa-eye" id="show_eye2"></i>
                                        <i class="fa-regular fa-eye-slash d-none" id="hide_eye2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p>Ulangi Password</p>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group flex-nowrap">
                                    <input type="password"
                                        class="form-control"
                                        name="password" id="inputPassword" placeholder="Minimal 8 Karakter"
                                        required style="border-radius: .75rem">
                                </div>
                            </div>
                        </div>
    
                        <div class="row mt-4 mb-2">
                            <div class="col col-md-12">
                                <button type="button" class="btn btn-danger mr-2" style="border-radius: 10px">Kembali</button>
                                <button type="button" class="btn btn-primary" style=" background-color: #444EFF; border-radius: 10px">Simpan Password</button>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
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

<script>
    function password_show_hide2() {
        var x = document.getElementById("inputPassword2");
        var show_eye = document.getElementById("show_eye2");
        var hide_eye = document.getElementById("hide_eye2");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye2.style.display = "none";
            hide_eye2.style.display = "block";
        } else {
            x.type = "password";
            show_eye2.style.display = "block";
            hide_eye2.style.display = "none";
        }
    }
</script>

@endsection
