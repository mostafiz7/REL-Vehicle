@extends('layouts.app')

{{--@section('title', 'Password-Change')--}}

@section('content')
<div class="Page PasswordChange">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        {{-- <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Password Change</h5>
        </div> --}}


        <div class="card-body page-body">
          <div class="passwordChange-area p-30 overlay-scrollbar">
            <h5 class="mb-30">Password Change</h5>

            <form method="POST" action="{{ route('profile.password.change') }}" name="PasswordChangeForm" id="PasswordChangeForm" class="passwordChange-form">
              @csrf
              {{-- @method('PUT') --}}

              <div class="row mb-30">

                <div class="col-lg-6">
                  {{--OLD-Password--}}
                  <div class="mb-30 old-password">
                    <label for="old_password" class="required"><span>Old Password</span></label>
                    <div class="input-group p-relative">
                      <input type="password" name="old_password" id="old_password" class="required form-control border-secondary brd-3 z-index-9 @error('old_password') is-invalid @enderror" placeholder="Old Password" />
                      <label for="" class="input-label-icon show-password p-absolute pos-top-right text-secondary fz-19 lh-1-2 pr-7 pt-5 cur-pointer z-index-11 @error('old_password') mr-30 @enderror"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Show password">
                        <i class="fa fa-eye"></i>
                      </label>
                    </div>

                    @if ( $errors->has('old_password') )
                      <div class="text-danger fw-bold" role="alert">
                        {{ $errors->first('old_password') }}
                      </div>
                    @endif
                  </div>

                  {{--New-Password--}}
                  <div class="mb-30 new-password">
                    <label for="password" class="required"><span>New Password</span></label>
                    <div class="input-group p-relative">
                      <input type="password" name="password" id="password" class="required form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="New Password" />
                      <label for="" class="input-label-icon show-password p-absolute pos-top-right text-secondary fz-19 lh-1-2 pr-7 pt-5 cur-pointer z-index-11 @error('password') mr-30 @enderror"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Show password">
                        <i class="fa fa-eye"></i>
                      </label>
                    </div>
                    
                    @if ( $errors->has('password') )
                      <div class="text-danger fw-bold" role="alert">
                        {{ $errors->first('password') }}
                      </div>
                    @endif

                    <div class="color-dark fz-14 lh-1 pt-5 info">Min 8 character</div>
                  </div>

                  {{--Confirm-Password--}}
                  <div class="mb-30 password-confirmation">
                    <label for="" class="required"><span>Confirm New Password</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="required form-control border-secondary brd-3 @error('password') is-invalid @enderror" placeholder="Retype new password" />

                    @if ( $errors->has('password') )
                      <div class="text-danger fw-bold" role="alert">
                        {{ $errors->first('password') }}
                      </div>
                    @endif
                  </div>


                  {{--Submit--}}
                  <div class="my-50">
                    <button type="submit" class="btn btn-success px-30">Change Password</button>
                  </div>

                </div>
              </div>


              {{--Hidden input for user ID--}}
              <input type="hidden" value="{{ $user->id }}" name="userId" id="userId" class="visually-hidden" />

            </form>
            
          </div> {{-- ./page-content-area --}}
        </div> {{-- ./card-body --}}
      </div> {{-- ./card --}}
    </div> {{-- ./page-content --}}
  </div> {{-- ./container --}}
</div> {{-- ./Page View-Name --}}
@endsection



@section('custom-script')
<script>

  // Showing Session Error or Success Message
  let sessionError = null, sessionSuccess = null;

  @if ( session('error') )
    sessionError = @json( session('error') );
  @elseif ( session('success') )
    sessionSuccess = @json( session('success') );
  @endif

  if( sessionError ){
    Swal.fire({
      icon: 'error',
      title: 'Oops! Sorry.',
      text: sessionError,
    });
  } else if( sessionSuccess ){
    Swal.fire({
      icon: 'success',
      title: 'Thank You!',
      text: sessionSuccess,
    });
  }


</script>
@endsection