@extends('backend.layout.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold">
                {{ Sentinel::getUser()->name }}
            </h4>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-md-8 mt-4">
                                <div class="card" style="border-style: none;">
                                    @if (Sentinel::getUser()->avatar == null)
                                        <div class="avatar-wrapper">
                                            <img class="profile-pic" src="" />
                                            <div class="upload-button">
                                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                            </div>
                                            <input class="file-upload" name="file_avatar" type="file" accept="image/*" />
                                        </div>
                                    @else
                                        <div class="avatar-wrapper">
                                            <img class="profile-pic" src="{{ Sentinel::getUser()->avatar }}" />
                                            <div class="upload-button">
                                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                            </div>
                                            <input class="file-upload" name="file_avatar" type="file" accept="image/*" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>


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
@push('scripts')
    <script>
        $(document).ready(function() {

            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
@endpush
