@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card h-auto mt-80">
        <div class="card-header fz-20 fw-500 py-10">
          {{ __('Register') }}
        </div>

        <div class="card-body py-50">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row mb-20">
              <label for="name" class="col-md-4 col-form-label text-md-end">
                <span>{{ __('Name') }}</span>
              </label>

              <div class="col-md-6">
                <input type="text" name="name" id="name" class="required form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus required />

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-20">
              <label for="email" class="col-md-4 col-form-label text-md-end">
                <span>{{ __('E-Mail Address') }}</span>
              </label>

              <div class="col-md-6">
                <input type="email" name="email" id="email" class="required form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" required />

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-20">
              <label for="password" class="col-md-4 col-form-label text-md-end">
                <span>{{ __('Password') }}</span>
              </label>

              <div class="col-md-6">
                <input type="password" name="password" id="password" class="required form-control @error('password') is-invalid @enderror" autocomplete="new-password" required />

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-20">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                <span>{{ __('Confirm Password') }}</span>
              </label>

              <div class="col-md-6">
                <input type="password" name="password_confirmation" id="password-confirm" class="required form-control" autocomplete="new-password" required />
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
