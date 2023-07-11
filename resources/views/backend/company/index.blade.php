@extends('backend.layout.layout')

@section('content')
    {{-- @if (Sentinel::getUser()->company == null) --}}
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>PROFIL BISNIS</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Informasi Bisnis Anda</p>
        <div class="card mb-5" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="card">
                            <img class="card-img-top" id="companyImage"
                                src="{{ Sentinel::getUser()->company ? Sentinel::getUser()->company->ava_url : '' }}"
                                alt="No Logo Yet :(" onerror="this.onerror=null; this.src='assets/no-image.png'";>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <h5>Logo Bisnis</h5>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <form action="{{ route('company.submit.photo') }}" method="POST"
                                    enctype="multipart/form-data" id="submitPhotoForm">
                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input type="file" id="imgInput" name="company_image" class="form-control"
                                            accept="image/png, image/jpeg" style="border-radius: 2rem 0rem 0rem 2rem">
                                        <button class="btn btn-primary" {{ Sentinel::getUser()->company ? '' : 'disabled' }}
                                            type="submit" id="button-addon2"
                                            style="background-color: #444EFF; border-radius: 0rem 2rem 2rem 0rem">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-5">
                        <h4>Informasi Bisnis</h4>
                        <small class="mb-3" style="color: red">Anda belum membuat profil bisnis, mohon mengisi form
                            <strong>Informasi Bisnis</strong></small>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <a
                            href="{{ $user->company ? route('company.edit', [$user->company->id]) : route('company.create') }}"><button
                                type="button" class="btn btn-primary"
                                style=" background-color: #444EFF; border-radius: 10px"><span
                                    class="fa-sharp fa-regular fa-pen-to-square fa-lg"
                                    style="margin-right: 10px;"></span>&nbsp;EDIT</button></a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Nama Bisnis</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->name : '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>No. Telephone</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->phone : '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Email Supervisor</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->pic_email : '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Alamat</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->address : '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Provinsi</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->province_string : '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Kota</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->city_string : '-' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Industri Bisnis</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->industry_string : '-' }}
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Jumlah Pegawai</p>
                        </div>
                        <div class="col-md-6">
                            {{ $user->company ? $user->company->company_size_string : '-' }}
                        </div>
                    </div>

                    @if (Sentinel::getUser()->company)
                        <div class="row">
                            <div class="col-md-4">
                                <p>Lokasi Bisnis</p>
                            </div>
                            <div class="col-md-6">
                                <iframe
                                    src="https://maps.google.com/maps?q={{ Sentinel::getUser()->company->latitude }},{{ Sentinel::getUser()->company->longitude }}&hl=es;z=14&amp;output=embed"></iframe>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- @elseif (Sentinel::getUser()->company != null) --}}
        {{-- @endif --}}
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1PP2kJkFxzX-L8Tbbr7FRR4kNfg8qaPI&callback=Function.prototype">
        </script>
        <script type="text/javascript"
            src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>

        <script>
            $(document).ready(function() {
                $(function() {

                    $('#us2').locationpicker({
                        location: {
                            latitude: -6.2297465,
                            longitude: 106.829518
                        },
                        radius: 0,
                        inputBinding: {
                            latitudeInput: $('#lat'),
                            longitudeInput: $('#lng'),
                        },
                        enableAutocomplete: true,
                        onchanged: function(currentLocation, radius, isMarkerDropped) {
                            console.log("Location changed. New location (" + currentLocation
                                .latitude +
                                ", " + currentLocation.longitude + ")");
                        }
                    });


                });

                imgInput.onchange = evt => {
                    const [file] = imgInput.files
                    if (file) {
                        companyImage.src = URL.createObjectURL(file)
                    }
                }

                if ($('#imgInput').val() === "") {
                    $('#button-addon2').prop("disabled", true);
                }

                $('#imgInput').change(function() {
                    $('#button-addon2').prop("disabled", false);
                    if ($(this).val() === "") {
                        $('#button-addon2').prop("disabled", true);
                    }
                });

                $('#submitPhotoForm').submit(function(e) {
                    e.preventDefault();

                    var form = $(this);
                    var actionUrl = form.attr('action');
                    var submitBtn = $('#button-addon2');
                    var formData = new FormData($("#submitPhotoForm")[0]);
                    BtnLoading(submitBtn);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: actionUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            BtnReset(submitBtn);
                            console.log(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            BtnReset(submitBtn);
                            console.log(errorThrown);
                        }
                    });
                });

                function BtnLoading(elem) {
                    $(elem).attr("data-original-text", $(elem).html());
                    $(elem).prop("disabled", true);
                    $(elem).html('<i class="spinner-border spinner-border-sm"></i>');
                }

                function BtnReset(elem) {
                    $(elem).prop("disabled", false);
                    $(elem).html($(elem).attr("data-original-text"));
                }

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#imgInput').css('background-image', 'url(' + e.target.result + ')');
                            $('#imgInput').hide();
                            $('#imgInput').fadeIn(650);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            });
        </script>
    @endpush
