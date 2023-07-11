@extends('backend.layout.layout')

@section('content')
    <div class="row mb-4">
        <h5 class="font-mpb text-color-primary">
            <strong>RINGKASAN BELANJA</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px"></p>
        <div class="card" style="border-radius: .75rem; border: none; background-color: #fcfcfc;">
            <div class="card-body">
                <div class="container mt-2 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex flex-row align-items-center">
                            <img src="{{ asset('assets/logo2_nobg.png') }}" class="img-fluid" width="200px" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="bg-pay p-3"><strong>Ringkasan Belanja</strong>
                                <hr>
                                <div class="d-flex justify-content-between mt-2"> <span class="lh-16 fw-500"><strong>Total
                                            Belanja</strong></div>
                                <div class="d-flex justify-content-between mt-2"> <span class="lh-16 fw-500">Total Harga
                                    </span> <span>Rp399.000</span> </div>
                                <hr>
                                <div class="d-flex justify-content-between mt-2"> <span class="lh-16 fw-500"><strong>Biaya
                                            Transaksi</strong></div>
                                <div class="d-flex justify-content-between mt-2"> <span class="lh-16 fw-500">Biaya Layanan
                                    </span> <span>Rp4.440</span> </div>
                                <div class="d-flex justify-content-between mt-2"> <span class="lh-16 fw-500">Biaya Jasa
                                        Aplikasi
                                    </span> <span>Rp1.560</span> </div>
                                <hr>
                                <div class="d-flex justify-content-between mt-2"> <strong>Total
                                        Bayar</strong> <span class="text-success"><strong>Rp405.000</strong></span> </div>
                            </div>
                            <h5 class="mb-0 text-success mt-4"></h5>
                            <form action="{{ route('pricing.store.pro') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="about">
                                    <div class="p-2 d-flex justify-content-between bg-pay align-items-center">
                                        <span>TimKerjaKu</span> <span>PRO</span>
                                    </div>
                                    <hr>
                                    <p>Pilih metode pembayaran</p>
                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOne">
                                                    Virtual Account
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="panelsStayOpen-headingOne">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" name="payment_method"
                                                                    value="BCA" id="flexRadioDefault1">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <figure class="figure">
                                                                        <img src="https://www.bca.co.id/-/media/Feature/Header/Header-Logo/logo-bca.svg?"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-width: 150px" alt="BCA" />
                                                                        <figcaption class="figure-caption">BCA</figcaption>
                                                                    </figure>

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="payment_method" value="MANDIRI"
                                                                    id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    <figure class="figure">
                                                                        <img src="https://bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1678035789124"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-width: 150px" alt="Mandiri" />
                                                                        <figcaption class="figure-caption">Mandiri
                                                                        </figcaption>
                                                                    </figure>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="payment_method" value="BRI"
                                                                    id="flexRadioDefault3">
                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                    <figure class="figure">
                                                                        <img src="https://bri.co.id/o/bri-corporate-theme/images/bri-logo.png"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-width: 150px" alt="BRI" />
                                                                        <figcaption class="figure-caption">BRI</figcaption>
                                                                    </figure>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="payment_method" value="BNI"
                                                                    id="flexRadioDefault4">
                                                                <label class="form-check-label" for="flexRadioDefault4">
                                                                    <figure class="figure">
                                                                        <img src="https://www.bni.co.id/Portals/1/bni-logo-id.png"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-width: 150px" alt="BNI" />
                                                                        <figcaption class="figure-caption">BNI</figcaption>
                                                                    </figure>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary mt-2 rounded-pill" type="submit"
                                            style="background-color: #444eff">Lanjutkan Pembayaran</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('document').ready(function() {
            $('#btnApply').click(function() {
                console.log($('input[name="payment_method"]:checked').val());
                $('#modal-lg').modal('hide');
            });
        });
    </script>
@endpush
