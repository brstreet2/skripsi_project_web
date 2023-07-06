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
                            <img class="card-img-top" id="companyImage" src="..." alt="No Logo Yet :("
                                onerror="this.onerror=null; this.src='assets/no-image.png'";>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <h5>Logo Bisnis</h5>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <input type="file" id="imgInput" class="form-control" accept="image/png, image/jpeg"
                                        style="border-radius: 2rem 0rem 0rem 2rem">
                                    <button class="btn btn-primary" type="button" id="button-addon2"
                                        style="background-color: #444EFF; border-radius: 0rem 2rem 2rem 0rem">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-5">
                        <h4>informasi Bisnis</h4>
                        <small class="mb-3" style="color: red">Anda belum membuat profil bisnis, mohon mengisi form informasi bisnis</small>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <a href="{{ route('company.create') }}"><button type="button" class="btn btn-primary" style=" background-color: #444EFF; border-radius: 10px"><span class="fa-sharp fa-regular fa-pen-to-square fa-lg" style="margin-right: 10px;"></span>&nbsp;EDIT</button></a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Nama Bisnis</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>No. Telephone</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Email Supervisor</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Alamat</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Provinsi</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Kota</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Industri Bisnis</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p>Jumlah Pegawai</p>
                        </div>
                        <div class="col-md-6">
                            -
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @elseif (Sentinel::getUser()->company != null) --}}
        {{-- @endif --}}

        <script>
            imgInput.onchange = evt => {
                const [file] = imgInput.files
                if (file) {
                    companyImage.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endsection

    @push('css')
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css" rel="stylesheet">
        <link href="{{ asset('plugins/jquery-datatables-checkboxes/css/dataTables.checkboxes.css') }}">
    @endpush

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{ asset('plugins/jquery-datatables-checkboxes/js/dataTables.checkboxes.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
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
