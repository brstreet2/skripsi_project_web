@extends('backend.layout.layout')

@section('content')
    <div class="row">
        <h5 class="font-mpb text-color-primary">
            <strong>DOCUMENT - {{ $documentDb->name }}</strong>
        </h5>

        <div class="card shadow" style="border: none;">
            <div class="card-body">
                {{-- <div class="form-group has-danger">
                    <label for="document_name">Document Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="document_name" value="{{ old('document_name', $documentDb->name) }}" required id="document_name"
                        placeholder="name@example.com">
                </div>

                <div class="form-group">
                    <label for="description">Document Description <span style="color: red">*</span></label>
                    {!! $documentDb->description !!}
                </div>

                <div class="form-group">
                    <label for="content">Document Content <span style="color: red">*</span></label>
                    <iframe id="iframepdf" src="{{ $documentDb->url }}" height="600" width="800" loading="lazy"></iframe>
                </div> --}}


                <div class="row form-group mt-3">
                    <div class="col-2"><label for="document_name">Document Name :</label></div>
                    <div class="col-8"><input type="text" class="form-control" value="{{ $documentDb->name }}" required id="document_name" readonly>                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col"><label for="description">Document Description : </label></div>
                    <div class="col-8">
                        <div class="form-control" readonly>
                            {!! $documentDb->description !!}
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row form-group mt-3 ">
                    <div class="col"><label for="content">Document Content :</label></div>
                    <div class="col-8"><iframe class="content d-flex justify-content-center"id="iframepdf" src="{{ $documentDb->url }}" height="1030" width="700" loading="lazy" ></iframe></div>
                    <div class="col-2"></div>
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('document.index') }}">
                        <button class="btn btn-sm btn-secondary px-3 fw-bolder" type="button">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
