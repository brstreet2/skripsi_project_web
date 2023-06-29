@extends('backend.layout.layout')
@section('content')
<div class="row">
    <h5 class="font-mpb mb-2 text-color-primary">
            <strong>Attendance</strong>
    </h5>
    <p class="mb-3" style="font-size: 16px">Cek Data Kehadiran Karyawan</p>
    <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <table id="documentTable" class="table table-borderless text-center">
                    <thead>
                        <tr>
                            <th class="text-center font-mp">Nama Karyawn</th>
                            <th class="text-center font-mp">Kehadiran</th>
                            <th class="text-center font-mp">Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center font-mp">Employee #1</td>  
                            <td class="text-center font-mp">
                                <a href="/attendance/view">
                                <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" href="" style="background-color: #444EFF" >Lihat</button>
                                </a>
                                </td>  
                            <td class="text-center font-mp">
                                <a href="/attendance/timeoff">
                                <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" href="" style="background-color: #444EFF" >View</button>
                                </a>
                           </td>  
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>

    </div>


</div>
@endsection