@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow" style="border: none">
                <div class="card-body">
                    <h4 class="fw-bold">
                        Welcome Back, Azka!
                    </h4>
                    <p>
                        Time: {{ Carbon\Carbon::now()->format('D F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow my-2" style="border: none; height: 18rem">
                <div class="card-body">
                    <h5 class="fw-bold">Employees</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow my-2" style="border: none; height: 18rem">
                <div class="card-body">
                    <h5 class="fw-bold">Attendance</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow my-2" style="border: none; height: 18rem">
                <div class="card-body">
                    <h5 class="fw-bold">Time off requests</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow my-2" style="border: none; height: 18rem">
                <div class="card-body">
                    <h5 class="fw-bold">Shift change requests</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow" style="border: none;">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Announcement</button>
                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Who's off today</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem accusantium ipsa facilis laudantium reprehenderit vitae eum tenetur animi, ex, consequatur dolore? Neque aut, aliquid a deserunt voluptate laborum perferendis ipsam?</div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem commodi voluptas, quae eligendi quos debitis praesentium doloribus nihil explicabo omnis dolores eum adipisci rem in voluptates tempore, dicta tempora blanditiis?</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection