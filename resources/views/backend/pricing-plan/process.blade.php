@extends('backend.layout.layout')

@section('content')
    <div class="row mb-4">
        <h5 class="font-mpb text-color-primary">
            <strong>MENUNGGU PEMBAYARAN</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px"></p>
        <div class="card" style="border-radius: .75rem; border: none; background-color: #fcfcfc;">
            <div class="card-body text-center" onload="_cntDown=setInterval('ShowTimes()',1000)">
                <h3>Selesaikan Pembayaran Dalam</h3>
                <h2 class="text-danger" id="timerCountdown"></h2>
                <div id="demo"></div>
                <div class="row mt-3 mb-3">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    @if ($transactionDb->virtual_account_bank == 'BCA VIRTUAL ACCOUNT')
                                        <div class="col-md-10 text-start">
                                            <h5>BCA Virtual Account</h5>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <img src="https://www.bca.co.id/-/media/Feature/Header/Header-Logo/logo-bca.svg?"
                                                class="img-fluid img-thumbnail" style="max-width: 50px" alt="BCA" />
                                        </div>
                                    @elseif ($transactionDb->virtual_account_bank == 'BNI VIRTUAL ACCOUNT')
                                        <div class="col-md-10 text-start">
                                            <h5>BNI Virtual Account</h5>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <img src="https://www.bni.co.id/Portals/1/bni-logo-id.png"
                                                class="img-fluid img-thumbnail" style="max-width: 50px" alt="BCA" />
                                        </div>
                                    @elseif ($transactionDb->virtual_account_bank == 'BRI VIRTUAL ACCOUNT')
                                        <div class="col-md-10 text-start">
                                            <h5>BRI Virtual Account</h5>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <img src="https://bri.co.id/o/bri-corporate-theme/images/bri-logo.png"
                                                class="img-fluid img-thumbnail" style="max-width: 50px" alt="BCA" />
                                        </div>
                                    @elseif ($transactionDb->virtual_account_bank == 'MANDIRI VIRTUAL ACCOUNT')
                                        <div class="col-md-10 text-start">
                                            <h5>Mandiri Virtual Account</h5>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <img src="https://bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1678035789124"
                                                class="img-fluid img-thumbnail" style="max-width: 50px" alt="BCA" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10 text-start">
                                        <small>Nomor Virtual Account</small>
                                        <h5 id="copyAcc">
                                            {{ $transactionDb ? $transactionDb->virtual_account_number : '' }}</h5>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="copyContent()"
                                            style=" background-color: #444EFF; border-radius: 7px"><span
                                                class="fa-regular fa-clipboard fa-lg"
                                                style="margin-right: 10px;"></span>&nbsp;Copy</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 text-start">
                                        <small>Total Pembayaran</small>
                                        <h5 id="copyAcc">Rp
                                            {{ number_format(abs($transactionDb ? $transactionDb->nominal : ''), 0, ',', '.') }}<button
                                                type="button" class="btn btn-sm border border-primary"
                                                onclick="copyContent()" style="border-radius: 7px"><span
                                                    class="fa-regular fa-clipboard fa-lg"
                                                    style="color: #444EFF"></span></button> </h5>

                                    </div>
                                    <div class="col-md-2 text-end">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <button class="btn btn-primary" onclick="start()"
                    style="background-color: #444EFF; border-radius: 10px">Konfirmasi Pembayaran</button>
            </div>
        </div>
    </div>
    </div>
    <script>
        let text = document.getElementById('copyAcc').innerHTML;
        const copyContent = async () => {
            try {
                await navigator.clipboard.writeText(text);
                console.log('nomor Virtual Account disalin');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }
    </script>
@endsection
@push('scripts')
    <script src="{{ asset('plugins/jQuery-countdown/dist/jquery.countdown.js') }}"></script>

    <script>
        $('document').ready(function() {
            $('#timerCountdown').countdown('{{ $transactionDb->expired_date }}', function(event) {
                $(this).html(event.strftime('%H:%M:%S'));
            });
        });
    </script>
@endpush
