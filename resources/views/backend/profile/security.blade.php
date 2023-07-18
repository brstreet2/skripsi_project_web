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
                            <a class="nav-link" aria-current="page" href="{{ route('profile.index') }}">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.security') }}">Keamanan</a>
                        </li>
                    </ul>
                    <div class="row mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <p>Password</p>
                            </div>
                            <div class="col-md-6">
                                *********
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <a href="{{ route('profile.security.form') }}"><button type="button"
                                        class="btn btn-primary"
                                        style=" background-color: #444EFF; border-radius: 10px"><span
                                            class="fa-sharp fa-regular fa-pen-to-square fa-lg"
                                            style="margin-right: 10px;"></span>&nbsp;Ganti Password</button></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
