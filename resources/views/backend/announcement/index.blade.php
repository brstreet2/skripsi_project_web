@extends('backend.layout.layout')

@section('content')
    <div class="row mb-4">
        <h5 class="font-mpb text-color-primary">
            <strong>BUAT PENGUMUMAN</strong>
        </h5>
        <p class="mb-3" style="font-size: 16px">Mohon mengisi form di bawah ini</p>
        <div class="row">
            <div class="col-md-8 col-sm-12">
        <div class="card" style="border-radius: .75rem; border: none; background-color: #fcfcfc;">
            <div class="card-body">
                
                <form action="{{ route('document.store') }}" class="needs-validation" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group has-danger mb-2">
                        <label for="document_name">Judul Pengumuman<span style="color: red">*</span></label>
                        <input type="text" class="form-control mb-2" name="announcement_name" required id="announcement_name"
                            placeholder="Masukkan Judul Pengumuman" style="border-radius: .5rem">
                        <div class="invalid-feedback">
                            Mohon cantumkan judul untuk pengumuman anda
                        </div>
                    </div>
                        <div class="form-group has-danger mb-2">
                            <label for="document_name">Tanggal dibuat</label>
                            <input id="date-time" type="text" class="form-control mb-2"
                                value="" style="border-radius: .5rem" readonly>
                        </div>
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
            placeholder: 'Masukan Isi Pengumuman',
            tabsize: 2,
            height: 350,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
            ]
        });
    </script>

    <script>
    var dt = new Date();
    document.getElementById('date-time').value = (("0"+dt.getDate()).slice(-2)) +"/"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (dt.getFullYear()) +" "+"-"+" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));;
    </script>
@endpush
