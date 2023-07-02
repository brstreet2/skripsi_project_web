@extends('backend.layout.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <h5 class="font-mpb text-color-primary">
                <strong>KARYAWAN</strong>
            </h5>
        </div>

        <div class="card" style="border: none; background-color: #fcfcfc; border-radius: .5rem">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="/employee/add">
                    <button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" style="background-color: #444EFF">Add
                        New</button>
                    </a>
                </div>
                <table id="employee_table" class="table table-borderless text-center" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center font-mp">&nbsp;</th>
                            <th class="text-center font-mp">Nama Karyawan</th>
                            <th class="text-center font-mp">Pekerjaan</th>
                            <th class="text-center font-mp">Action</th>
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
                <form action="{{ route('employee.store') }}" method="POST">
                    <div class="modal-content" style="border-radius: 15px">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Form Tambah Karyawan</h5>
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}
                            <div class="form-group mb-2">
                                <label for="namaKaryawan">Nama <span class="text-danger">*</span></label></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="namaKaryawan" aria-describedby="namaHelp" name="name"
                                    placeholder="Nama Karyawan">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-2">
                                <label for="emailKaryawan">Nomor Telepon <span class="text-danger">*</span></label></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="no_telp" aria-describedby="emailHelp" name="phone"
                                    placeholder="No. Telephone Karyawan">
                            </div>
                            @error('phone')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-2">
                                <label for="emailKaryawan">Pekerjaan <span class="text-danger">*</span></label></label>
                                <input type="text" class="form-control @error('job_title') is-invalid @enderror"
                                    id="no_telp" aria-describedby="emailHelp" name="job_title" placeholder="(contoh: kasir)">
                            </div>
                            @error('job_title')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-2">
                                <label for="emailKaryawan">Email <span class="text-danger">*</span></label></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="emailKaryawan" aria-describedby="emailHelp" name="email"
                                    placeholder="Email Karyawan">
                                <small class="text-danger">* Digunakan untuk masuk ke aplikasi mobile TimKerjaKu.</small>
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="passwordKaryawan">Password <span class="text-danger">*</span></label></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="passwordKaryawan" name="password" placeholder="Password minimal 8 karakter">
                                <small class="text-danger">* Digunakan untuk masuk ke aplikasi mobile TimKerjaKu.</small>
                            </div>
                            @error('password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-secondary rounded-pill"
                                data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary rounded-pill"
                                style="background-color: #444eff">Simpan</button>
                        </div>

                    </div>
            </div>
            </form>
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
                    url: '{!! route('employee.ajax.datatables') !!}',
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
                        data: 'job_title',
                        name: 'job_title'
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
