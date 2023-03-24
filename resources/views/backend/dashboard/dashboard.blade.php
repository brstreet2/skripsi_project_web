@extends('backend.layout.layout')

@section('content')
        <div class="card mb-3"style="border: 1px solid #cccfff; border-radius:.75rem">
            <div class="card-body">
                <h4 class="fw-bold">
                    Welcome Back, {{ Sentinel::getUser()->name }}!
                </h4>
                <p style="color:#999999">
                    Time: {{ Carbon\Carbon::now()->format('D F Y') }}
                </p>
            </div>
        </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                Employees</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-300">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-user fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                Attendance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                Time Off Request</div>
                            <div class="h5 mb-0 font-weight-bold"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-2x fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card py-2" style="border-left: 0.25rem solid #444eff; border-radius: .75rem">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="fs-6 font-weight-bold text-primary text-uppercase mb-1">
                                Shift Change Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-2x fa-comments"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row mb-5">
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