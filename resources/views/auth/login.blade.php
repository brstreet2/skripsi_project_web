@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row g-0">
        <div class="col">
          <div class="card registerimg">

          </div>
        </div>
        <div class="col">
            <div class="card px-4 py-3 border">
                <h2 class="text-center mt-4 mb-4">Masuk</h2>
                <form method="POST" action="{{ route('auth.register.post') }}">
                  {{ csrf_field() }}
                      <div class="form-group mb-3">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp" placeholder="example@email.com">
                      </div>
                      <div class="form-group mb-2">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Minimal 8 Karakter">
                      </div>
                      <div class="row mt-3">
                          <div class="col"></div>
                          <div class="col d-grid"><button type="submit" id="submitBtn" class="btn btn-block btn-primary rounded-pill">Masuk</button></div>
                          <div class="col"></div>
                      </div>
                  </form>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
