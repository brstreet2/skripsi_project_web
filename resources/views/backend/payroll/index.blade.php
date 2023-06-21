@extends('backend.layout.layout')
@section('content')
<div class="row">
    <div class="col-6">
        <h5 class="font-mpb text-color-primary">
            <strong>Tambah Karyawan</strong>
        </h5>
    </div>

    <div class="col-6 d-flex justify-content-end">
        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #444eff">
        Tambah Karyawan
        </button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 15px">
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="exampleModalLabel">Form Tambah Karyawan</h5>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group mb-2">
                <label for="namaKaryawan">Nama</label>
                <input type="text" class="form-control" id="namaKaryawan" aria-describedby="namaHelp" placeholder="Nama Karyawan">
            </div>
            <div class="form-group mb-2">
                <label for="emailKaryawan">Email</label>
                <input type="email" class="form-control" id="emailKaryawan" aria-describedby="emailHelp" placeholder="Email Karyawan">
            </div>
            <div class="form-group">
                <label for="passwordKaryawan">Password</label>
                <input type="password" class="form-control" id="passwordKaryawan" placeholder="Password Karyawan">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary rounded-pill"  style="background-color: #444eff">Simpan</button>
        </div>
        </div>
    </div>
    </div>
</div>

<div id="dataKaryawan" class="col-12 mx-2 my-2">
    <p class="">halo</p>
</div>

</div>
@endsection