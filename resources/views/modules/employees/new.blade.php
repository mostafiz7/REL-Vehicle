@extends('layouts.app')

{{--@section('title', 'Add New Employee')--}}

@section('content')
<div class="Page Employee New">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Add New Employee</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="employee-new-area overlay-scrollbar">
            <form method="post" action="{{ route('employee.add.new') }}"
                  name="addEmployeeForm" id="addEmployeeForm" class="employee-form new p-20 pb-0">
              @csrf

              <div class="row">
                {{--Employee-Name--}}
                <div class="col-md-6 col-12 mb-30 name">
                  <label for="" class="required w-100 mr-15"><span>Employee Name</span></label>
                  <input type="text" name="name" id="name" class="required form-control border-secondary brd-3 @error('name') is-invalid @enderror" placeholder="Nurullah Mohammad" value="{{ old('name') }}" />

                  @if ( $errors->has('name') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                {{--Nickname--}}
                <div class="col-md-6 col-12 mb-30 nickname">
                  <label for="" class="w-100 mr-15"><span>Nickname</span></label>
                  <input type="text" name="nickname" id="nickname" class="form-control border-secondary brd-3 @error('nickname') is-invalid @enderror" placeholder="Nurullah" value="{{ old('nickname') }}" />

                  @if ( $errors->has('nickname') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('nickname') }}
                    </div>
                  @endif
                </div>

                {{--Office-ID--}}
                <div class="col-md-6 col-12 mb-30 office_id">
                  <label for="" class="required w-100 mr-15"><span>Office ID</span></label>
                  <input type="text" name="office_id" id="office_id" class="required form-control border-secondary brd-3 @error('office_id') is-invalid @enderror" placeholder="010058" value="{{ old('office_id') }}" />

                  @if ( $errors->has('office_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('office_id') }}
                    </div>
                  @endif
                </div>

                <div class="col-md-6 col-12 mb-30 blank-col">
                  {{--Blank Column--}}
                </div>

                {{--Birth-Date--}}
                {{--<div class="col-md-6 col-12 mb-30 birth_date">
                  <label for="" class="w-100 mr-15"><span>Birth Date</span></label>
                  <div class="p-relative date-select">
                    <input type="text" name="birth_date" id="birth_date" class="input-date form-control d-inline-block text-start border-secondary brd-3 z-index-9 @error('birth_date') is-invalid @enderror" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ old('birth_date') }}" />
                    <label for="birth_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mt-2 mr-1 px-5 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                  </div>

                  @if ( $errors->has('birth_date') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('birth_date') }}
                    </div>
                  @endif
                </div>--}}

                {{--Department-Name--}}
                <div class="col-md-6 col-12 mb-30 department_id">
                  <label for="" class="required w-100 mr-15"><span>Department</span></label>
                  <select name="department_id" id="department_id" class="required form-select border-secondary brd-3 @error('department_id') is-invalid @enderror">
                    <option value="">Select Department</option>
                    @if ( $department_all )
                      @foreach ( $department_all as $department )
                        <option value="{{$department->id}}" {{$department->id == old('department_id') ? 'selected' : ''}}>
                          {{ $department->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('department_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('department_id') }}
                    </div>
                  @endif
                </div>

                {{--Designation--}}
                <div class="col-md-6 col-12 mb-30 designation_id">
                  <label for="" class="required w-100 mr-15"><span>Designation</span></label>
                  <select name="designation_id" id="designation_id" class="required form-select border-secondary brd-3 @error('designation_id') is-invalid @enderror">
                    <option value="">Select Designation</option>
                    @if ( $designation_all )
                      @foreach ( $designation_all as $designation )
                        <option value="{{$designation->id}}" {{$designation->id == old('designation_id') ? 'selected' : ''}}>
                          {{ $designation->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('designation_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('designation_id') }}
                    </div>
                  @endif
                </div>

                {{--Authorize-and-Purchase-Power--}}
                <div class="col-md-6 col-12 mb-30 authorize-and-purchase-power">
                  <label for="" class="fw-bold w-100 mr-15"><span>Assigned Role</span></label>
                  <div class="d-flex flex-column flex-sm-row mt-3 pt-10 bt-1">
                    <div class="form-check me-0 me-sm-4 mb-10 authorize_power">
                      <input type="checkbox" name="authorize_power" id="authorize_power" class="form-check-input border-secondary cur-pointer" value="authorizer" {{old('authorize_power') ? 'checked' : ''}} />
                      <label class="form-check-label cur-pointer" for="authorize_power">Authorize Power</label>
                    </div>

                    <div class="form-check mb-10 purchase_power">
                      <input type="checkbox" name="purchase_power" id="purchase_power" class="form-check-input border-secondary cur-pointer" value="purchaser" {{old('purchase_power') ? 'checked' : ''}} />
                      <label class="form-check-label cur-pointer" for="purchase_power">Purchase Power</label>
                    </div>
                  </div>

                  @if ( $errors->has('authorize_power') || $errors->has('purchase_power') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      <div class="{{ $errors->has('authorize_power') ? 'mb-5' : 'd-none' }}">
                        {{ $errors->first('authorize_power') }}
                      </div>
                      <div class="{{ $errors->has('purchase_power') ? '' : 'd-none' }}">
                        {{ $errors->first('purchase_power') }}
                      </div>
                    </div>
                  @endif
                </div>


                {{--Submit--}}
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