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
        <a href="#">
          <button class="btn btn-danger btn-sm fw-bolder mb-4 px-5 rounded-pill shadow" id="deleteBulk">Delete Bulk</button>
        </a>
        <table id="documentTable" class="table table-borderless text-center" style="width: 100%">
          <thead>
            <tr>
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
  <form action="{{ route('document.destroy.bulk') }}" id="invisibleBulk" method="POST">
    @csrf
  </form>
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
  
  <script>
    $(document).ready(function () {
      var table = $('#documentTable').DataTable({
        ajax: {
            url: '{!! route('document.ajax.datatables') !!}',
            dataType: 'json'
        },
        serverSide: true,
        order: [0,0],
        columnDefs: [{
          targets: 0,
          checkboxes: {
            selectRow: true
          }
        }],
        columns: [
            {data: 'id', name: 'id', visible: true},
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

      $('#deleteBulk').click(function (e) {
        let form = $('#invisibleBulk');
        var rowSelected = table.column(0).checkboxes.selected();
        $.each(rowSelected, function (index, rowId){
          $(form).append(
            $('<input>')
              .attr('type', 'hidden')
              .attr('name', 'id[]')
              .val(rowId)
          );
          $(form).submit();
        });

      });
    });
  </script>
@endpush