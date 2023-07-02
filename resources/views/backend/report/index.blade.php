@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <h5 class="font-mpb mb-3 text-color-primary">
            <strong>Laporan</strong>
        </h5>

        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <div class="dropdown">
                            <label for="employeeSelect">Nama Karyawan <span style="color: red">*</span></label>
                            <select class="form-control" type="button" id="employeeSelect" name="employeeSelect">
                                <option value="{{ Carbon\Carbon::now()->format('m') }}" selected disabled readonly>
                                    {{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('F') }}</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <table id="presence_table" class="table table-borderless text-center" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">&nbsp;</th>
                                <th class="text-center">
                                    Hari / Tanggal
                                </th>
                                <th class="text-center">
                                    Jam Masuk
                                </th>
                                <th class="text-center">
                                    Jam Keluar
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
