@extends('layouts.app')

{{--@section('title', 'Edit User')--}}

@section('content')
<div class="Page User Edit">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="title mb-0">Edit User</h5>

          <div class="">
            <a href="{{ route('user.add.new') }}" class="btn btn-light btn-sm fw-bold">
              New User
            </a>
            <a href="{{ route('user.all.index') }}" class="btn btn-light btn-sm fw-bold ml-5">
              User Index
            </a>
          </div>
        </div>
        
        
        <div class="card-body page-body p-0">
          <div class="user-edit-area overlay-scrollbar">
            <form method="post" action="{{ route('user.single.edit', $user->uid) }}"
              name="editUserForm" id="editUserForm" class="user-form edit p-20">
              @csrf

              <div class="row">
                {{-- Name --}}
                <div class="col-md-6 col-12 mb-30 name">
                  <label for="name" class="required w-100 fw-bold"><span>Name</span></label>
                  <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" value="{{ $user->name }}" />

                  @if ( $errors->has('name') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                {{--Status--}}
                <div class="col-md-6 col-12 mb-30 status">
                  <label for="" class="required w-100 fw-bold"><span>Status</span></label>
                  <div class="d-flex flex-wrap">
                    <span class="form-check ml-30">
                      <input type="radio" name="status" id="active" class="status form-check-input cur-pointer @error('status') is-invalid @enderror" value="active" {{ $user->active ? 'checked' : '' }} />
                      <label for="active" class="form-check-label brd-3 cur-pointer {{ $user->active ? 'bg-success text-white fw-bold py-1 px-10' : '' }}">Active</label>
                    </span>

                    <span class="form-check ml-30">
                      <input type="radio" name="status" id="not-active" class="status form-check-input cur-pointer @error('status') is-invalid @enderror" value="not-active" {{ $user->active ? '' : 'checked' }} />
                      <label for="not-active" class="form-check-label brd-3 cur-pointer {{ $user->active ? '' : 'bg-danger text-white fw-bold py-1 px-10' }}">Not-Active</label>
                    </span>
                  </div>

                  @if ( $errors->has('status') )
                    <div class="text-danger fw-bold" role="alert">
                      {{ $errors->first('status') }}
                    </div>
                  @endif
                </div>

                {{-- Username --}}
                <div class="col-md-6 col-12 mb-30 username">
                  <label for="" class="required w-100 fw-bold"><span>Username</span></label>
                  <input disabled type="text" name="username" id="username" class="form-control border-secondary brd-3 @error('username') is-invalid @enderror" value="{{ $user->username }}" />

                  <div class="text-danger fz-12">Username not-changeable</div>

                  @if ( $errors->has('username') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('username') }}
                    </div>
                  @endif
                </div>

                {{-- Email --}}
                <div class="col-md-6 col-12 mb-30 email">
                  <label for="email" class="required w-100 fw-bold"><span>Email</span></label>
                  <input type="email" name="email" id="email" class="required form-control border-secondary brd-3 @error('email') is-invalid @enderror" value="{{ $user->email }}" />

                  @if ( $errors->has('email') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>

                {{-- New-Password --}}
                <div class="col-md-6 col-12 mb-30 new-password">
                  <label for="password" class="w-100 fw-bold"><span>New Password</span></label>
                  <div class="input-group p-relative">
                    <input type="password" name="password" id="password" 
                    class="form-control border-secondary brd-3 z-index-9 @error('password') is-invalid @enderror" placeholder="Password" />
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

                {{-- Confirm-New-Password --}}
                <div class="col-md-6 col-12 mb-30 password-confirmation">
                  <label for="password_confirmation" class="w-100 fw-bold"><span>Confirm Password</span></label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-secondary brd-3 @error('password') is-invalid @enderror" placeholder="Retype password" />
                </div>
                
                {{-- Role-ID --}}
                <div class="col-md-6 col-12 mb-30 role-id">
                  <label for="role_id" class="required w-100 fw-bold"><span>User Role</span></label>
                  <select name="role_id" id="role_id" class="required form-select border-secondary brd-3 @error('role_id') is-invalid @enderror">
                    <option value="">Select Role</option>
                    @if ( $roles )
                      @foreach ( $roles as $role )
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
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
                  <label for="" class="required w-100 fw-bold"><span>Permissions</span></label>

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
                          <input type="checkbox" name="permissions[]" id="permission-{{ $permission }}" class="form-check-input cur-pointer permission" value="{{ $permission }}" {{ is_array($user->permissions) && in_array($permission, $user->permissions) ? 'checked' : '' }} />
                          <label for="permission-{{ $permission }}" class="form-check-label cur-pointer">{{ ucwords($permission) }}</label>
                        </span>
                      @endforeach
                    </div>
                  @endif
                </div>

                {{--Routes--}}
                <div class="col-12 mb-30 routes">
                  <label for="" class="required w-100 fw-bold"><span>Route Access</span></label>

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
                            class="form-check-input cur-pointer route" value="{{ $route }}" {{ is_array($user->routes) && in_array($route, $user->routes) ? 'checked' : '' }} />
                          <label for="route-{{ $route }}" class="form-check-label cur-pointer">{{ ucwords(str_replace(".", " ", $route)) }}</label>
                        </div>
                      @endforeach
                    </div>
                  @endif
                </div>


                {{-- Submit --}}
                <div class="col-12 mt-20 mb-50 text-end submit">
                  <div class="">
                    <button class="btn btn-success">Update</button>
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