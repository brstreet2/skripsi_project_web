@extends('backend.layout.layout')

@section('content')
    <div class="d-flex flex-column-fluid mt-30 mb-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-row-fluid ml-5">
                        <div class="navbarMobile mb-3">

                        </div>

                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h5 class="font-mpb text-color-primary">
                                    <strong>PEMBAYARAN BERHASIL</strong>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="mt-5" width="20%" src="{{ asset('assets/payment-success.png') }}"
                                        alt="">
                                </div>

                                <div class="container mt-5">
                                    <div class="card text-center" style="background-color: #CDE6FA">
                                        <h5 class="mt-3">Jumlah yang telah di-bayar</h5>
                                        <h1>Rp {{ number_format($transactionDb->nominal, 2, ',', '.') }}</h1>
                                        <div class="row m-3">
                                            <div class="col-lg-6">
                                                <h5>Metode Pembayaran</h5>
                                                @if ($transactionDb->virtual_account_bank == 'MANDIRI VIRTUAL ACCOUNT')
                                                    <h5>
                                                        <strong>{{ $transactionDb->virtual_account_bank }}
                                                            <img src="https://bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1678035789124"
                                                                class="img-fluid img-thumbnail" style="max-width: 150px"
                                                                alt="Mandiri" />
                                                        </strong>
                                                    </h5>
                                                @elseif ($transactionDb->virtual_account_bank == 'BCA VIRTUAL ACCOUNT')
                                                    <h5>
                                                        <strong>{{ $transactionDb->virtual_account_bank }}
                                                            <img src="https://www.bca.co.id/-/media/Feature/Header/Header-Logo/logo-bca.svg?"
                                                                class="img-fluid img-thumbnail" style="max-width: 150px"
                                                                alt="BCA" />
                                                        </strong>
                                                    </h5>
                                                @elseif ($transactionDb->virtual_account_bank == 'BRI VIRTUAL ACCOUNT')
                                                    <h5>
                                                        <strong>{{ $transactionDb->virtual_account_bank }}
                                                            <img src="https://bri.co.id/o/bri-corporate-theme/images/bri-logo.png"
                                                                class="img-fluid img-thumbnail" style="max-width: 150px"
                                                                alt="BRI" />
                                                        </strong>
                                                    </h5>
                                                @elseif ($transactionDb->virtual_account_bank == 'BNI VIRTUAL ACCOUNT')
                                                    <h5>
                                                        <strong>{{ $transactionDb->virtual_account_bank }}
                                                            <img src="https://www.bni.co.id/Portals/1/bni-logo-id.png"
                                                                class="img-fluid img-thumbnail" style="max-width: 150px"
                                                                alt="BNI" />
                                                        </strong>
                                                    </h5>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>Tanggal Transaksi</h5>
                                                <h5><strong>{{ date('d M Y, H:i', strtotime($transactionDb->paid_at)) }}
                                                        WIB</strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-center m-3">Terima kasih atas kepercayaan anda terhadap layanan kami!
                                    </h6>
                                </div>

                                <div class="text-center">
                                    <a href="/dashboard">
                                        <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill"
                                            style="background-color: #444EFF">Kembali ke Beranda</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
