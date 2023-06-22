@extends('backend.layout.layout')
@section('content')
<div class="row">
    <h5 class="font-mpb mb-2 text-color-primary">
            <strong>Report</strong>
    </h5>
    <p class="mb-3" style="font-size: 16px">Generate Employee's Report Document</p>
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
                            <td class="text-center font-mp"><button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" style="background-color: #444EFF">Generate Report</button></th>  
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>


</div>
@endsection