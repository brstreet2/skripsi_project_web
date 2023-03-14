@extends('layouts.layout')

@section('content')
  <form action="{{ route('register.post') }}" method="POST">
    {{ csrf_field() }}
      <div class="card">
          <div class="row g-0">
              <div class="col">
                <div class="card registerimg">

                </div>
              </div>
              <div class="col">
                  <div class="card px-4 py-3 border">
                      <h2 class="text-center mt-4 mb-4">Daftar Akun</h2>
                      <form>
                            <div class="form-group mb-3">
                              <label for="inputName">Nama</label>
                              <input type="text" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Masukkan Nama Anda">
                            </div>
                            <div class="form-group mb-3">
                              <label for="inputEmail">Email</label>
                              <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="example@email.com">
                            </div>
                            <div class="form-group mb-2">
                              <label for="inputPassword">Password</label>
                              <input type="password" class="form-control" id="inputPassword" placeholder="Minimal 8 Karakter">
                            </div>
                            <div class="form-check mb-5">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Saya telah membaca dan menyetujui <a href="#">Syarat dan Ketentuan</a> yang berlaku</label>
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col d-grid"><button type="submit" id="btndaftar" class="btn btn-block btn-primary rounded-pill">Submit</button></div>
                                <div class="col"></div>
                            </div>

                        </form>
                  </div>
              </div>
          </div>
      </div>
  </form>
@endsection
  
    @push('scripts')

    <script>
      $(document).ready(function () {
        $('#submitBtn').prop('disabled', true);
        $('#termCondition').click(function () {
          var state = $(this)[0].checked;

          if (state === true) {
            $('#submitBtn').prop('disabled', false);
          } else if(state === false) {
            $('#submitBtn').prop('disabled', true);
          }
        });
      });
    </script>

    @endpush
  
