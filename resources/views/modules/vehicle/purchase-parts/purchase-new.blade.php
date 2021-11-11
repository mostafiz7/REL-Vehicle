@extends('layouts.app')

{{--@section('title', 'Create Vehicle-Parts New Purchase')--}}

@section('content')
<div class="Page Vehicle-Parts-Purchase New">
  <div class="page-wrapper">
    <div class="new-parts-purchase-page">
      <div class="container-fluid">
        <div class="page-content">
          <div class="card">
            <div class="card-header page-header h-auto bg-success text-white">
              <h5 class="title mb-0">Parts New Purchase</h5>
            </div>


            <div class="card-body page-body">
              <div class="parts-new-purchase-area overlay-scrollbar">
                <form method="post" action="{{ route('vehicle.parts.purchase.new') }}" id="partsPurchaseForm" class="partsPurchaseForm new">
                  @csrf

                  {{--Purchase-Number-Type-Date & Memo-Number--}}
                  <div class="row">
                    <div class="col-12 mb-30 purchase_no">
                      <label for="" class="required w-100 fw-bold mr-15"><span>Purchase No.#</span></label>
                      <input readonly type="text" name="purchase_no" id="purchase_no" class="required form-control fw-bold border-secondary brd-3 @error('purchase_no') is-invalid @enderror" value="{{ old('purchase_no') }}" />

                      @if ( $errors->has('purchase_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchase_no') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 purchase_date">
                      <label for="" class="w-100 fw-bold mr-15"><span>Purchase Date</span></label>
                      <div class="p-relative date-select">
                        <input type="text" name="date" id="purchase_date" class="input-date form-control d-inline-block text-start border-secondary brd-3 z-index-9 @error('date') is-invalid @enderror" placeholder="dd-mm-yyyy" value="{{ old('date') }}" />
                        <label for="purchase_date" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 lh-1-3 mr-1 p-5 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </div>

                      @if ( $errors->has('date') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('date') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 memo_no">
                      <label for="" class="required w-100 fw-bold mr-15"><span>Memo No.#</span></label>
                      <input type="text" name="memo_no" id="memo_no" class="required form-control border-secondary brd-3 @error('memo_no') is-invalid @enderror" placeholder="0253" value="{{ old('memo_no') }}" />

                      @if ( $errors->has('memo_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('memo_no') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 purchase_type">
                      <label for="" class="required w-100 fw-bold mr-15"><span>Purchase Type</span></label>
                      <select name="type" id="type" class="required form-select border-secondary brd-3 @error('type') is-invalid @enderror">
                        @foreach ( $purchase_type as $type )
                          <option value="{{ $type }}" {{ $type == 'vehicle-parts' ? 'selected' : '' }}>
                            {{ ucwords(str_replace('-', ' ', $type)) }}
                          </option>
                        @endforeach
                      </select>

                      @if ( $errors->has('type') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('type') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  {{--Vehicle-Number & Requisition-Number--}}
                  <div class="row">
                    <div class="col-12 mb-30 vehicle_id">
                      <label for="" class="required w-100 fw-bold mr-15"><span>Vehicle No.#</span></label>
                      <select name="vehicle_id" id="vehicle_id" class="required form-select border-secondary brd-3 @error('type') is-invalid @enderror">
                        <option value="">Select Vehicle</option>
                        @if ( $vehicle_all )
                          @foreach ( $vehicle_all as $vehicle )
                            <option value="{{ $vehicle->uid }}">
                              {{ $vehicle->vehicle_no }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('vehicle_id') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('vehicle_id') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 requisition_no">
                      <label for="" class="w-100 fw-bold mr-15"><span>Requisition No.#</span></label>
                      <input type="text" name="requisition_no" id="requisition_no" class="form-control border-secondary brd-3 @error('requisition_no') is-invalid @enderror" placeholder="{{ 'RQ-' . date('Y') . '/0526' }}" value="{{ old('requisition_no') }}" />

                      @if ( $errors->has('requisition_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('requisition_no') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  {{--Purchase-By & Purchaser-Name--}}
                  <div class="row">
                    <div class="col-12 mb-30 purchaser_id">
                      <label for="" class="w-100 fw-bold mr-15"><span>Purchase By</span></label>
                      <select name="purchaser_id" id="purchaser_id" class="form-select border-secondary brd-3 @error('purchaser_id') is-invalid @enderror">
                        <option value="">Select Purchaser</option>
                        @if ( $purchaser_all )
                          @foreach ( $purchaser_all as $purchaser )
                            <option value="{{ $purchaser->uid }}">
                              {{ $purchaser->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('purchaser_id') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchaser_id') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 purchaser_name">
                      <label for="" class="w-100 fw-bold mr-15"><span>Purchaser Name</span></label>
                      <input type="text" name="purchaser_name" id="purchaser_name" class="form-control border-secondary brd-3 @error('purchaser_name') is-invalid @enderror" placeholder="John Doe" value="{{ old('purchaser_name') }}" />

                      @if ( $errors->has('purchaser_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchaser_name') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  {{--Supplier & Supplier-Name--}}
                  <div class="row">
                    <div class="col-12 mb-30 supplier_id">
                      <label for="" class="w-100 fw-bold mr-15"><span>Supplier</span></label>
                      <select name="supplier_id" id="supplier_id" class="form-select border-secondary brd-3 @error('supplier_id') is-invalid @enderror">
                        <option value="">Select Supplier</option>
                        @if ( $supplier_all )
                          @foreach ( $supplier_all as $supplier )
                            <option value="{{ $supplier->uid }}">
                              {{ $supplier->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>

                      @if ( $errors->has('supplier_id') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('supplier_id') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 supplier_name">
                      <label for="" class="w-100 fw-bold mr-15"><span>Supplier Name</span></label>
                      <input type="text" name="supplier_name" id="supplier_name" class="form-control border-secondary brd-3 @error('supplier_name') is-invalid @enderror" placeholder="ABC Enterprise Ltd." value="{{ old('supplier_name') }}" />

                      @if ( $errors->has('supplier_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('supplier_name') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  {{--Shop-Name, Shop-Contact & Shop-Location--}}
                  <div class="row">
                    <div class="col-12 mb-30 shop_name">
                      <label for="" class="w-100 fw-bold mr-15"><span>Shop Name</span></label>
                      <input type="text" name="shop_name" id="shop_name" class="form-control border-secondary brd-3 @error('shop_name') is-invalid @enderror" placeholder="Dhaka Traders" value="{{ old('shop_name') }}" />

                      @if ( $errors->has('shop_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_name') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 shop_contact">
                      <label for="" class="w-100 fw-bold mr-15"><span>Shop Contact</span></label>
                      <input type="text" name="shop_contact" id="shop_contact" class="form-control border-secondary brd-3 @error('shop_contact') is-invalid @enderror" placeholder="01712-445566" value="{{ old('shop_contact') }}" />

                      @if ( $errors->has('shop_contact') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_contact') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-12 mb-30 shop_location">
                      <label for="" class="w-100 fw-bold mr-15"><span>Shop Location</span></label>
                      <input type="text" name="shop_location" id="shop_location" class="form-control border-secondary brd-3 @error('shop_location') is-invalid @enderror" placeholder="Mohakhali" value="{{ old('shop_location') }}" />

                      @if ( $errors->has('shop_location') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_location') }}
                        </div>
                      @endif
                    </div>
                  </div>


                  {{--Submit--}}
                  <div class="row">
                    <div class="col-12 text-end">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </div>

                </form>
              </div>
            </div> {{-- ./card-body --}}
          </div> {{-- ./card --}}
        </div> {{-- ./page-content --}}
      </div> {{-- ./container --}}
    </div> {{-- ./page-name --}}
  </div> {{-- ./page-wrapper --}}
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