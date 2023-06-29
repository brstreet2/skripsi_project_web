@extends('backend.layout.layout')

@section('content')
    <div class="row mb-4">
        <h5 class="font-mpb text-color-primary">
            <strong>BUAT DOKUMEN</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Mohon mengisi form di bawah ini</p>

        <div class="card" style="border-radius: .75rem; border: none; background-color: #fcfcfc;">
            <div class="card-body">
                
                <form action="{{ route('document.store') }}" class="needs-validation" method="POST">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-3">
                        <div class="form-group has-danger">
                            <label for="document_name">Nama Dokumen <span style="color: red">*</span></label>
                            <input type="text" class="form-control mb-2" name="document_name" required id="document_name"
                                placeholder="Masukkan Nama Dokumen" style="border-radius: .5rem">
                            <div class="invalid-feedback">
                                Mohon cantumkan nama dokumen
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Dokumen<span style="color: red">*</span></label>
                            <textarea class="form-control" name="description" required id="description" placeholder="Deskripsi Isi Dokumen" style="height: 20rem; border-radius: .5rem"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="content">Isi Dokumen<span style="color: red">*</span></label>
                            <textarea class="form-control" id="summernote" name="content" rows="3" required></textarea>
                        </div>
                        <div class="text-end mt-3">
                            <a href="{{ route('document.index') }}">
                                <button class="btn rounded-pill px-5 fw-bolder" type="button" style="color:#E80015">Kembali</button>
                            </a>
                            <button class="btn rounded-pill text-center btn-primary px-5 py-2 fw-bolder" type="submit" style="background-color: #444EFF">Simpan</button>
                        </div>
                    </div>
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
    </script>
@endpush
