<tr class="table-row content align-middle">
  <td class="serial w-30px-min text-center">{{ $index+1 }}</td>
  <td class="purchase-number text-primary text-center">{{ $purchase->purchase_no }}</td>
  <td class="purchase-date text-center">{{ date($date_format, strtotime($purchase->date)) }}</td>
  <td class="vehicle-number">{{ $purchase->vehicle->vehicle_no }}</td>
  <td class="parts-list">
    @foreach ( $purchase->details as $details )
      <li><span class="p-relative ml--10">{{ $details->parts->name }}</span></li>
    @endforeach
  </td>
  <td class="shop-name">{{ $purchase->shop_name }}</td>
  <td class="total-qty text-center">{{ $purchase->total_qty }}</td>
  <td class="total-amount text-end">{{ number_format($purchase->total_amount, 0) }}</td>
  <td class="purchased-by">{{ $purchase->purchaser->name }}</td>
  <td class="authorized-by">{{ $purchase->authorized_by ? $purchase->authorizer->name : '- - -' }}</td>

  <td class="action text-center">
    <a href="#" id="{{ $purchase->id }}" data-id="{{$purchase->id}}"
       {{--{{ route('transaction.purchase.details.modal-View', $purchase->id) }}--}}
       {{--onclick="PurchaseDetailsModalView(this);"--}}
       class="singlePurchase-modalView btn btn-success btn-sm brd-3"
       data-bs-toggle="modal" data-bs-target="#SinglePurchaseModalView">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Purchase Details">
        <i class="fa fa-eye"></i>
      </span>
    </a>

    <a href="#" id="purchasePrint_{{ $purchase->id }}" data-id="{{ $purchase->uid }}"
       {{--onclick="$(`#${this.id}`).printPage();"--}}
       class="purchasePrint-from-history btn btn-primary btn-sm brd-3 ml-5">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print Purchase">
        <i class="fa fa-print"></i>
      </span>
    </a>

    {{--@if ( Auth::user()->can('isAdmins') && Auth::user()->can('entryDelete') )
      <a href="{{ route('transaction.purchase.delete.single', $purchase->uid) }}"
         onclick="return confirm('Are you sure to delete this purchase?');"
         class="delete-purchase btn btn-danger btn-sm brd-3 ml-5">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Purchase">
          <i class="far fa-trash-alt"></i>
        </span>
      </a>
    @endif--}}
  </td>
</tr>