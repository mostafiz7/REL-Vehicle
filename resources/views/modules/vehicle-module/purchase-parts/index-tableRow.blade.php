<tr class="table-row content align-middle {{ ($index+1) % 2 == 0 ? 'bg-success-light' : '' }}">
  <td class="serial w-30px-min text-center">{{ $serial }}</td>
  <td class="purchase-number text-primary text-center">
    <a href="#" class="edit-link text-primary">
      {{-- {{ route('vehicle.parts.purchase.edit', $purchase) }} --}}
      {{ $purchase->purchase_no }}
    </a>
  </td>
  <td class="purchase-date text-center">{{ date($date_format, strtotime($purchase->date)) }}</td>
  <td class="vehicle-number">{{ $purchase->vehicle->vehicle_no }}</td>
  <td class="parts-list">
    @foreach ( $purchase->details as $purchaseItem )
      <li>
        <span class="parts-name p-relative ml--10">{{ $purchaseItem->parts->name }}</span>
        <span class="mx-1"> - </span>
        <span class="parts-country">{{ ucwords($purchaseItem->origin) }}</span>
      </li>
    @endforeach
  </td>
  <td class="shop-name">{{ $purchase->shop_name }}</td>
  <td class="quantity text-center">{{ $purchase->total_qty }}</td>
  <td class="amount text-end">{{ number_format($purchase->total_amount, 0) }}</td>
  <td class="purchased-by">{{ $purchase->purchaser->name }}</td>
  <td class="authorized-by">{{ $purchase->authorized_by ? $purchase->authorizer->name : '- - -' }}</td>

  <td class="action text-center">
    <a href="#" id="purchasePrint_{{ $purchase->id }}" data-id="{{ $purchase->uid }}"
       {{--onclick="$(`#${this.id}`).printPage();"--}}
       class="purchasePrint-from-history btn btn-primary btn-sm brd-3">
      <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print Purchase">
        <i class="fa fa-print"></i>
      </span>
    </a>
    
    @if ( Auth::user()->can('isAdmins') && Auth::user()->can('entryEdit') )
      <a href="{{ route('vehicle.parts.purchase.edit', $purchase) }}"
        class="edit-purchase btn btn-success btn-sm brd-3 ml-5">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Purchase">
          <i class="fa fa-pencil"></i>
        </span>
      </a>
    @endif

    @if ( Auth::user()->can('isSuperAdmin') && Auth::user()->can('entryDelete') )
      <a href="{{ route('vehicle.parts.purchase.delete', $purchase->uid) }}"
        onclick="return confirm('Are you sure to delete this purchase?');"
        class="delete-purchase btn btn-danger btn-sm brd-3 ml-5">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Purchase">
          <i class="fa fa-trash"></i>
        </span>
      </a>
    @endif
  </td>
</tr>