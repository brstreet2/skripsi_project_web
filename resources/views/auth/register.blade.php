@extends('layouts.layout')

@section('content')
  <form action="{{ route('register.post') }}" method="POST">
    {{ csrf_field() }}
      <div class="card has-background-link p-4">
          <div class="columns">
              <div class="column">

              </div>
              <div class="column">
                  <div class="card px-6 py-5">
                      <h1 class="title has-text-weight-bold has-text-centered	mt-5">Daftar Akun</h1>
                      <div class="field">
                          <label class="label">Name</label>
                          <div class="control">
                              <input class="input" type="text" name="name" placeholder="Masukkan Nama Anda">
                          </div>
                      </div>

                      <div class="field">
                          <label class="label">Email</label>
                          <div class="control has-icons-left has-icons-right">
                              <input class="input" type="email" name="email" placeholder="example@email.com">
                              <span class="icon is-small is-left">
                                  <i class="fas fa-user"></i>
                              </span>
                              <span class="icon is-small is-right">
                                  <i class="fas fa-check"></i>
                              </span>
                          </div>
                          {{-- <p class="help is-success">This username is available</p> --}}
                      </div>

                      <div class="field">
                          <label class="label">Password</label>
                          <div class="control has-icons-left has-icons-right">
                              <input class="input" type="password" name="password" placeholder="Minimal 8 Karakter ">
                              <span class="icon is-small is-left">
                                  <i class="fas fa-envelope"></i>
                              </span>
                              <span class="icon is-small is-right">
                                  <i class="fas fa-exclamation-triangle"></i>
                              </span>
                          </div>
                          {{-- <p class="help is-danger">This email is invalid</p> --}}
                      </div>

                      <div class="field">
                          <div class="control">
                              <label class="checkbox">
                                  <input type="checkbox" id="termCondition">
                                  I agree to the <a href="#">terms and conditions</a>
                              </label>
                          </div>
                      </div>

                      <div class="field has-text-centered mt-5 mb-5">
                          <div class="control">
                              <button class="button is-link is-rounded is-responsive has-text-weight-semibold"
                                  style="width: 15rem" type="submit" id="submitBtn">Daftar</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </form>
@endsection
  
    @push('scripts')

    <script>
      $(document).ready(function () {
        $('#submitBtn').attr('disabled', true);
        $('#termCondition').click(function () {
          if($(this.checked)) {
            $('#submitBtn').attr('disabled', false);
          } else {
            $('#submitBtn').attr('disabled', true);
          }
        });
      });
    </script>

    @endpush
  
