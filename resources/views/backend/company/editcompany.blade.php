@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>EDIT PROFIL BISNIS</strong>
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
                                    <input type="text" class="form-control" id="companyNameInput" name="company_name"
                                        placeholder="(example: PT. XYZ)">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>No. Telephone Bisnis</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="companyNumberInput" name="company_phone"
                                        placeholder="(example: 08XX-XXXX-XXXX)">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Email Supervisor</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="companyEmailInput" name="company_spv"
                                        placeholder="(example: yourname@email.com)">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Alamat</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="companyAddressInput"
                                        name="company_address" placeholder="(example: Jl. Alamat No. 45)">
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Provinsi</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="provinceInput" name="company_province"
                                        placeholder="(example: DKI Jakarta)">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Provinsi
                                            ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Kota</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="cityInput" name="company_city"
                                        placeholder="(example: DKI Jakarta)">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Kota / Kabupaten
                                            ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p>Industri</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="industryInput" name="company_industry">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Industri
                                            ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <p>Jumlah Karyawan</p>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="sizeInput" name="company_size">
                                        <option disabled selected="Selected" value="null">Pilih
                                            Jumlah Karyawan
                                            ...</option>
                                    </select>
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
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('plugins/jquery-datatables-checkboxes/css/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2-bootstrap.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('plugins/jquery-datatables-checkboxes/js/dataTables.checkboxes.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/moment.min.js') }}"></script>

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

            var table = $('#documentTable').DataTable({
                ajax: {
                    url: '{!! route('document.ajax.datatables') !!}',
                    dataType: 'json'
                },
                serverSide: true,
                order: [0, 0],
                columnDefs: [{
                    targets: 0,
                    checkboxes: {
                        selectRow: true
                    }
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: true
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                select: {
                    style: 'multi'
                },
            });

            $('#deleteBulk').click(function() {
                let form = $('#invisibleBulk');
                var rowSelected = table.column(0).checkboxes.selected();
                Swal.fire({
                    title: 'Delete Confirmation',
                    text: "Data will be removed permanently",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    width: '28em',
                    customClass: {
                        confirmButton: 'px-5 btn btn-sm',
                        cancelButton: 'px-5 btn btn-sm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.each(rowSelected, function(index, rowId) {
                            let id = [rowId];
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr('content')
                                },
                                method: "POST",
                                url: "{{ route('document.destroy.bulk') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': id,
                                },
                                success: function(data) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Data successfully deleted!',
                                        showConfirmButton: false,
                                        timer: 15004,
                                        width: '28em',
                                    })
                                },
                                error: function(data) {
                                    console.log("Error Status: ", data.status);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'There was an error!',
                                        footer: '<a>Try again later ...</a>',
                                        width: '28em'
                                    })
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Cancelled',
                            showConfirmButton: false,
                            timer: 1500,
                            width: '28em',
                        })
                    }
                });
            });

            $(document).on('click', '#deleteButton', function() {
                var thisData = $('#deleteButton');
                Swal.fire({
                    title: 'Remove ' + thisData.data('name') + '?',
                    text: 'This data will be permanently removed from our system.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    width: '28em',
                    customClass: {
                        confirmButton: 'px-5 btn btn-sm',
                        cancelButton: 'px-5 btn btn-sm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('document.destroy', ':id') }}";
                        url = url.replace(':id', thisData.data('id'));
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            method: 'DELETE',
                            url: url,
                            success: function(data) {
                                table.ajax.reload();
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Data successfully deleted!',
                                    showConfirmButton: false,
                                    timer: 15004,
                                    width: '28em',
                                })
                            },
                            error: function(data) {
                                console.log("Error Status: ", data.status);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'There was an error!',
                                    footer: '<a>Try again later ...</a>',
                                    width: '28em'
                                })
                            }
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Cancelled',
                            showConfirmButton: false,
                            timer: 1500,
                            width: '28em',
                        })
                    }
                });
            });
        });
    </script>
@endpush
