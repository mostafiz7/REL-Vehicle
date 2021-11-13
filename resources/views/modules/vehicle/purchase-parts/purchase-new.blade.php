@extends('layouts.app')

{{--@section('title', 'Create Vehicle-Parts New Purchase')--}}

@section('content')
<div class="Page Vehicle-Parts-Purchase New">
  <div class="page-wrapper">
    <div class="new-parts-purchase-page">
      <div class="container-lg">
        <div class="page-content">
          <div class="card">
            <div class="card-header page-header h-auto bg-success text-white">
              <h5 class="title mb-0">Parts New Purchase</h5>
            </div>


            <div class="card-body page-body p-0">
              <div class="parts-new-purchase-area overlay-scrollbar">
                <form method="post" action="{{ route('vehicle.parts.purchase.new') }}" autocomplete="off"
                      name="partsPurchaseForm" id="partsPurchaseForm" class="parts-purchase new p-20">
                  @csrf

                  <div class="row form-top">
                    {{--Purchase-Number--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 purchase_no">
                      <label for="" class="required w-100 fw-bold mr-15"><span>Purchase No.#</span></label>
                      <input readonly type="text" name="purchase_no" id="purchase_no" class="required form-control fw-bold border-secondary brd-3 @error('purchase_no') is-invalid @enderror" value="{{ old('purchase_no') }}" />

                      @if ( $errors->has('purchase_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchase_no') }}
                        </div>
                      @endif
                    </div>

                    {{--Purchase-Date--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 purchase_date">
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

                    {{--Memo-Number--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 memo_no">
                      <label for="" class="required w-100 fw-bold mr-15"><span>Memo No.#</span></label>
                      <input type="text" name="memo_no" id="memo_no" class="required form-control border-secondary brd-3 @error('memo_no') is-invalid @enderror" placeholder="0253" value="{{ old('memo_no') }}" />

                      @if ( $errors->has('memo_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('memo_no') }}
                        </div>
                      @endif
                    </div>

                    {{--Purchase-Type--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 purchase_type">
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

                    {{--Vehicle-Number--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 vehicle_id">
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

                    {{--Requisition-Number--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 requisition_no">
                      <label for="" class="w-100 fw-bold mr-15"><span>Requisition No.#</span></label>
                      <input type="text" name="requisition_no" id="requisition_no" class="form-control border-secondary brd-3 @error('requisition_no') is-invalid @enderror" placeholder="{{ 'RQ-' . date('Y') . '/0526' }}" value="{{ old('requisition_no') }}" />

                      @if ( $errors->has('requisition_no') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('requisition_no') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Purchase-By--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 purchaser_id">
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

                    {{--Purchaser-Name--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 purchaser_name">
                      <label for="" class="w-100 fw-bold mr-15"><span>Purchaser Name</span></label>
                      <input type="text" name="purchaser_name" id="purchaser_name" class="form-control border-secondary brd-3 @error('purchaser_name') is-invalid @enderror" placeholder="John Doe" value="{{ old('purchaser_name') }}" />

                      @if ( $errors->has('purchaser_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('purchaser_name') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Registered-Supplier--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 supplier_id">
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
                    </div>--}}

                    {{--Unregistered-Supplier-Name--}}
                    {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 supplier_name">
                      <label for="" class="w-100 fw-bold mr-15"><span>Supplier Name</span></label>
                      <input type="text" name="supplier_name" id="supplier_name" class="form-control border-secondary brd-3 @error('supplier_name') is-invalid @enderror" placeholder="ABC Enterprise Ltd." value="{{ old('supplier_name') }}" />

                      @if ( $errors->has('supplier_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('supplier_name') }}
                        </div>
                      @endif
                    </div>--}}

                    {{--Shop-Name--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 shop_name">
                      <label for="" class="w-100 fw-bold mr-15"><span>Shop Name</span></label>
                      <input type="text" name="shop_name" id="shop_name" class="form-control border-secondary brd-3 @error('shop_name') is-invalid @enderror" placeholder="Dhaka Traders" value="{{ old('shop_name') }}" />

                      @if ( $errors->has('shop_name') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_name') }}
                        </div>
                      @endif
                    </div>

                    {{--Shop-Contact--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 shop_contact">
                      <label for="" class="w-100 fw-bold mr-15"><span>Shop Contact</span></label>
                      <input type="text" name="shop_contact" id="shop_contact" class="form-control border-secondary brd-3 @error('shop_contact') is-invalid @enderror" placeholder="01712-445566" value="{{ old('shop_contact') }}" />

                      @if ( $errors->has('shop_contact') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_contact') }}
                        </div>
                      @endif
                    </div>

                    {{--Shop-Location--}}
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30 shop_location">
                      <label for="" class="w-100 fw-bold mr-15"><span>Shop Location</span></label>
                      <input type="text" name="shop_location" id="shop_location" class="form-control border-secondary brd-3 @error('shop_location') is-invalid @enderror" placeholder="Mohakhali" value="{{ old('shop_location') }}" />

                      @if ( $errors->has('shop_location') )
                        <div class="text-danger fz-14 fw-bold" role="alert">
                          {{ $errors->first('shop_location') }}
                        </div>
                      @endif
                    </div>
                  </div> {{--/.row .form-top--}}


                  {{--Purchase-Items-Details--}}
                  <div class="form-center purchase-items-block py-20 px-15 mb-30 border-1 brd-3">
                    <h6 class="block-title bg-dark text-white text-center py-10 mb-20 brd-3">Purchase Items</h6>

                    <div id="purchase-items" class="mb-30">
                      <div class="accordion" id="accordionParent">
                        <div class="accordion-item item_1">
                          <h2 class="accordion-header p-relative" id="accordionHeading_1">
                            <button class="accordion-button fw-bold p-15" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCollapse_1" aria-expanded="true" aria-controls="accordionCollapse_1">
                              Item #<span class="item-count">1</span>
                            </button>
                            <span onclick="RemoveAccordionItem(this);"
                                  class="remove-accordion-item d-none before-shadow p-absolute pos-top-right w-30px h-30px bg-danger text-white fz-20 text-center lh-1-5 mt-10 mr-50 brd-50 cur-pointer z-index-11">
                              <i class="fa fa-close"></i>
                            </span>
                          </h2>
                          <div id="accordionCollapse_1" class="accordion-collapse collapse show" aria-labelledby="accordionHeading_1" data-bs-parent="#accordionParent">
                            <div class="accordion-body px-15 pb-5">
                              <div class="row gx-0 gx-sm-2 p-relative">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-name">
                                  <input type="text" name="item_name[]" id="item_name-1" class="item_name form-control border-secondary brd-3" placeholder="Item Name" value="" />
                                  <input type="hidden" name="item_id[]" id="item_id-1" class="item_id" value="" />
                                  <input type="hidden" name="item_slug[]" id="item_slug-1" class="item_slug" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-size">
                                  <input type="text" name="item_size[]" id="item_size-1" class="item_size form-control border-secondary brd-3" placeholder="Size" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-serials">
                                  <input type="text" name="item_serials[]" id="item_serials-1" class="item_serials form-control border-secondary brd-3" placeholder="Serials" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit">
                                  <select name="item_unit[]" id="item_unit-1" class="item_unit form-select border-secondary brd-3">
                                    <option value="pcs">Pcs</option>
                                    <option value="metre">Metre</option>
                                    <option value="litre">Litre</option>
                                  </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit-price">
                                  <input type="number" min="0" step="0.10" name="item_unit_price[]" id="item_unit_price-1" class="item_unit_price form-control border-secondary brd-3" placeholder="Unit Price" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-qty">
                                  <input type="number" min="0" name="item_qty[]" id="item_qty-1" class="item_qty form-control border-secondary brd-3" placeholder="Quantity" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-amount">
                                  <input type="number" min="0" name="item_amount[]" id="item_amount-1" class="item_amount form-control border-secondary brd-3" placeholder="Item Amount" value="" />
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-remarks">
                                  <input type="text" name="item_remarks[]" id="item_remarks-1" class="item_remarks form-control border-secondary brd-3" placeholder="Remarks" value="" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> {{--/.accordion-item-1--}}
                      </div> {{--/.accordion--}}
                    </div> {{--/#purchase-items--}}

                    <div class="accordion-actions d-flex justify-content-between">
                      <a href="#" id="removeAccordionItem-btn" class="btn btn-danger p-relative before-shadow z-index-11">
                        <i class="fa fa-minus mr-5"></i>
                        Remove Item
                      </a>

                      <a href="#" id="addMoreAccordionItem-btn" class="btn btn-dark">
                        <i class="fa fa-plus mr-5"></i>
                        Add Item
                      </a>
                    </div>

                    <div id="clone-accordion" class="d-none">
                      <div class="accordion-item">
                        <h2 class="accordion-header p-relative" id="accordionHeading">
                          <button class="accordion-button fw-bold p-15" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCollapse" aria-expanded="true" aria-controls="accordionCollapse">
                            Item #<span class="item-count">#</span>
                          </button>
                          <span onclick="RemoveAccordionItem(this);"
                                class="remove-accordion-item d-none before-shadow p-absolute pos-top-right w-30px h-30px bg-danger text-white fz-20 text-center lh-1-5 mt-10 mr-50 brd-50 cur-pointer z-index-11">
                            <i class="fa fa-close"></i>
                          </span>
                        </h2>
                        <div id="accordionCollapse" class="accordion-collapse collapse show" aria-labelledby="accordionHeading" data-bs-parent="#accordionParent">
                          <div class="accordion-body px-15 pb-5">
                            <div class="row gx-0 gx-sm-2 p-relative">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-name">
                                <input type="text" name="item_name[]" id="item_name" class="item_name form-control border-secondary brd-3" placeholder="Item Name" value="" />
                                <input type="hidden" name="item_id[]" id="item_id" class="item_id" value="" />
                                <input type="hidden" name="item_slug[]" id="item_slug" class="item_slug" value="" />
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-size">
                                <input type="text" name="item_size[]" id="item_size" class="item_size form-control border-secondary brd-3" placeholder="Size" value="" />
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-serials">
                                <input type="text" name="item_serials[]" id="item_serials" class="item_serials form-control border-secondary brd-3" placeholder="Serials" value="" />
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit">
                                <select name="item_unit[]" id="item_unit" class="item_unit form-select border-secondary brd-3">
                                  <option value="pcs">Pcs</option>
                                  <option value="metre">Metre</option>
                                  <option value="litre">Litre</option>
                                </select>
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-unit-price">
                                <input type="number" min="0" step="0.10" name="item_unit_price[]" id="item_unit_price" class="item_unit_price form-control border-secondary brd-3" placeholder="Unit Price" value="" />
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-qty">
                                <input type="number" min="0" name="item_qty[]" id="item_qty" class="item_qty form-control border-secondary brd-3" placeholder="Quantity" value="" />
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-amount">
                                <input type="number" min="0" name="item_amount[]" id="item_amount" class="item_amount form-control border-secondary brd-3" placeholder="Item Amount" value="" />
                              </div>

                              <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-15 item-remarks">
                                <input type="text" name="item_remarks[]" id="item_remarks" class="item_remarks form-control border-secondary brd-3" placeholder="Remarks" value="" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> {{--/#clone-accordion .d-none--}}
                  </div> {{--/.form-center--}}


                  <div class="row form-bottom">
                    {{--Submit--}}
                    <div class="col-12 mb-30 text-end">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </div> {{--/.row .form-bottom--}}

                </form>
              </div> {{-- ./page-content-area --}}
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


	function AlertErrorMessage(message, type = null){
		Swal.fire({
			icon: 'error',
			title: 'Oops! Sorry.',
			text: message + type,
		});
  }


  // Add-More-Accordion-Item
	AddMoreAccordionItem();
  function AddMoreAccordionItem(){
  	$("#addMoreAccordionItem-btn").click(function(){
			let notFilledItems = [];
			let message = "Fill-up previous item's name, quantity & amount!";

			// Check all accordions multiple input field has value
			$("#accordionParent input.item_name, #accordionParent input.item_qty, #accordionParent input.item_amount").each(function(){
        if( ! $(this).val() ){
					AlertErrorMessage(message, "");
					notFilledItems.push($(this));
        }
      });

      // If accordion all items input has filled
			if( notFilledItems.length === 0 ){
				let accordionParent = "", addAccordion = "", x = "";
				let accordionTitleAttrs = "", accordionCollapseAttrs = "";

				accordionParent = $("#accordionParent");
				x = accordionParent[0].childElementCount + 1; // Accordion Items Length

				$("#accordionParent .accordion-button").each(function(){
					if( ! $(this).hasClass("collapsed") ){
						$(this).addClass("collapsed");
						$(this).attr("aria-expanded", "false");
					}
				});
				$("#accordionParent .accordion-collapse.collapse.show").each(function(){
					$(this).removeClass("show");
				});

				$("#clone-accordion .accordion-item").addClass("item_"+x);
				$("#clone-accordion .accordion-header").attr('id', `accordionHeading_${x}`);
				accordionTitleAttrs = {
					"data-bs-target": "#accordionCollapse_" + x,
					"aria-controls": "accordionCollapse_" + x,
				};
				accordionCollapseAttrs = {
					"id": "accordionCollapse_" + x,
					"aria-labelledby": "accordionHeading_" + x,
				};
				$("#clone-accordion .accordion-button").attr(accordionTitleAttrs);
				$("#clone-accordion span.item-count").text(x);
				$("#clone-accordion .accordion-collapse").attr(accordionCollapseAttrs);
				$("#clone-accordion .accordion-body input.item_name").attr("id", `item_name-${x}`);
				$("#clone-accordion .accordion-body input.item_id").attr("id", `item_id-${x}`);
				$("#clone-accordion .accordion-body input.item_slug").attr("id", `item_slug-${x}`);
				$("#clone-accordion .accordion-body input.item_size").attr("id", `item_size-${x}`);
				$("#clone-accordion .accordion-body input.item_serials").attr("id", `item_serials-${x}`);
				$("#clone-accordion .accordion-body select.item_unit").attr("id", `item_unit-${x}`);
				$("#clone-accordion .accordion-body input.item_unit_price").attr("id", `item_unit_price-${x}`);
				$("#clone-accordion .accordion-body input.item_qty").attr("id", `item_qty-${x}`);
				$("#clone-accordion .accordion-body input.item_amount").attr("id", `item_amount-${x}`);
				$("#clone-accordion .accordion-body input.item_remarks").attr("id", `item_remarks-${x}`);

				addAccordion = $("#clone-accordion").html();
				$(addAccordion).clone().appendTo(accordionParent);

				$("#clone-accordion .accordion-item").removeClass("item_"+x);
      }
    });
  }


	// Activate-Remove-Icon-to-Accordion-Item
	ActivateRemoveIconToAccordionItem();
	function ActivateRemoveIconToAccordionItem(){
		$("#removeAccordionItem-btn").click(function(){
			$("#accordionParent .accordion-item .remove-accordion-item").each(function(){
				if( $(this).hasClass("d-none") ){
					$(this).removeClass("d-none");
				}
			});
		});
	}

	// Remove-Accordion-Item
	function RemoveAccordionItem(e){
		if( $("#accordionParent")[0].childElementCount > 1 ){
			$(e).closest("#accordionParent .accordion-item").remove();
		} else{
			Swal.fire({
				icon: 'error',
				title: 'Oops! Sorry.',
				text: 'At least one item should be kept.',
			});
		}
	}


</script>
@endsection