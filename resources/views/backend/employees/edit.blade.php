@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>TAMBAH KARYAWANS</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Mohon isi seluruh form di bawah ini dengan data karyawan anda</p>
        <form action="{{ route('company.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h4>Data Karyawan</h4>
                        </div>

                        <div class="mt-3">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Nama Karyawan</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="namaKaryawan" name="name"
                                    placeholder="Nama Karyawan">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Nomor Telepon</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="no_telp" name="phone"
                                    placeholder="No. Telephone Karyawan">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Pekerjaan</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="" name="company_spv"
                                        placeholder="(contoh: kasir)">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Email</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id=""
                                        name="" placeholder="Masukkan Email Aktif Karyawan">
                                        <small class="text-danger">* Digunakan untuk masuk ke aplikasi mobile TimKerjaKu.</small>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Password</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id=""
                                        name="" placeholder="Masukkan Password untuk Karyawan">
                                        <small class="text-danger">* Digunakan untuk masuk ke aplikasi mobile TimKerjaKu.</small>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Kota</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="cityInput" name="company_city"
                                        placeholder="(example: DKI Jakarta)">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Kota / Kabupaten
                                            ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Industri</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="industryInput" name="company_industry">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Industri
                                            ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <p>Jumlah Karyawan</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="sizeInput" name="company_size">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Jumlah Karyawan
                                            ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" type="submit"
                                        style="background-color: #444EFF">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection