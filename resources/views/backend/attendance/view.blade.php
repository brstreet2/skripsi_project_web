@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <h5 class="font-mpb mb-3 text-color-primary">
            <strong>Kehadiran - {{ $user->name }}</strong>
        </h5>

        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <div class="dropdown">
                            <select class="form-control" type="button" id="monthDropdown">
                                <option value="{{ Carbon\Carbon::now()->format('m') }}" selected disabled readonly>
                                    {{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('F') }}</option>
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
                    <table id="presence_table" class="table table-borderless text-center" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">&nbsp;</th>
                                <th class="text-center">
                                    Hari / Tanggal
                                </th>
                                <th class="text-center">
                                    Jam Masuk
                                </th>
                                <th class="text-center">
                                    Jam Keluar
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Action
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
                    data: function(d) {
                        d.user_id = {{ request()->route()->parameters['id'] }},
                            d.current_month = {{ Carbon\Carbon::now()->format('m') }},
                            d.select_month = $('#monthDropdown').val();
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
                        data: 'status',
                        name: 'status'
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

            $('#monthDropdown').change(function() {
                table.draw();
            });

            $(document).on('click', '#approveBtn', function() {
                var guyName = $(this).data('name');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    method: "POST",
                    url: "{{ route('attendance.approve') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': $(this).data('id'),
                    },
                    success: function(data) {
                        Swal.fire('Data berhasil disimpan', '', 'success')
                        table.draw();
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

            $(document).on('click', '#rejectBtn', function() {
                var guyName = $(this).data('name');
                Swal.fire({
                    title: 'Tolak presensi ' + guyName + ' ?',
                    text: "Tolong berikan alasan penolakan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Kembali',
                    confirmButtonText: 'Ya',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            input: 'textarea',
                            inputLabel: 'Message',
                            inputPlaceholder: 'Type your message here...',
                            inputAttributes: {
                                'aria-label': 'Type your message here'
                            },
                            showCancelButton: true
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    method: "POST",
                                    url: "{{ route('attendance.reject') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        'id': $(this).data('id'),
                                        'status_string': result.value,
                                    },
                                    success: function(data) {
                                        Swal.fire('Data berhasil disimpan', '',
                                            'success')
                                        table.draw();
                                    },
                                    error: function(data) {
                                        console.log("Error Status: ", data
                                            .status);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Terjadi kesalahan ...!',
                                            width: '28em'
                                        })
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Input penolakan tidak boleh kosong.',
                                    width: '28em'
                                })
                            }
                        })
                    }
                })

            });

            $(document).on('click', '#showBtn', function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    method: "POST",
                    url: "{{ route('attendance.reason') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': $(this).data('id'),
                    },
                    success: function(data) {
                        Swal.fire(
                            'Alasan Penolakan:',
                            '' + data.data,
                            'info'
                        )
                    },
                    error: function(data) {
                        console.log("Error Status: ", data
                            .status);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan ...!',
                            width: '28em'
                        })
                    }
                });
            });

            $(document).on('click', '#editBtn', function() {
                Swal.fire({
                    title: 'Ubah status',
                    input: 'select',
                    inputOptions: {
                        1: "Diterima",
                        2: "Ditolak"
                    },
                    inputPlaceholder: 'Pilih status',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value === "1") {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr('content')
                                },
                                method: "POST",
                                url: "{{ route('attendance.approve') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': $(this).data('id'),
                                },
                                success: function(data) {
                                    Swal.fire('Data berhasil disimpan', '', 'success')
                                    table.draw();
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
                        } else if (result.value === "2") {
                            Swal.fire({
                                input: 'textarea',
                                inputLabel: 'Message',
                                inputPlaceholder: 'Type your message here...',
                                inputAttributes: {
                                    'aria-label': 'Type your message here'
                                },
                                showCancelButton: true
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        method: "POST",
                                        url: "{{ route('attendance.reject') }}",
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            'id': $(this).data('id'),
                                            'status_string': result.value,
                                        },
                                        success: function(data) {
                                            Swal.fire('Data berhasil disimpan',
                                                '',
                                                'success')
                                            table.draw();
                                        },
                                        error: function(data) {
                                            console.log("Error Status: ", data
                                                .status);
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Terjadi kesalahan ...!',
                                                width: '28em'
                                            })
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Input penolakan tidak boleh kosong.',
                                        width: '28em'
                                    })
                                }
                            })
                        }
                    }
                })
            });
        });
    </script>
@endpush
