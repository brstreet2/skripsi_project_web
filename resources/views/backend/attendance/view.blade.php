@extends('backend.layout.layout')
@section('content')
<div class="row">
    <h5 class="font-mpb mb-3 text-color-primary">
            <strong>Attendance</strong>
    </h5>

    <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row">
                <div class="col-2">
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Choose Months
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">January</a></li>
                    <li><a class="dropdown-item" href="#">February</a></li>
                    <li><a class="dropdown-item" href="#">March</a></li>
                    <li><a class="dropdown-item" href="#">April</a></li>
                    <li><a class="dropdown-item" href="#">May</a></li>
                    <li><a class="dropdown-item" href="#">June</a></li>
                    <li><a class="dropdown-item" href="#">July</a></li>
                    <li><a class="dropdown-item" href="#">August</a></li>
                    <li><a class="dropdown-item" href="#">September</a></li>
                    <li><a class="dropdown-item" href="#">October</a></li>
                    <li><a class="dropdown-item" href="#">November</a></li>
                    <li><a class="dropdown-item" href="#">Desember</a></li>
                </ul>
            </div>
                </div>
                <div class="col d-flex">
                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #444eff; width: 150px">
                Refresh
                </button>
                </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
    </div>
</div>
@endsection