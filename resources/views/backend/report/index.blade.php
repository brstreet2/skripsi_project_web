@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <h5 class="font-mpb mb-3 text-color-primary">
            <strong>Laporan</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Laporan Bulan:
            <strong class="fw-bold">{{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('F') }}</strong>
        </p>
        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2">
                        <div class="dropdown">
                            <label for="employeeSelect">Nama Karyawan <span style="color: red">*</span></label>
                            <select class="form-control" type="button" id="employeeSelect" name="employeeSelect">
                                <option value="999" selected disabled readonly>
                                    Pilih Karyawan ...
                                </option>
                                @if ($employee != null)
                                    @foreach ($employee as $karyawan)
                                        <option value="{{ $karyawan->user->id }}">{{ $karyawan->user->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" selected disabled readonly>
                                        Pilih Karyawan ...
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row mb-4">
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
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row mt-4">
                    <table id="timeoff_table" class="table table-borderless text-center" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">&nbsp;</th>
                                <th class="text-center">
                                    Tipe
                                </th>
                                <th class="text-center">
                                    Tanggal Mulai
                                </th>
                                <th class="text-center">
                                    Tanggal Akhir
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ asset('plugins/jquery-datatables-checkboxes/css/dataTables.checkboxes.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('plugins/jquery-datatables-checkboxes/js/dataTables.checkboxes.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var userSlug = '';
            var userName = '';
            var userDate = '{{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('F') }}';
            var userDateLower = userDate.toLowerCase();
            var table = $('#presence_table').DataTable({
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    url: '{!! route('report.ajax.datatables.present') !!}',
                    data: function(d) {
                        d.user_id = $('#employeeSelect').val(),
                            d.current_month = {{ Carbon\Carbon::now()->format('m') }}
                    },
                    dataType: 'json',
                    dataSrc: function(json) {
                        if (!json.data) {
                            return [];
                        } else {
                            return json.data;
                        }
                    },
                    type: 'POST'
                },
                serverSide: true,
                order: [0, 0],
                columnDefs: [{
                    targets: 0,
                    checkboxes: {
                        selectRow: true
                    },
                }],
                dom: 'Bfrtip',
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
                ],
                select: {
                    style: 'multi'
                },
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Laporan Kehadiran Bulan: ' + userDate,
                        className: 'buttons-datatables',
                        filename: function() {
                            return 'laporan_kehadiran' + userSlug + '_bulan_' + userDateLower;
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Laporan Kehadiran Bulan: ' + userDate,
                        className: 'buttons-datatables',
                        filename: function() {
                            return 'laporan_kehadiran' + userSlug + '_bulan_' + userDateLower;
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Laporan Kehadiran Bulan: ' + userDate,
                        className: 'buttons-datatables',
                        pageSize: 'LEGAL',
                        orientation: 'landscape',
                        customize: function(doc) {
                            doc.content[1].margin = [375, 0, 375, 0];
                        },
                        filename: function() {
                            return 'laporan_kehadiran' + userSlug + '_bulan_' + userDateLower;
                        }
                    }
                ],
                drawCallback: function() {
                    var hasRows = this.api().rows({
                        filter: 'applied'
                    }).data().length > 0;
                    $('.buttons-datatables')[0].style.visibility = hasRows ? 'visible' : 'hidden'
                    $('.buttons-datatables')[1].style.visibility = hasRows ? 'visible' : 'hidden'
                    $('.buttons-datatables')[2].style.visibility = hasRows ? 'visible' : 'hidden'
                }
            });

            var table2 = $('#timeoff_table').DataTable({
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    url: '{!! route('report.ajax.datatables.timeoff') !!}',
                    data: function(d) {
                        d.user_id = $('#employeeSelect').val(),
                            d.current_month = {{ Carbon\Carbon::now()->format('m') }}
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
                    },
                }],
                dom: 'Bfrtip',
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: true
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ],
                select: {
                    style: 'multi'
                },
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Laporan Cuti/Izin Bulan: ' + userDate,
                        className: 'buttons-datatables',
                        filename: function() {
                            return 'laporan_cuti_izin_' + userSlug + '_bulan_' + userDateLower;
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Laporan Cuti/Izin Bulan: ' + userDate,
                        className: 'buttons-datatables',
                        filename: function() {
                            return 'laporan_cuti_izin_' + userSlug + '_bulan_' + userDateLower;
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Laporan Cuti/Izin Bulan: ' + userDate,
                        className: 'buttons-datatables',
                        pageSize: 'LEGAL',
                        orientation: 'landscape',
                        customize: function(doc) {
                            doc.content[1].margin = [375, 0, 375, 0];
                        },
                        filename: function() {
                            return 'laporan_cuti_izin_' + userSlug + '_bulan_' + userDateLower;
                        }
                    }
                ],
                drawCallback: function() {
                    var hasRows = this.api().rows({
                        filter: 'applied'
                    }).data().length > 0;
                    $('.buttons-datatables')[0].style.visibility = hasRows ? 'visible' : 'hidden'
                    $('.buttons-datatables')[1].style.visibility = hasRows ? 'visible' : 'hidden'
                    $('.buttons-datatables')[2].style.visibility = hasRows ? 'visible' : 'hidden'
                }
            });

            $('#employeeSelect').change(function() {
                table.draw();
                table2.draw();
                userName = $('#employeeSelect').find(":selected").text();
                userSlug = slugify(userName);
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

            function slugify(str) {
                return String(str)
                    .normalize('NFKD') // split accented characters into their base characters and diacritical marks
                    .replace(/[\u0300-\u036f]/g,
                        '') // remove all the accents, which happen to be all in the \u03xx UNICODE block.
                    .trim() // trim leading or trailing whitespace
                    .toLowerCase() // convert to lowercase
                    .replace(/[^a-z0-9 -]/g, '') // remove non-alphanumeric characters
                    .replace(/\s+/g, '-') // replace spaces with hyphens
                    .replace(/-+/g, '-'); // remove consecutive hyphens
            }
        });
    </script>
@endpush
