@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>KARYAWAN - {{ $employee ? $employee->name : '' }}</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Mohon isi seluruh form di bawah ini dengan data karyawan anda</p>
        <form action="{{ route('employee.update', [$employee->id]) }}" method="POST">
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
                                        id="namaKaryawan" name="name" placeholder="Nama Karyawan"
                                        value="{{ $employee ? $employee->name : '' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Nomor Telepon</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="no_telp" name="phone" placeholder="No. Telephone Karyawan"
                                        value="{{ $employee ? $employee->phone : '' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Pekerjaan</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="" name="job_title"
                                        placeholder="(contoh: Kasir)"
                                        value="{{ $employeeDetail ? $employeeDetail->job_title : '' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Email</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Masukkan Email Aktif Karyawan"
                                        value="{{ $employee ? $employee->email : '' }}">
                                    <small class="text-danger">* Digunakan untuk masuk ke aplikasi mobile
                                        TimKerjaKu.</small>
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
