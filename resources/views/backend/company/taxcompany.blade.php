@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>EDIT COMPANY TAX INFO</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">You haven't set up your company tax informations, let's fill the forms
            below.</p>
        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h4>Tax Info</h4>
                    </div>
                    <div class="col-4">
                        <a href="/company/tax">
                            <button class="btn"><i class="fa-sharp fa-regular fa-pen-to-square fa-lg"></i></button>
                        </a>
                    </div>
                    <div class="col-2">

                    </div>

                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <p>Company Name</p>
                            </div>
                            <div class="col-md-6">
                                PT. Inovasi Bersama
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Company Phone Number</p>
                            </div>
                            <div class="col-md-6">
                                081383278323
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Supervisor Email</p>
                            </div>
                            <div class="col-md-6">
                                azkasecio0405@gmail.com
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Address</p>
                            </div>
                            <div class="col-md-6">
                                Jl. Pembangunan III, Blok G/33
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Province</p>
                            </div>
                            <div class="col-md-6">
                                Banten
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>City</p>
                            </div>
                            <div class="col-md-6">
                                Kota Tangerang
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Industry</p>
                            </div>
                            <div class="col-md-6">
                                Food & Beverage
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Company Size</p>
                            </div>
                            <div class="col-md-6">
                                0 - 50
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
