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
                          <div class="control @if($errors->has('name')) has-error @endif">
                              <input class="input @if($errors->has('name')) is-danger @endif" type="text" name="name" placeholder="Masukkan Nama Anda">
                          </div>
                          {!! $errors->first('name', '<p for="name" class="help is-danger">:message</p>') !!}
                      </div>

                      <div class="field">
                          <label class="label">Email</label>
                          <div class="control has-icons-left has-icons-right @if($errors->has('email')) has-error @endif">
                              <input class="input @if($errors->has('email')) is-danger @endif" type="email" name="email" placeholder="example@email.com">
                              <span class="icon is-small is-left">
                                  <i class="fas fa-user"></i>
                              </span>
                              <span class="icon is-small is-right">
                                  <i class="fas fa-check"></i>
                              </span>
                          </div>
                          {!! $errors->first('email', '<p for="email" class="help is-danger">:message</p>') !!}
                      </div>

                      <div class="field">
                          <label class="label">Password</label>
                          <div class="control has-icons-left has-icons-right @if($errors->has('password')) has-error @endif">
                              <input class="input @if($errors->has('password')) is-danger @endif" type="password" name="password" placeholder="Minimal 8 Karakter ">
                              <span class="icon is-small is-left">
                                  <i class="fas fa-envelope"></i>
                              </span>
                              <span class="icon is-small is-right">
                                  <i class="fas fa-exclamation-triangle"></i>
                              </span>
                          </div>
                          {!! $errors->first('password', '<p for="password" class="help is-danger">:message</p>') !!}
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
  
