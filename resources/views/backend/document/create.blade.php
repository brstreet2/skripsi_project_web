@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>DOCUMENT - CREATE TEMPLATE</strong>
        </h5>
        <p style="font-size: 16px">Please fill the form below.</p>

        <div class="card shadow" style="border: none;">
            <div class="card-body">
                <form action="{{ route('document.store') }}" class="needs-validation" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group has-danger">
                        <label for="document_name">Document Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="document_name" required id="document_name"
                            placeholder="name@example.com">
                        <div class="invalid-feedback">
                            Please provide a name for your document.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Document Description <span style="color: red">*</span></label>
                        <textarea class="form-control" name="description" required id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Document Content <span style="color: red">*</span></label>
                        <textarea class="form-control" id="summernote" name="content" rows="3" required></textarea>
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('document.index') }}">
                            <button class="btn btn-sm btn-secondary px-3 fw-bolder" type="button">Back</button>
                        </a>
                        <button class="btn text-center btn-sm btn-primary px-3 fw-bolder" type="submit">Save</button>
                    </div>

            </div>
            </form>
        </div>
    </div>

    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 350,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $(document).ready(function() {
            var table = $('#documentTable');
            table.DataTable();
        });
    </script>
@endpush
