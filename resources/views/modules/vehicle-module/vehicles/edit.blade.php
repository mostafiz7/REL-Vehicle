@extends('layouts.app')

{{--@section('title', 'Edit Single Vehicle')--}}

@section('content')
<div class="Page Vehicle Edit">
  <div class="container-lg">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header d-flex justify-content-between align-items-center bg-purple text-white">
          <h5 class="title mb-0">
            <span class="mr-20">Vehicle</span>
            <span class="edit-mode color-red">Edit-Mode</span>
          </h5>
          
          <div class="">
            <a href="{{ route('vehicle.add.new') }}" class="btn btn-light btn-sm fw-bold">
              New Vehicle
            </a>
            <a href="{{ route('vehicle.all.show') }}" class="btn btn-light btn-sm fw-bold ml-5">
              Vehicle Index
            </a>
          </div>
        </div>


        <div class="card-body page-body p-0">
          <div class="vehicle-edit-area overlay-scrollbar">
            <form method="post" action="{{ route('vehicle.single.edit', $vehicle->uid) }}"
                  name="editVehicleForm" id="editVehicleForm" class="vehicle-form edit p-20 pb-0">
              @csrf

              <div class="row">
                {{--Vehicle-Number--}}
                <div class="col-md-6 col-12 mb-30 vehicle_no">
                  <label for="" class="required w-100 mr-15"><span>Vehicle Number</span></label>
                  <input type="text" name="vehicle_no" id="vehicle_no" class="required form-control border-secondary brd-3 @error('vehicle_no') is-invalid @enderror" placeholder="Dhaka Metro THA-1133" value="{{ $vehicle->vehicle_no }}" />

                  @if ( $errors->has('vehicle_no') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('vehicle_no') }}
                    </div>
                  @endif
                </div>

                {{--Status--}}
                <div class="col-md-6 col-12 mb-30 vehicle-status">
                  <label for="" class="required w-100 mr-15"><span>Status</span></label>
                  <div class="d-flex flex-wrap">
                    <span class="form-check ml-30">
                      <input type="radio" name="status" id="active" class="status form-check-input cur-pointer @error('status') is-invalid @enderror" value="{{ 'active' }}" {{ $vehicle->enabled ? 'checked' : '' }} />
                      <label for="active" class="form-check-label brd-3 cur-pointer {{ $vehicle->enabled ? 'bg-success text-white fw-bold py-1 px-10' : '' }}">Enable</label>
                    </span>
                    <span class="form-check ml-30">
                      <input type="radio" name="status" id="not-active" class="status form-check-input cur-pointer @error('status') is-invalid @enderror" value="{{ 'not-active' }}" {{ $vehicle->enabled ? '' : 'checked' }} />
                      <label for="not-active" class="form-check-label brd-3 cur-pointer {{ $vehicle->enabled ? '' : 'bg-danger text-white fw-bold py-1 px-10' }}">Disable</label>
                    </span>
                  </div>

                  @if ( $errors->has('status') )
                    <div class="text-danger fw-bold" role="alert">
                      {{ $errors->first('status') }}
                    </div>
                  @endif
                </div>

                {{--Purchase-Date--}}
                <div class="col-md-6 col-12 mb-30 purchase_date">
                  <label for="" class="w-100 mr-15"><span>Purchase Date</span></label>
                  <div class="p-relative date-select">
                    <input type="text" name="purchase_date" id="purchase_date" class="input-date form-control d-inline-block text-start border-secondary brd-3 z-index-9 @error('purchase_date') is-invalid @enderror" autocomplete="off" placeholder="dd-mm-yyyy" value="{{ $vehicle->purchase_date ? date($date_format, strtotime($vehicle->purchase_date)) : '' }}" />
                    <label for="purchase_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mt-2 mr-1 px-5 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                  </div>

                  @if ( $errors->has('purchase_date') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('purchase_date') }}
                    </div>
                  @endif
                </div>

                {{--Brand-Name--}}
                <div class="col-md-6 col-12 brand_id">
                  <label for="" class="required w-100 mr-15"><span>Brand</span></label>
                  <select name="brand_id" id="brand_id" class="required form-select border-secondary brd-3 @error('brand_id') is-invalid @enderror">
                    <option value="">Select Brand</option>
                    @if ( $brand_all )
                      @foreach ( $brand_all as $brand )
                        <option value="{{$brand->id}}" {{$brand->id == $vehicle->brand_id ? 'selected' : ''}}>
                          {{ $brand->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('brand_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('brand_id') }}
                    </div>
                  @endif
                </div>

                {{--Origin-Country--}}
                <div class="col-md-6 col-12 mb-30 origin">
                  <label for="" class="required w-100 mr-15"><span>Origin</span></label>
                  <select name="origin" id="origin" class="required form-select border-secondary brd-3 @error('origin') is-invalid @enderror">
                    <option value="">Select Country</option>
                    @foreach ( $countries as $country )
                      <option value="{{ $country['slug'] }}" {{ $country['slug'] == $vehicle->origin ? 'selected' : '' }}>
                        {{ $country['name'] }}
                      </option>
                    @endforeach
                  </select>

                  @if ( $errors->has('origin') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('origin') }}
                    </div>
                  @endif
                </div>

                {{--Category--}}
                <div class="col-md-6 col-12 mb-30 category_id">
                  <label for="" class="required w-100 mr-15"><span>Category</span></label>
                  <select name="category_id" id="category_id" class="required form-select border-secondary brd-3 @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                    @if ( $category_all )
                      @foreach ( $category_all as $category )
                        <option value="{{$category->id}}" {{$category->id == $vehicle->category_id ? 'selected' : ''}}>
                          {{ $category->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('category_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('category_id') }}
                    </div>
                  @endif
                </div>

                {{--Department--}}
                <div class="col-md-6 col-12 mb-30 department_id">
                  <label for="" class="w-100 mr-15"><span>Department</span></label>
                  <select name="department_id" id="department_id" class="form-select border-secondary brd-3 @error('department_id') is-invalid @enderror">
                    <option value="">Select Department</option>
                    @if ( $department_all )
                      @foreach ( $department_all as $department )
                        <option value="{{$department->id}}" {{$department->id == $vehicle->department_id ? 'selected' : ''}}>
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

                {{--Driver--}}
                <div class="col-md-6 col-12 mb-30 driver_id">
                  <label for="" class="w-100 mr-15"><span>Driver</span></label>
                  <select name="driver_id" id="driver_id" class="form-select border-secondary brd-3 @error('driver_id') is-invalid @enderror">
                    <option value="">Select Driver</option>
                    @if ( $driver_all )
                      @foreach ( $driver_all as $driver )
                        <option value="{{$driver->id}}" {{$driver->id == $vehicle->driver_id ? 'selected' : ''}}>
                          {{ $driver->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('driver_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('driver_id') }}
                    </div>
                  @endif
                </div>

                {{--Helper--}}
                <div class="col-lg-3 col-md-6 col-12 mb-30 helper_id">
                  <label for="" class="w-100 mr-15"><span>Helper</span></label>
                  <select name="helper_id" id="helper_id" class="form-select border-secondary brd-3 @error('helper_id') is-invalid @enderror">
                    <option value="">Select Helper</option>
                    @if ( $helper_all )
                      @foreach ( $helper_all as $helper )
                        <option value="{{$helper->id}}" {{$helper->id == $vehicle->helper_id ? 'selected' : ''}}>
                          {{ $helper->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>

                  @if ( $errors->has('helper_id') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('helper_id') }}
                    </div>
                  @endif
                </div>

                {{--Helper-Name-Other-Than-Employee--}}
                <div class="col-lg-3 col-md-6 col-12 mb-30 helper_name">
                  <div class="">
                    <label for="" class="mr-15"><span>Helper Name?</span></label>
                    <span class="text-secondary fz-14 ml--10">(Other than employee.)</span>
                  </div>
                  <input type="text" name="helper_name" id="helper_name" class="form-control border-secondary brd-3 @error('helper_name') is-invalid @enderror" value="{{ $vehicle->helper_name }}" />

                  @if ( $errors->has('helper_name') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('helper_name') }}
                    </div>
                  @endif
                </div>

                {{--Wheels-Count--}}
                <div class="col-md-6 col-12 mb-30 wheels">
                  <label for="" class="w-100 mr-15"><span>Wheels</span></label>
                  <input type="number" min="0" step="1" name="wheels" id="wheels" class="form-control border-secondary brd-3 @error('wheels') is-invalid @enderror" placeholder="How many wheels?" value="{{ $vehicle->wheels }}" />

                  @if ( $errors->has('wheels') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('wheels') }}
                    </div>
                  @endif
                </div>

                {{--Engine-Cubic-Capacity--}}
                <div class="col-md-6 col-12 mb-30 engine_cc">
                  <label for="" class="w-100 mr-15"><span>Engine CC</span></label>
                  <input type="number" min="0" step="1" name="engine_cc" id="engine_cc" class="form-control border-secondary brd-3 @error('engine_cc') is-invalid @enderror" placeholder="Engine's cubic-capacity" value="{{ $vehicle->engine_cc }}" />

                  @if ( $errors->has('engine_cc') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('engine_cc') }}
                    </div>
                  @endif
                </div>

                {{--Present-Condition--}}
                <div class="col-md-6 col-12 mb-30 present_condition">
                  <label for="" class="w-100 mr-15"><span>Present Condition</span></label>
                  <select name="present_condition" id="present_condition" class="form-select border-secondary brd-3 @error('present_condition') is-invalid @enderror">
                    <option value="running" {{$vehicle->is_running ? 'selected' : ''}}>
                      Running
                    </option>
                    <option value="stopped" {{$vehicle->is_running ? '' : 'selected'}}>
                      Stopped
                    </option>
                  </select>

                  @if ( $errors->has('present_condition') )
                    <div class="text-danger fz-14 fw-bold" role="alert">
                      {{ $errors->first('present_condition') }}
                    </div>
                  @endif
                </div>


                {{--Submit--}}
                <div class="col-12 mt-20 mb-50 text-end submit">
                  <div class="">
                    <button class="btn btn-purple">Update</button>
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