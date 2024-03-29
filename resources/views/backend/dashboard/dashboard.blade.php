@extends('backend.layout.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/progressbar.css') }}">
    <div class="card mb-3"style="border: 1px solid #cccfff; border-radius:.75rem">
        <div class="card-body">
            <h4 class="fw-bold">
                Selamat datang kembali, {{ Sentinel::getUser()->name }}!
            </h4>
            <p style="color:#999999">
                Time: {{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, j F Y') }}
            </p>
        </div>
    </div>

    <div class="card mb-3"style="border: 1px solid #cccfff; border-radius:.75rem">
        <div class="card-body p5-">
            <ol class="steps" style="margin-top: 3rem">
                <li class="step is-complete" data-step="1">
                    Buat Akun
                </li>
                <li class="step {{ Sentinel::getUser()->company ? 'is-complete' : 'is-active' }}" data-step="2">
                    Tambah Profil bisnis
                </li>
                @if ($count <= 0)
                    <li class="step {{ Sentinel::getUser()->company ? 'is-active' : '' }} {{ $count <= 0 ? '' : 'is-complete' }}"
                        data-step="3">
                        Tambah Karyawan
                    </li>
                @else
                    <li class="step {{ $count <= 0 ? '' : 'is-complete' }}" data-step="3">
                        Tambah Karyawan
                    </li>
                @endif

                <li class="step {{ $count <= 0 ? '' : 'is-complete' }}" data-step="4">
                    Selesai!
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('employee.index') }}">
                <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                    Karyawan</div>
                                {{-- <div class="h5 mb-0 font-weight-bold text-gray-300">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>  
                                </div> --}}
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-user fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('attendance.index') }}">
                <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                    Kehadiran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('attendance.index') }}">
                <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                    Ketidakhadiran</div>
                                <div class="h5 mb-0 font-weight-bold"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-2x fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('payroll.index') }}">
                <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                    Slip Gaji</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-2x fa-comments"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="card" style="border: 1px solid #cccfff; border-radius:.75rem">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Pengumuman</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            @if (!isset(Sentinel::getUser()->company->latest_announcements))
                                Tidak ada pengumuman.
                            @elseif (!Sentinel::getUser()->company->latest_announcements->isEmpty())
                                <strong>Judul:</strong><br>
                                {{ Sentinel::getUser()->company->latest_announcements? Sentinel::getUser()->company->latest_announcements->first()->value('name'): '' }}<br>
                                <strong>Tanggal:</strong><br>
                                {{ Sentinel::getUser()->company->latest_announcements? Sentinel::getUser()->company->latest_announcements->first()->value('date'): '' }}<br>
                                <strong>Isi:</strong><br>
                                {!! Sentinel::getUser()->company->latest_announcements
                                    ? Sentinel::getUser()->company->latest_announcements->first()->value('content')
                                    : '' !!}
                                <hr>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets\progress-bar.js"></script>
    <script src="assets\app.js"></script>
@endsection
