@extends('backend.layout.layout')

@section('content')
    <div class="row text-center">
        <h4 class="fw-bolder mt-2">PRICING PLAN</h4>
        <h6 class="fw-bold mt-2 mb-4">JOIN NOW</h6>
        <div class="col-md-4 mb-5">
            <div class="card zoom mt-2" style="border: none; border-radius: .5rem; box-shadow: .25rem .25rem .75rem rgba(20, 20, 20, 0.15); border-radius: 1rem">
                <div class="card-body text-center mt-2">
                    <h1 class="fa-regular fa-user" style="color:#55555"></h1>
                    <h4 class="mt-3 mb-2">BASIC</h4>
                    <h5 class="fw-bold mb-4">*GRATIS*</h5>
                    <h4 class="fw-bold mb-4">Fitur: </h4>
                    <p class="my-2">~5 Accounts</p>
                    <p class="my-2">Kehadiran</p>
                    <p class="my-2">Absen</p>
                    <button class="btn btn-md rounded-pill px-5 text-light fw-bolder my-4" style="background-color: #555555">Free</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card zoom mt-2" style="border: none; border-radius: .5rem; box-shadow: .25rem .25rem .75rem rgba(20, 20, 20, 0.15); border-radius: 1rem">
                <div class="card-body text-center mt-2">
                    <h1 class="fa-solid fa-users" style="color:#00A575"></h1>
                    <h4 class="mt-3 mb-2">PRO</h4>
                    <h5 class="fw-bold mb-4">199.000 <small>/bulan</small></h5>
                    <h4 class="fw-bold mb-4">Fitur: </h4>
                    <p class="my-2">~25 Accounts</p>
                    <p class="my-2">Kehadiran</p>
                    <p class="my-2">Absensi</p>
                    <p class="my-2">Slip Gaji</p>
                    <p class="my-2">    </p>
                    <button class="btn btn-md rounded-pill px-5 text-light fw-bolder my-4" style="background-color: #00A575">Beli</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card shadow zoom mt-2" style="border: none; border-radius: .5rem; box-shadow: .25rem .25rem .75rem rgba(20, 20, 20, 0.15); border-radius: 1rem">
                <div class="card-body text-center">
                    <span><h1 class="fa-regular fa-star" style="color: #FFD700"></h1></span>
                    <h5 class="my-4">PLUS</h5>
                    <h2 class="fw-bold mb-5">399.000<small>/bulan</small></h2>
                    <h4 class="fw-bold mb-4">Fitur: </h4>
                    <p class="my-2"> ~100 Accounts </p>
                    <p class="my-2"> Kehadiran </p>
                    <p class="my-2"> Absen </p>
                    <p class="my-2"> Slip Gaji </p>
                    <p class="my-2"> Share Dokumen </p>
                    <p class="my-2"> Share Pengumuman </p>
                    <p class="my-2 mb-5"> Generate Report </p>
                    <button class="btn btn-md rounded-pill px-5 text-dark fw-bolder" style="background-color: #FFD700;">Beli</button>
                </div>
            </div>
        </div>
    </div>
@endsection