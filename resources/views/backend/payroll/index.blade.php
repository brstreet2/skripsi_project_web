@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <h5 class="font-mpb mb-2 text-color-primary">
            <strong>SLIP GAJI</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Slip Gaji Bulan:
            <strong class="fw-bold">{{ Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('F') }}</strong>
        </p>
        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <table id="employee_table" class="table table-borderless text-center" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center font-mp">&nbsp;</th>
                            <th class="text-center font-mp">Nama Karyawan</th>
                            <th class="text-center font-mp">Status</th>
                            <th class="text-center font-mp">Unggah</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 15px">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Upload Payroll Form</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group mb-3">
                                <label for="namaKaryawan">Document Name</label>
                                <input type="text" class="form-control" id="namaKaryawan" aria-describedby="namaHelp"
                                    placeholder="Input Document Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="formFile" class="form-label">Upload Document</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-secondary rounded-pill"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary rounded-pill"
                            style="background-color: #444eff">Save</button>
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
            var table = $('#employee_table').DataTable({
                ajax: {
                    url: '{!! route('payroll.ajax.datatables') !!}',
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
                        data: 'user_id',
                        name: 'user_id',
                        visible: true
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
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
                                    'id': id
                                },
                                dataType: 'text',
                                success: function(response) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Data successfully deleted!',
                                        showConfirmButton: false,
                                        timer: 15004,
                                        width: '28em',
                                    })
                                },
                                error: function(response) {
                                    console.log("Error Status: ", response
                                        .status);
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

            $(document).on('click', '#uploadButton', function() {
                var thisData = $('#uploadButton');
                Swal.fire({
                    title: 'Unggah slip gaji karyawan: ' + thisData.data('name') + '?',
                    html: '<input type="text" class="form-control" id="payrollName" aria-describedby="namaHelp" placeholder="Input payroll name">' +
                        '<input class="form-control mt-3" type="file" id="payrollFile">',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Upload',
                    width: '28em',
                    customClass: {
                        confirmButton: 'px-5 btn btn-sm',
                        cancelButton: 'px-5 btn btn-sm',
                    },
                    onBeforeOpen: () => {
                        $("#payrollFile").change(function() {
                            var reader = new FileReader();
                            reader.readAsDataURL(this.files[0]);
                        });
                    }
                }).then((file) => {
                    if (file.value) {
                        var formData = new FormData();
                        var fileName = $('#payrollName').val();
                        var file = $('#payrollFile')[0].files[0];
                        formData.append("user_id", thisData.data('id'))
                        formData.append("name", fileName);
                        formData.append("fileToUpload", file);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            processData: false,
                            contentType: false,
                            cache: false,
                            method: 'POST',
                            enctype: 'multipart/form-data',
                            data: formData,
                            url: '{{ route('payroll.store') }}',
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Payroll for ' + thisData.data(
                                        'name') + ' successfully uploaded!',
                                    showConfirmButton: false,
                                    timer: 15004,
                                    width: '28em',
                                })
                            },
                            error: function(response) {
                                console.log("Error Status: ", response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Harap lampirkan file slip gaji!',
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
