@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col mb-2 ">
            <div class="card border-0" style="border-radius: 2rem">
                <div class="row g-0">
                    <div class="col">
                        <div class="card px-4 py-3 border-0" style="border-radius: 1rem">
                            <h3 class="text-center mt-5 daftarakun">Lupa Password?</h3>
                            <p class="text-center">Silahkan isi form ini untuk memperbarui password.</p>
                            </h6>
                            <div class="row g-0 mt-3">
                                <div class="col">

                                </div>
                                <div class="col-10">
                                    <form method="POST" action="{{ route('auth.forgot.post') }}">
                                        {{ csrf_field() }}
                                        <label for="email" class="mb-1">Email</label>
                                        <div class="form-group mb-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="email" placeholder="example@email.com" required
                                                    style="border-radius: .75rem 0 0 .75rem">
                                            </div>
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="row mt-5 mb-5">
                                            <div class="col-2"></div>
                                            <div class="col d-grid"><button type="submit" id="submitBtn"
                                                    class="btn btn-block btnprimary rounded-pill"
                                                    style="font-weight: 700;
                                            height: 3rem;">Kirim</button>
                                            </div>
                                            <div class="col-2"></div>
                                        </div>


                                    </form>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>
@endsection
