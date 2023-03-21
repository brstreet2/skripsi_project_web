@extends('backend.layout.layout')

@section('content')
  <div class="row">
    <h5 class="font-mpb text-color-primary">
      <strong>DOCUMENT</strong>
    </h5>
    <p style="font-size: 16px">Documents listed below are document templates that has been created.</p>

    <div class="card shadow" style="border: none; background-color: ">
      <div class="card-body">
        <a href="{{ route('document.create') }}">
          <button class="btn btn-primary btn-sm fw-bolder mb-4 px-5 rounded-pill shadow">Add New</button>
        </a>
        <a href="{{ route('document.create') }}">
          <button class="btn btn-danger btn-sm fw-bolder mb-4 px-5 rounded-pill shadow">Delete Bulk</button>
        </a>
        <table id="documentTable" class="table table-borderless text-center" style="width: 100%">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">&nbsp;</th>
              <th class="text-center">Document Name</th>
              <th class="text-center">Document Category</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>

  </div>
@endsection

@push('css')
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css" rel="stylesheet">
@endpush

@push('scripts')
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
  
  <script>
    $(document).ready(function () {
      var table = $('#documentTable').DataTable({
        ajax: {
            url: '{!! route('document.ajax.datatables') !!}',
            dataType: 'json'
        },
        columns: [
            {data: 'id', name: 'id', visible: false},
            {
                data: 'checkbox', name: 'checkbox', orderable: false, searchable: false,
                checkboxes: true
            },
            {data: 'document_name', name: 'document_name'},
            {data: 'description', name: 'description'},
            {
                data: 'action', name: 'action', orderable: false, searchable: false
            }
        ],
        select: {
            style: 'multi'
        },      
      });
    });
  </script>
@endpush