@extends( 'layouts.app' )

{{--@section( 'title', 'View All Vehicle-Parts-Purchase' )--}}

@section( 'content' )
<div class="Page Vehicle-Parts-Purchase Index">
  <div class="container-fluid">
    <div class="page-content pt-10">
      <div class="card">
        <div class="card-header page-header bg-success text-white">
          <h5 class="title mb-0">Purchase History</h5>
        </div>


        <div class="card-body page-body p-0">
          <div class="parts-purchase-all-area">
            {{--Purchase-Search-Block--}}
            <div class="purchase-search h-auto fz-14 p-15 pt-10 pb-5">
              {{--onsubmit="getSearchQuery(this);"--}}
              <form method="GET" action="{{ route('vehicle.parts.purchase.all') }}"
                    name="purchaseSearchForm" id="purchaseSearchForm" class="search-form">

                <div class="row">
                  <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 date_start">
                    <ul class="list-style-none d-flex justify-content-around align-items-center">
                      {{--Date-Start--}}
                      <li class="p-relative date-select">
                        <input type="text" name="date_start" id="date_start" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="From Date" value="{{ $date_start ?? old('date_start') }}" />
                        <label for="date_start" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </li>

                      <li class="icon">
                        <span class="d-block fz-18 px-5"><i class="fa fa-long-arrow-right"></i></span>
                      </li>

                      {{--Date-End--}}
                      <li class="p-relative date-select">
                        <input type="text" name="date_end" id="date_end" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="To Date" value="{{ $date_end ?? old('date_end') }}" />
                        <label for="date_end" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </li>
                    </ul>
                  </div>

                  {{--<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 date_start">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-15"><span>Date From</span></label>
                      <div class="p-relative date-select">
                        <input type="text" name="date_start" id="date_start" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="{{ today()->format($date_format) }}" value="{{ $date_start ?? old('date_start') }}" />
                        <label for="date_start" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 date_end">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-30"><span>Date To</span></label>
                      <div class="p-relative date-select">
                        <input type="text" name="date_end" id="date_end" class="input-date form-control text-start border-secondary-1 brd-3 z-index-9" autocomplete="off" placeholder="{{ today()->format($date_format) }}" value="{{ $date_end ?? old('date_end') }}" />
                        <label for="date_end" class="input-label-icon p-absolute pos-top-right text-danger-deep fz-19 mr-10 cur-pointer z-index-11"><i class="fa fa-calendar"></i></label>
                      </div>
                    </div>
                  </div>--}}

                  {{--Purchase-Type--}}
                  <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 purchase_type">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-15"><span>Purchase Type</span></label>
                      <select name="purchase_type" id="purchase_type" class="form-select border-secondary-1 brd-3">
                        @if ( $purchase_type_all )
                          <option value="all">All</option>
                          @foreach ( $purchase_type_all as $type )
                            <option value="{{$type}}" {{ $type == $purchase_type ? 'selected' : '' }}>
                              {{ ucwords(str_replace('-', ' ', $type)) }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Parts-ID--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 parts_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-15"><span>Parts</span></label>
                      <select name="parts_id" id="parts_id" class="form-select border-secondary-1 brd-3">
                        @if ( $parts_all )
                          <option value="all">All</option>
                          @foreach ( $parts_all as $parts )
                            <option value="{{$parts->id}}" {{ $parts_id == $parts->id ? 'selected' : '' }}>
                              {{ $parts->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Parts-Category--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 parts_category">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-20"><span>Parts Category</span></label>
                      <select name="parts_category" id="parts_category" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $parts_category_all )
                          <option value="all">All</option>
                          @foreach ( $parts_category_all as $parts_cat )
                            <option value="{{$parts_cat->id}}" {{ $parts_cat->id == $parts_category ? 'selected' : '' }}>
                              {{ $parts_cat->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Vehicle-ID--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 vehicle_id">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-20"><span>Vehicle</span></label>
                      <select name="vehicle_id" id="vehicle_id" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $vehicle_all )
                          <option value="all">All</option>
                          @foreach ( $vehicle_all as $vehicle )
                            <option value="{{$vehicle->id}}" {{ $vehicle_id == $vehicle->id ? 'selected' : '' }}>
                              {{ $vehicle->vehicle_no }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Vehicle-Category--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 vehicle_category">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-20"><span>Vehicle Category</span></label>
                      <select name="vehicle_category" id="vehicle_category" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $vehicle_category_all )
                          <option value="all">All</option>
                          @foreach ( $vehicle_category_all as $vehicle_cat )
                            <option value="{{$vehicle_cat->id}}" {{ $vehicle_cat->id == $vehicle_category ? 'selected' : '' }}>
                              {{ $vehicle_cat->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Purchased-By--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 purchased_by">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-20"><span>Purchased By</span></label>
                      <select name="purchased_by" id="purchased_by" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $purchaser_all )
                          <option value="all">All</option>
                          @foreach ( $purchaser_all as $purchaser )
                            <option value="{{$purchaser->id}}" {{ $purchaser->id == $purchased_by ? 'selected' : '' }}>
                              {{ $purchaser->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Authorized-By--}}
                  <div class="col-md-3 col-sm-6 col-12 mb-10 authorized_by">
                    <div class="d-flex justify-content-between align-items-center">
                      <label for="" class="fw-bold mr-20"><span>Authorized By</span></label>
                      <select name="authorized_by" id="authorized_by" class="form-select d-inline-block border-secondary-1 brd-3">
                        @if ( $authorizer_all )
                          <option value="all">All</option>
                          @foreach ( $authorizer_all as $authorizer )
                            <option value="{{$authorizer->id}}" {{ $authorizer->id == $authorized_by ? 'selected' : '' }}>
                              {{ $authorizer->name }}
                            </option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>

                  {{--Search-By--}}
                  <div class="col-md-6 col-sm-6 col-12 mb-10 search_by">
                    {{--<label for="" class="fw-bold mr-15"><span>Search By</span></label>--}}
                    <input type="text" name="search_by" id="search_by" class="form-control d-inline-block fz-14 lh-1-8 border-secondary-1 brd-3" placeholder="Purchase No./ Memo No./ Bill No./ Shop Name-Contact-Location" value="{{ $search_by ?? '' }}" />
                    {{--<div class="text-secondary fz-12">
                      Search-by "Receive Number/ Challan Number/ Supplier Contact Person/ Contact Number/ Contact Email"
                    </div>--}}
                  </div>

                  {{--Action-Buttons--}}
                  <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-10 actions-btn">
                    <label for="" class="d-none text-white fw-bold mb-5"><span>Actions</span></label>
                    <div class="w-100">
                      <button class="btn btn-primary btn-sm fz-14 fw-bold lh-1-4 py-5 px-10">Search</button>

                      <input type="reset" value="Clear" id="clearReceiveSearchForm" class="btn btn-secondary btn-sm bg-secondary fz-14 fw-bold lh-1-4 py-5 px-10 ml-5" />

                      <a href="{{ route('vehicle.parts.purchase.all') }}" class="btn btn-dark btn-sm fz-14 fw-bold lh-1-4 py-5 px-10 ml-5">Refresh</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="blank h-auto bt-1 border-secondary-1"></div>

            <div class="overlay-scrollbar purchase-history-details p-10">
              <table class="table table-bordered table-hover border-secondary-3 purchase-history-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                  <tr class="table-row header align-middle">
                    <th scope="col" class="serial w-30px-min">S/L</th>
                    <th scope="col" class="purchase-number">Purchase No.#</th>
                    <th scope="col" class="purchase-date">Date</th>
                    <th scope="col" class="vehicle-number">Vehicle</th>
                    <th scope="col" class="parts-list">Parts List</th>
                    <th scope="col" class="shop-name">Shop Name</th>
                    <th scope="col" class="total-qty">Total Qty</th>
                    <th scope="col" class="total-amount">Total Amount</th>
                    <th scope="col" class="purchased-by">Purchased-By</th>
                    <th scope="col" class="authorized-by">Authorized-By</th>
                    <th scope="col" class="action">---</th>
                  </tr>
                </thead>

                <tbody class="table-body fz-12 align-middle">
                  @if ( $purchases_all && count($purchases_all) > 0 )
                    @foreach ( $purchases_all as $index => $purchase )

                      @include('modules.vehicle.purchase-parts.index-tableRow', $purchase)

                    @endforeach
                  @else
                    <tr class="table-row content no-receive align-middle">
                      <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">Sorry! Currently there are no record available.</td>
                    </tr>
                  @endif
                </tbody>
              </table>

              {{--<table class="table table-bordered table-hover border-secondary-3 receive-history-table">
                <thead class="table-header bg-dark text-white fz-14 text-center">
                <tr class="table-row header align-middle">
                  <th scope="col" class="serial w-30px-min">S/L</th>
                  <th scope="col" class="receive-number">Receive No #</th>
                  <th scope="col" class="receive-date">Receive Date</th>
                  <th scope="col" class="receive-time">Time</th>
                  <th scope="col" class="entry-date">Entry Date</th>
                  <th scope="col" class="supplier-name">Supplier</th>
                  <th scope="col" class="po-number">PO No #</th>
                  <th scope="col" class="challan-no"
                      data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supplier Challan No#">
                    CH No #
                  </th>
                  <th scope="col" class="challan-date"
                      data-bs-toggle="tooltip" data-bs-placement="bottom" title="Supplier Challan Date">
                    CH Date
                  </th>
                  <th scope="col" class="total-qty">Total Qty</th>
                  <th scope="col" class="total-amount">Total Amount</th>
                  <th scope="col" class="action">---</th>
                </tr>
                </thead>

                <tbody id="receive_history" class="table-body fz-12 text-center align-middle">--}}
                {{--@if ( $purchase_all && count($purchase_all) > 0 )
                  @foreach ( $purchase_all as $index => $purchase )--}}

                    {{--@if ( $search_by || $product_by || $category_by || $supplier_by )
                      <?php
                      /* @var $receive */ /* @var $search_by */
                      if( $search_by ){
                        $receive_no     = stripos($receive->tr_no, $search_by);
                        $challan_no     = stripos($receive->challan_no, $search_by);
                        $contact_no     = stripos($receive->supplier->contact_no, $search_by);
                        $contact_email  = stripos($receive->supplier->email, $search_by);
                        $contact_person = stripos($receive->supplier->contact_person, $search_by);
                      }

                      $products_id = []; $categories_id = [];
                      foreach( $receive->transactionDetails as $transactionDetails ){
                        $products_id[]   = $transactionDetails->product_id;
                        $categories_id[] = $transactionDetails->product->category_id;
                      }
                      ?>

                      @if ( $search_by && !$product_by && !$category_by && !$supplier_by )
                        @if ( $receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $product_by && !$search_by && !$category_by && !$supplier_by )
                        @if ( in_array($product_by, $products_id) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $category_by && !$search_by && !$product_by && !$supplier_by )
                        @if ( in_array($category_by, $categories_id) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $supplier_by && !$search_by && !$product_by && !$category_by )
                        @if ( $supplier_by == $receive->supplier_id )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $product_by && !$category_by && !$supplier_by )
                        @if ( in_array($product_by, $products_id) && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $category_by && !$product_by && !$supplier_by )
                        @if ( in_array($category_by, $categories_id) && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $supplier_by && !$product_by && !$category_by )
                        @if ( $supplier_by == $receive->supplier_id && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $product_by && $category_by && !$supplier_by )
                        @if ( in_array($product_by, $products_id) && in_array($category_by, $categories_id) && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $product_by && $supplier_by && !$category_by )
                        @if ( in_array($product_by, $products_id) && $supplier_by == $receive->supplier_id && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $category_by && $supplier_by && !$product_by )
                        @if ( in_array($category_by, $categories_id) && $supplier_by == $receive->supplier_id && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $search_by && $product_by && $category_by && $supplier_by )
                        @if ( in_array($product_by, $products_id) && in_array($category_by, $categories_id) && $supplier_by == $receive->supplier_id && ($receive_no !== false || $challan_no !== false || $contact_no !== false || $contact_email !== false || $contact_person !== false) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $product_by && $category_by && !$search_by && !$supplier_by )
                        @if ( in_array($product_by, $products_id) && in_array($category_by, $categories_id) )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $product_by && $supplier_by && !$search_by && !$category_by )
                        @if ( in_array($product_by, $products_id) && $supplier_by == $receive->supplier_id )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $product_by && $category_by && $supplier_by && !$search_by )
                        @if ( in_array($product_by, $products_id) && in_array($category_by, $categories_id) && $supplier_by == $receive->supplier_id )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @elseif ( $category_by && $supplier_by && !$product_by && !$search_by )
                        @if ( in_array($category_by, $categories_id) && $supplier_by == $receive->supplier_id )
                          @include('backend.admin.transaction.receive.index-tableRow', $receive)
                        @endif
                      @endif
                    @else
                      @include('backend.admin.transaction.receive.index-tableRow', $receive)
                    @endif--}}

                  {{--@endforeach
                @else
                  <tr class="table-row content no-receive align-middle">
                    <td colspan="11" class="error text-danger fz-22 fw-bold text-center py-100">Sorry! Currently there are no record available.</td>
                  </tr>
                @endif--}}
                {{--</tbody>
              </table>--}}
            </div>


            {{--Single-Receive-Details-Modal-View--}}
            <div class="modal fade" id="SingleReceiveModalView" {{--data-bs-backdrop="static" data-bs-keyboard="true"--}} tabindex="-1" aria-labelledby="ReceiveDetailsModalViewLabel" aria-hidden="true">
              <div id="ReceiveDetailsModalView" class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-scrollable">

                {{--@include('backend.admin.pos-module.order-modalView')--}}

              </div>
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


  /*LoadSingleReceiveModalView();
  function LoadSingleReceiveModalView(){
    $('.singleReceive-modalView.btn').each(function(){
      $(this).click(function(){
        let tr_id = Number($(this).attr('data-id'));
        $('#ReceiveDetailsModalView').load(`/admin/receive/details/${tr_id}/modal-view`);
      });
    });
  }*/

</script>
@endsection
