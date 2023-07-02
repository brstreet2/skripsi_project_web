@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <h5 class="font-mpb mb-2 text-color-primary">
            <strong>Absensi - {{ $user->name }}</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Check Employee Attendance</p>
        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <table id="documentTable" class="table table-borderless text-center">
                    <thead>
                        <tr>
                            <th class="text-center font-mp">Dates</th>
                            <th class="text-center font-mp">Time-Off</th>
                            <th class="text-center font-mp">Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center font-mp">dd/mm/yy</td>
                            <td class="text-center font-mp">Sick</td>
                            <td class="text-center font-mp">
                                <a href="/attendance/timeoff">
                                    <button class="btn btn-danger fw-bolder mb-4 px-4 rounded-pill"
                                        href="">Decline</button>
                                    <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" href=""
                                        style="background-color: #444EFF">Approve</button>
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
