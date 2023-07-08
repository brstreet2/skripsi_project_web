@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>EDIT PROFIL BISNIS - {{ $company->name ? $company->name : '-' }}</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Mohon isi seluruh form di bawah ini</p>
        <form action="{{ route('company.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h4>Informasi Bisnis</h4>
                        </div>
                        <div class="mt-3">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Nama Bisnis</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('company_name')
                                        is-invalid
                                    @enderror"
                                        value="{{ $company->name ? $company->name : '-' }}" id="companyNameInput"
                                        name="company_name" placeholder="(example: PT. XYZ)">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_name')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>No. Telephone Bisnis</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('company_phone')
                                        is-invalid
                                    @enderror"
                                        id="companyNumberInput" name="company_phone" placeholder="(example: 08XX-XXXX-XXXX)"
                                        value="{{ $company->phone ? $company->phone : '-' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_phone')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Email Supervisor</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('company_spv')
                                        is-invalid
                                    @enderror"
                                        id="companyEmailInput" name="company_spv"
                                        placeholder="(example: yourname@email.com)"
                                        value="{{ $company->pic_email ? $company->pic_email : '-' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_spv')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Alamat</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('company_address')
                                        is-invalid
                                    @enderror"
                                        id="companyAddressInput" name="company_address"
                                        placeholder="(example: Jl. Alamat No. 45)" value="{!! $company->address ? $company->address : '-' !!}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_address')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Provinsi</p>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('company_province')
                                        is-invalid
                                    @enderror"
                                        id="provinceInput" name="company_province" placeholder="(example: DKI Jakarta)">
                                        <option disabled selected="Selected" value="null">
                                            {{ $company->province_string ? $company->province_string : 'Pilih Asal Provinsi ...' }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_province')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Kota</p>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('company_city')
                                        is-invalid
                                    @enderror"
                                        id="cityInput" name="company_city" placeholder="(example: DKI Jakarta)">
                                        <option disabled selected="Selected" value="null">
                                            {{ $company->city_string ? $company->city_string : 'Pilih Asal Kota ...' }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_city')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Industri</p>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('company_industry')
                                        is-invalid
                                    @enderror"
                                        id="industryInput" name="company_industry">
                                        <option disabled selected="Selected" value="null">
                                            {{ $company->industry_string ? $company->industry_string : 'Pilih Industri ...' }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_industry')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <p>Jumlah Karyawan</p>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('company_size')
                                        is-invalid
                                    @enderror"
                                        id="sizeInput" name="company_size">
                                        <option disabled selected="Selected" value="null">
                                            {{ $company->company_size_string ? $company->company_size_string : 'Pilih jumlah karyawan ...' }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('company_size')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <p>Latitude</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('latitude')
                                        is-invalid
                                    @enderror"
                                        id="lat" name="latitude"
                                        value="{{ $company->latitude ? $company->latitude : '-' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('latitude')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <p>Longitude</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"
                                        class="form-control @error('longitude')
                                        is-invalid
                                    @enderror"
                                        id="lng" name="longitude"
                                        value="{{ $company->longitude ? $company->longitude : '-' }}">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            @error('longitude')
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            @enderror

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <p>Pilih lokasi absen</p>
                                </div>
                                <div class="col-md-6">
                                    <div id="us2" style="width: 500px; height: 400px;" class="mt-4"></div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" type="submit"
                                        style="background-color: #444EFF">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1PP2kJkFxzX-L8Tbbr7FRR4kNfg8qaPI&callback=Function.prototype">
    </script>
    <script type="text/javascript"
        src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>

    <script>
        $(document).ready(function() {
            $('#provinceInput').select2({
                theme: "bootstrap",
                placeholder: "Select",
                width: '100%',
                containerCssClass: ':all:',
                ajax: {
                    url: '{{ route('company.ajax.provinces') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        };
                    },
                    cache: true,
                }
            });

            $('#sizeInput').select2({
                theme: "bootstrap",
                placeholder: "Select",
                width: '100%',
                containerCssClass: ':all:',
                ajax: {
                    url: '{{ route('company.ajax.sizes') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        };
                    },
                    cache: true,
                }
            });

            $('#industryInput').select2({
                theme: "bootstrap",
                placeholder: "Select",
                width: '100%',
                containerCssClass: ':all:',
                ajax: {
                    url: '{{ route('company.ajax.industries') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * data.per_page) < data.total
                            }
                        };
                    },
                    cache: true,
                }
            });

            $('#cityInput').select2({
                theme: "bootstrap",
                placeholder: "Piliih Kota / Kabupaten ...",
                width: '100%',
                containerCssClass: ':all:'
            });

            $('#provinceInput').on('change', function() {
                let province_id = $(this).val();
                if (province_id === "null") {
                    $('#cityInput').prop('readonly', true);
                    $('#cityInput').prop('disabled', true);
                } else {
                    $('#cityInput').prop('readonly', false);
                    $('#cityInput').prop('disabled', false);
                    $('#cityInput').empty();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ route('company.ajax.regencies') }}',
                        data: {
                            'province_id': province_id
                        },
                        success: function(response) {
                            $('#cityInput').append(
                                '<option value="null">Pilih Kota / Kabupaten ...</option>');
                            $.each(response, function(i, val) {
                                $('#cityInput').append(`<option value="` + val.id +
                                    `">` + val.name +
                                    `</option>`);
                            });
                        }
                    });
                }
            });

            $(function() {

                $('#us2').locationpicker({
                    location: {
                        latitude: $('#lat').val(),
                        longitude: $('#lng').val()
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
        });
    </script>
@endpush
