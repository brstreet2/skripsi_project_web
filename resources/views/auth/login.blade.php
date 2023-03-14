@extends('layouts.layout')

@section('content')
          <div class="card has-background-link p-4">
            <div class="columns">
                <div class="column">

                </div>
                <div class="column">
                    <div class="card px-6 p-5">
                        <h1 class="title has-text-weight-bold has-text-centered	mt-5">Masuk</h1>

                          <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left has-icons-right">
                              <input class="input is-danger" type="email" placeholder="example@email.com">
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
                            <label class="label">Password</label>
                            <div class="control has-icons-left has-icons-right">
                              <input class="input" type="password" placeholder="Minimal 8 Karakter">
                            </div>
                          </div>


                          <div class="field has-text-centered mt-5 mb-5">
                            <div class="control">
                              <button class="button is-link is-rounded is-responsive has-text-weight-semibold"
                              style="width: 15rem" type="submit" id="submitBtn">Masuk</button>
                            </div>
                    </div>
                </div>
            </div>
          </div>
@endsection
