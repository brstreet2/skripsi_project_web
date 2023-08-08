@extends('backend.layout.layout')

@section('content')
<div class="row mb-4">
    <h5 class="font-mpb text-color-primary">
        <strong>PEMBAYARAN BERHASIL</strong>
    </h5>
    <p class="mb-3" style="font-size: 16px"></p>
    <div class="card" style="border-radius: .75rem; border: none; background-color: #fcfcfc;">
        <div class="card-body text-center mt-3">
            <h3 style="font-weight-bold"><i>Pembayaran anda telah diterima</i></h3>
                <img src="{{ asset('assets/Check.png') }}" class="img-fluid" alt=""
                style="width: 20%;
                height: auto;
                object-fit: cover;
                border-radius: 10px;">
            <div class="row mt-1 mb-3">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row text-start">
                                <h5>
                                    Rincian Pembayaran
                                </h5>
                            </div>
                        </div>
                        <div class="card-body p-4">                               
                            <div class="row">
                                <div class="col-6 text-start">
                                    <h5>
                                        Upgrade
                                    </h5>
                                </div>
                                <div class="col-6 text-end">
                                    <h5>
                                        Nama Paket
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-start">
                                    <h5>
                                        Harga
                                    </h5>
                                </div>
                                <div class="col-6 text-end">
                                    <h5>
                                        Rp.
                                    </h5>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6 text-start">
                                    <h5>
                                        No. Virtual Acc
                                    </h5>
                                </div>
                                <div class="col-6 text-end">
                                    <h5>
                                        123789791
                                    </h5>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <p>
                                        Terima kasih atas kepercayaan anda terhadap layanan kami
                                        <br>
                                        <i>-TimKerjaKu-</i>
                                    </p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <a href="/dashboard">
                                    <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill"
                                    style="background-color: #444EFF">Kembali ke Beranda</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
