@extends('layouts.app')

{{--@section('title', 'Add New User')--}}

@section('content')
<div class="Page User New">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">New User</h5>
        </div>
        
        
        <div class="card-body page-body p-0">
          <div class="user-new-area overlay-scrollbar">
            <p class="fw-bold m-20">Make a new user from registered Employee!</p>

            <form method="post" action="{{ route('user.add.new') }}"
              name="addUserForm" id="addUserForm" class="user-form new px-20">
              @csrf

              <div class="row">
                {{-- Employee-ID --}}
                <div class="col-md-6 col-12 mb-30 employee-id">
                  <label for="employee_id" class="required"><span>Employee Name</span></label>
                  <select name="employee_id" id="employee_id" class="required form-select border-secondary brd-3 @error('employee_id') is-invalid @enderror">
                    <option value="">Select Employee</option>
                    @if ( $employees )
                      @foreach ( $employees as $employee )
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('employee_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('employee_id') }}
                    </div>
                  @endif

                  @if ( session('not-employee') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ session('not-employee') }}
                    </div>
                  @endif
                </div>

                {{-- Username --}}
                <div class="col-md-6 col-12 mb-30 username">
                  <label for="username" class="required"><span>Username</span></label>
                  <input type="text" name="username" id="username" class="required form-control border-secondary brd-3 @error('username') is-invalid @enderror" placeholder="nurullah" value="{{ old('username') }}" />

                  @if ( $errors->has('username') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('username') }}
                    </div>
                  @endif
                </div>

                {{-- Email --}}
                <div class="col-md-6 col-12 mb-30 email">
                  <label for="email" class=""><span>Email</span></label>
                  <input type="email" name="email" id="email" class="form-control border-secondary brd-3 @error('email') is-invalid @enderror" placeholder="nurullah@rangs.app" value="{{ old('email') }}" />

                  @if ( $errors->has('email') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>

                {{-- Blank-Space --}}
                <div class="col-md-6 d-md-block d-none mb-30 blank-space"></div>

                {{-- Password --}}
                <div class="col-md-6 col-12 mb-30 password">
                  <label for="password" class="required"><span>Password</span></label>
                  <div class="input-group p-relative">
                    <input type="password" name="password" id="password" 
                    class="required form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="Password" />
                    <label for="" class="input-label-icon show-password p-absolute pos-top-right text-secondary fz-19 lh-1-2 pr-7 pt-5 cur-pointer z-index-11 @error('password') mr-30 @enderror"
                      data-bs-toggle="tooltip" data-bs-placement="top" title="Show password">
                      <i class="fa fa-eye"></i>
                    </label>
                  </div>

                  @if ( $errors->has('password') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>

                {{-- Confirm-Password --}}
                <div class="col-md-6 col-12 mb-30 password-confirmation">
                  <label for="password_confirmation" class="required"><span>Confirm Password</span></label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="required form-control border-secondary brd-3 @error('password') is-invalid @enderror" placeholder="Retype password" />

                  @if ( $errors->has('password') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>
                
                {{-- Role-ID --}}
                <div class="col-md-6 col-12 mb-30 role-id">
                  <label for="role_id" class="required"><span>User Role</span></label>
                  <select name="role_id" id="role_id" class="required form-select border-secondary brd-3 @error('role_id') is-invalid @enderror">
                    <option value="">Select Role</option>
                    @if ( $roles )
                      @foreach ( $roles as $role )
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('role_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('role_id') }}
                    </div>
                  @endif
                </div>
                
                {{-- Permissions --}}
                <div class="col-md-6 col-12 mb-30 permissions">
                  <label for="" class="required"><span>Permissions</span></label>

                  @if ( $errors->has('permissions') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('permissions') }}
                    </div>
                  @endif

                  @if ( $permissions )
                    <div class="" id="permissions">
                      <span class="form-check d-inline-block mr-20 mb-5">
                        <input type="checkbox" name="permission_all" id="permission_all" class="form-check-input cur-pointer permission select-all" value="all" />
                        <label for="permission_all" class="form-check-label cur-pointer">Select All</label>
                      </span>
                      
                      @foreach ( $permissions as $permission )
                        <span class="form-check d-inline-block mr-20 mb-5">
                          <input type="checkbox" name="permissions[]" id="permission-{{ $permission }}" class="form-check-input cur-pointer permission" value="{{ $permission }}" {{ old('permissions.*') == $permission ? 'checked' : '' }} />
                          <label for="permission-{{ $permission }}" class="form-check-label cur-pointer">{{ ucwords($permission) }}</label>
                        </span>
                      @endforeach
                    </div>
                  @endif
                </div>

                {{--Routes--}}
                <div class="col-12 mb-30 routes">
                  <label for="" class="required"><span>Route Access</span></label>

                  @if ( $errors->has('routes') )
                    <div class="text-danger fz-14 fw-bold mb-10" role="alert">
                      {{ $errors->first('routes') }}
                    </div>
                  @endif

                  @if ( $routes )
                    <div class="form-check mt-5 mb-10">
                      <input type="checkbox" name="routes_all" id="routes_all" class="form-check-input cur-pointer route select-all" value="all" />
                      <label for="routes_all" class="form-check-label cur-pointer">Select All</label>
                    </div>

                    <div class="row" id="routes">
                      @foreach ( $routes as $route )
                        <div class="col-3 form-check pl-35 pr-20 mb-10">
                          <input type="checkbox" name="routes[]" id="route-{{ $route }}"
                            class="form-check-input cur-pointer route" value="{{ $route }}" {{ $route == 'profile.password.change' || $route == 'admin.dashboard' ? 'checked' : '' }} />
                          <label for="route-{{ $route }}" class="form-check-label cur-pointer">{{ ucwords(str_replace(".", " ", $route)) }}</label>
                        </div>
                      @endforeach
                    </div>
                  @endif
                </div>


                {{-- Submit --}}
                <div class="col-12 mt-20 mb-50 text-end submit">
                  <div class="">
                    <button class="btn btn-primary">Submit</button>
                  </div>
                </div>

              </div> {{--/.row--}}
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