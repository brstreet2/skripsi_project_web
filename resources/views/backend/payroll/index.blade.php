@extends('backend.layout.layout')
@section('content')
<div class="row">
    <h5 class="font-mpb mb-2 text-color-primary">
            <strong>Payroll</strong>
    </h5>
    <p class="mb-3" style="font-size: 16px">Upload Payroll Document</p>
    <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <table id="documentTable" class="table table-borderless text-center">
                    <thead>
                        <tr>
                            <th class="text-center font-mp">Employee Name</th>
                            <th class="text-center font-mp">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center font-mp">Employee #1</th>  
                            <td class="text-center font-mp"><button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" style="background-color: #444EFF" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Payroll</button></th>  
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 15px">
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="exampleModalLabel">Upload Payroll Form</h5>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group mb-3">
                <label for="namaKaryawan">Document Name</label>
                <input type="text" class="form-control" id="namaKaryawan" aria-describedby="namaHelp" placeholder="Input Document Name">
            </div>
            <div class="form-group mb-3">
            <label for="formFile" class="form-label">Upload Document</label>
            <input class="form-control" type="file" id="formFile">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary rounded-pill"  style="background-color: #444eff">Save</button>
        </div>
        </div>
    </div>
    </div>


</div>
@endsection