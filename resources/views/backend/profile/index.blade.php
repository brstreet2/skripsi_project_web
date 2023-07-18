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
                                @if (Sentinel::getUser()->avatar == null)
                                    <img class="card-img-top" id="profileImg"
                                        src="https://s3-id-jkt-1.kilatstorage.id/timkerjaku/428-4287240_no-avatar-user-circle-icon-png.png" />
                                @else
                                    <div class="avatar-wrapper">
                                        <img class="profile-pic" src="{{ Sentinel::getUser()->avatar }}" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <div class="col col-md-6 col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/profile">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.security') }}">Keamanan</a>
                        </li>
                    </ul>
                    <div class="row mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <p>Nama</p>
                            </div>
                            <div class="col-md-6">
                                {{ Sentinel::getUser() ? Sentinel::getUser()->name : '' }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p>Email</p>
                            </div>
                            <div class="col-md-6">
                                {{ Sentinel::getUser() ? Sentinel::getUser()->email : '' }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p>Type Akun</p>
                            </div>
                            <div class="col-md-6">
                                @if (Sentinel::getUser()->user_type == 0)
                                    <span class="badge bg-secondary">Employee</span>
                                @elseif (Sentinel::getUser()->user_type == 1)
                                    <span class="badge bg-secondary">Basic</span>
                                @elseif (Sentinel::getUser()->user_type == 2)
                                    <span class="badge bg-success">Premium</span>
                                @elseif (Sentinel::getUser()->user_type == 3)
                                    <span class="badge bg-warning">PRO</span>
                                @else
                                    <span class="badge bg-secondary">Employee</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p>No. Handphone</p>
                            </div>
                            <div class="col-md-6">
                                {{ Sentinel::getUser() ? Sentinel::getUser()->phone : '' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="{{ route('profile.edit') }}"><button type="button" class="btn btn-primary"
                            style=" background-color: #444EFF; border-radius: 10px"><span
                                class="fa-sharp fa-regular fa-pen-to-square fa-lg"
                                style="margin-right: 10px;"></span>&nbsp;EDIT</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
