@extends('backend.layout.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold">
                {{ Sentinel::getUser()->name }}
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-md-8 mt-4">
                            <div class="card" style="border-style: none;">
                                <img class="card-img-top" id="profileImg" src="..." alt="No Logo Yet :("
                                    onerror="this.onerror=null; this.src='{{ asset('assets/no-image.png') }}'";>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col col-md-6 col-sm-12">
                        <div class="row mt-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Nama</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('name')
                                is-invalid
                            @enderror"
                                        id="companyEmailInput" name="name" placeholder="(example: Faris Hakim)"
                                        value="{{ Sentinel::getUser() ? Sentinel::getUser()->name : '' }}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <p>Email</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('email')
                                is-invalid
                            @enderror"
                                        id="companyEmailInput" name="email" placeholder="(example: yourname@email.com)"
                                        value="{{ Sentinel::getUser() ? Sentinel::getUser()->email : '' }}" readonly>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <p>No. Handphone</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('phone')
                                is-invalid
                            @enderror"
                                        id="companyEmailInput" name="phone" placeholder="(example: 081384837940)"
                                        value="{{ Sentinel::getUser() ? Sentinel::getUser()->phone : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href=""><button type="submit" class="btn btn-primary"
                                style=" background-color: #444EFF; border-radius: 10px"><span
                                    class="fa-sharp fa-regular fa-pen-to-square fa-lg"
                                    style="margin-right: 10px;"></span>&nbsp;SIMPAN</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
