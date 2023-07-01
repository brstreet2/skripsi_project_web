@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <h5 class="font-mpb mb-3 text-color-primary">
            <strong>Attendance</strong>
        </h5>

        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <div class="dropdown">
                            <select class="form-control" type="button" id="monthDropdown">
                                <option value="">Select Month ...</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <table id="presence_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>
                                    Hari / Tanggal
                                </th>
                                <th>
                                    Jam Masuk
                                </th>
                                <th>
                                    Jam Keluar
                                </th>
                                <th>
                                    Approval
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script></script>
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
            var table = $('#presence_table').DataTable({
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    url: '{!! route('attendance.ajax.presence.datatables') !!}',
                    data: {
                        'user_id': {{ request()->route()->parameters['id'] }},
                    },
                    dataType: 'json',
                    type: 'POST'
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
                        data: 'period',
                        name: 'period'
                    },
                    {
                        data: 'clock_in',
                        name: 'clock_in'
                    },
                    {
                        data: 'clock_out',
                        name: 'clock_out'
                    },
                    {
                        data: 'action',
                        name: 'action'
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
