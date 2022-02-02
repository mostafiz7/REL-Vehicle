@extends( 'layouts.app' )

{{--@section( 'title', 'View All User' )--}}

@section( 'content' )
<div class="Page User Index">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="title mb-0">User Index</h5>

          <a href="{{ route('user.add.new') }}" class="btn btn-light btn-sm fw-bold">
            New User
          </a>
        </div>


        <div class="card-body page-body p-0">
          <div class="user-all-area full-height-parent">
            {{--User-Search-Block--}}
            <div class="user-search h-auto fz-14 p-15 pt-10 pb-5">
              <form method="GET" action="{{ route('user.all.index') }}"
                    name="userSearchForm" id="userSearchForm" class="user-search-form">

                <div class="row">
                  {{-- Search-By --}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 search_by">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Search By</span></label>
                      <input type="text" name="search_by" id="search_by" class="form-control d-inline-block fz-14 lh-1-8 border-secondary-1 brd-3" placeholder="User Name/ Email" value="{{ $search_by ?? '' }}" />
                    </div>
                  </div>
                  
                  {{-- Permission --}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 permission_selected">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Permission</span></label>
                      <select name="permission_selected" id="permission_selected" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $permissions )
                          <option value="all">All</option>
                          @foreach ( $permissions as $permission )
                            <option value="{{ $permission }}" {{ $permission == $permission_selected ? 'selected' : '' }}>
                              {{ ucwords($permission) }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  
                  {{-- Route --}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 route_selected">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold text-md-end mr-10"><span>Route</span></label>
                      <select name="route_selected" id="route_selected" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $routes )
                          <option value="all">All</option>
                          @foreach ( $routes as $route )
                            <option value="{{ $route }}" {{ $route == $route_selected ? 'selected' : '' }}>
                              {{ ucwords(str_replace(".", " ", $route)) }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  

                  {{--Action-Buttons--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 action-btns">
                    <div class="w-100 text-center">
                      <button class="btn btn-primary btn-sm fz-14 fw-bold lh-1-4 py-5 px-10">Search</button>

                      <input type="reset" value="Clear" id="clearUserSearchForm" class="btn btn-secondary btn-sm bg-secondary fz-14 fw-bold lh-1-4 py-5 px-10 ml-5" />

                      <a href="{{ route('user.all.index') }}" class="btn btn-dark btn-sm fz-14 fw-bold lh-1-4 py-5 px-10 ml-5">Refresh</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="blank h-auto bt-1 border-secondary-1"></div>

            <div class="user-all-details overlay-scrollbar full-height-minus minus-120 p-10">
              <table class="table table-bordered table-hover border-secondary-3 user-all-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                  <tr class="table-row header align-middle">
                    <th scope="col" class="serial w-30px-min">S/L</th>
                    <th scope="col" class="name">Name</th>
                    <th scope="col" class="email">Email</th>
                    <th scope="col" class="username">Username</th>
                    <th scope="col" class="status">Status</th>
                    <th scope="col" class="role">Role</th>
                    <th scope="col" class="dept">Dept.</th>
                    <th scope="col" class="action">---</th>
                  </tr>
                </thead>

                <tbody class="table-body fz-12 align-middle">
                  @if ( $users && count($users) > 0 )
                    @foreach ( $users as $index => $user )
                      @include('admin.user.index-tableRow', $user)
                    @endforeach
                  @else
                    <tr class="table-row content no-user align-middle">
                      <td colspan="8" class="error text-danger fz-22 fw-bold text-center py-100">Sorry! Currently there are no user available.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>

          </div> {{-- ./page-area --}}
        </div> {{-- ./card-body --}}
      </div> {{-- ./card --}}
    </div> {{-- ./page-content --}}
  </div> {{-- ./container-fluid --}}
</div> {{-- ./Page View-Name --}}
@endsection


@section( 'custom-script' )
<script>

  // Showing Session Error or Success Message
  let sessionError = null, sessionSuccess = null;

  @if ( session('error') ) sessionError = @json( session('error') );
  @elseif ( session('success') ) sessionSuccess = @json( session('success') );
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
