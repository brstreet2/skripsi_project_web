@extends('backend.layout.layout')

@section('content')
    <div class="row mb-4">
        <h5 class="font-mpb text-color-primary">
            <strong>RINGKASAN BELANJA</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px"></p>
        <div class="card" style="border-radius: .75rem; border: none; background-color: #fcfcfc;">
            <div class="card-body">
                <div class="container mt-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="d-flex flex-row align-items-center">
                            <img src="{{ asset('assets/logo2_nobg.png') }}" class="img-fluid"
                                style="width: 90px; height: 130px;" />
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
                                                    <label for="radio-card-1" class="radio-card">
                                                        <input type="radio" name="payment_method" id="radio-card-1"
                                                            value="BCA" />
                                                        <div class="card-content-wrapper">
                                                            <span class="check-icon"></span>
                                                            <div class="card-content text-center">
                                                                <img src="https://www.bca.co.id/-/media/Feature/Header/Header-Logo/logo-bca.svg?"
                                                                    class="img-fluid" />
                                                                <h4>BCA</h4>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <!-- /.radio-card -->
                                                    <label for="radio-card-2" class="radio-card">
                                                        <input type="radio" name="payment_method" id="radio-card-2"
                                                            value="MANDIRI" />
                                                        <div class="card-content-wrapper">
                                                            <span class="check-icon"></span>
                                                            <div class="card-content text-center">
                                                                <img src="https://bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1678035789124"
                                                                    class="img-fluid" />
                                                                <h4>Mandiri</h4>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <!-- /.radio-card -->
                                                    <label for="radio-card-3" class="radio-card">
                                                        <input type="radio" name="payment_method" id="radio-card-3"
                                                            value="BRI" />
                                                        <div class="card-content-wrapper">
                                                            <span class="check-icon"></span>
                                                            <div class="card-content text-center">
                                                                <img src="https://bri.co.id/o/bri-corporate-theme/images/bri-logo.png"
                                                                    class="img-fluid" />
                                                                <h4>BRI</h4>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <!-- /.radio-card -->
                                                    <label for="radio-card-4" class="radio-card">
                                                        <input type="radio" name="payment_method" id="radio-card-4"
                                                            value="BNI" />
                                                        <div class="card-content-wrapper">
                                                            <span class="check-icon"></span>
                                                            <div class="card-content text-center">
                                                                <img src="https://www.bni.co.id/Portals/1/bni-logo-id.png"
                                                                    class="img-fluid" />
                                                                <h4>BNI</h4>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success mt-2" type="submit">Lanjutkan Pembayaran</button>
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
