<?php

namespace App\Http\Controllers;

use App\Models\Bill_Model;
use App\Models\Parts_Model;
use App\Models\Vehicle_Model;
use App\Models\Purchase_Model;
use App\Models\Supplier_Model;
use App\Models\Employee_Model;
use App\Models\Requisition_Model;
use App\Models\PartsCategory_Model;
use App\Models\VehicleCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;


class Purchase_Controller extends Controller
{
  // Vehicle-Parts Purchase Unique-Number
  protected function VehiclePartsPurchaseNo(): string
  {
    $type = 'vehicle-parts';
    $current_year = date('Y', strtotime(today()));
    $last_purchase = Purchase_Model::whereYear('created_at', $current_year)
      ->latest()->first();

    // VPPNoLastSerial = Vehicle Parts Purchase Number Last-Serial
    // VPPNoNewSerial  = Vehicle Parts Purchase Number New-Serial

    $serialWithZero = '';
    if( $last_purchase ){
      $purchaseNo_arr_1 = explode('-', $last_purchase->purchase_no);
      $purchaseNo_arr_2 = explode('/', $purchaseNo_arr_1[1]);
      // $lastPartsPurchaseNoArr = explode('-', $parts_last_purchase->purchase_no);
      $VPPNoLastSerial = (int) $purchaseNo_arr_2[1];
      $VPPNoNewSerial = $VPPNoLastSerial + 1;

      if( $VPPNoNewSerial < 10 ){
        $serialWithZero = '0000' . $VPPNoNewSerial;
      } elseif( $VPPNoNewSerial < 100 ){
        $serialWithZero = '000' . $VPPNoNewSerial;
      } elseif( $VPPNoNewSerial < 1000 ){
        $serialWithZero = '00' . $VPPNoNewSerial;
      } elseif( $VPPNoNewSerial < 10000 ){
        $serialWithZero = '0' . $VPPNoNewSerial;
      } else{
        $serialWithZero = $VPPNoNewSerial;
      }
    } else{
      $serialWithZero = '00001';
    }

    $newPurchaseNo = 'PR-' . $current_year . '/' . $serialWithZero;
    return $newPurchaseNo;
  }


  // Show Vehicle-Parts Purchase-Form
  public function VehicleParts_Purchase_Form( Request $request )
  {
    $parts_all            = Parts_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_all          = Vehicle_Model::orderBy('vehicle_no', 'asc')->get()->all();
    $parts_category_all   = PartsCategory_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_category_all = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();

    $purchaser_all        = Employee_Model::where('purchase_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $authorizer_all       = Employee_Model::where('authorize_power', 1)
      ->where('active', 1)->orderBy('name', 'asc')->get()->all();
    $employee_all         = Employee_Model::where('active', 1)
      ->orderBy('name', 'asc')->get()->all();

    $supplier_all         = Supplier_Model::orderBy('name', 'asc')->get()->all();

    $purchase_type = ['vehicle', 'vehicle-parts', 'electrical', 'electronics', 'stationary', 'furniture'];

    return view('modules.vehicle.purchase-parts.purchase-new')->with([
      'newPurchaseNo'         => $this->VehiclePartsPurchaseNo(),
      'parts_all'             => $parts_all,
      'vehicle_all'           => $vehicle_all,
      'supplier_all'          => $supplier_all,
      'purchase_type'         => $purchase_type,
      'employee_all'          => $employee_all,
      'purchaser_all'         => $purchaser_all,
      'authorizer_all'        => $authorizer_all,
      'parts_category_all'    => $parts_category_all,
      'vehicle_category_all'  => $vehicle_category_all,
    ]);
  }


  // Store Newly Purchased Vehicle-Parts
  public function VehicleParts_Purchase_Store( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $session_id = null;
    if( $request->session()->has('session_id') ){
      $session_id = $request->session()->get('session_id');
    }

    $type           = 'vehicle-parts';
    $purchase_date  = $request->date ? DateTime::createFromFormat('d-m-Y', $request->date)->format('Y-m-d') : date('Y-m-d', strtotime(today()));
    $requisition    = Requisition_Model::where('requisition_no', $request->requisition_no)->get()->first();
    $purchaser      = Employee_Model::where('id', $request->purchased_by)
      ->where('purchase_power', 1)->where('active', 1)->get()->first();
    $authorizer     = Employee_Model::where('id', $request->authorized_by)
      ->where('authorize_power', 1)->where('active', 1)->get()->first();
    $supplier       = Supplier_Model::find($request->supplier_id);
    $billed         = Bill_Model::where('bill_no', $request->bill_no)->get()->first();
    $entry_by       = Employee_Model::where('id', $request->entry_by)
      ->where('active', 1)->get()->first();

    $total_qty = 0; $total_amount = 0; $paid_amount = 0; $due_amount = 0;
    $input_total_qty    = (int) $request->total_qty;
    $input_total_amount = (int) $request->total_amount;
    $input_paidAmount   = (int) $request->paid_amount;
    $input_dueAmount    = (int) $request->due_amount;
    $is_full_paid       = $request->has('is_paid') && $request->is_paid == 'full-paid';
    $is_partial_paid    = $request->has('is_partial_paid') && $request->is_partial_paid == 'partial-paid';

    $validator = Validator::make( $request->all(), [
      /*Rule::unique('employees')->where(function ($query) use($purchaser_id, $purchase_power) {
        return $query->where('purchase_power', $purchase_power)->where('id', $purchaser_id);
      }),*/
      'purchase_type'  => [ 'required', 'in:vehicle-parts', 'string', 'max:15' ],
      'date'           => [ 'required', 'date_format:d-m-Y' ],
      'memo_no'        => [ 'required', 'string', 'max:6' ],
      'vehicle_id'     => [ 'required', 'integer', 'exists:vehicles,id' ],
      'bill_no'        => [ 'nullable', 'string', 'max:15', 'exists:bills,bill_no' ],
      'shop_name'      => [ 'required', 'string', 'max:50' ],
      'shop_contact'   => [ 'required', 'digits:11' ],
      'shop_location'  => [ 'nullable', 'string', 'max:20' ],
      'purchased_by'   => [ 'required', 'integer', 'exists:employees,id,purchase_power,1,active,1' ],
      'authorized_by'  => [ 'nullable', 'integer', 'exists:employees,id,authorize_power,1,active,1' ],
      'notes'          => [ 'nullable', 'string', 'max:1000' ],
      'entry_by'       => [ Rule::requiredIf(!auth()->user()), 'integer', 'exists:employees,id,active,1' ],

      // 'purchaser_name' => [ 'required_unless:purchased_by,null', 'string', 'max:50' ],
      // 'checked_by'     => [ 'nullable', 'integer', 'exists:employees,id,active,1' ],
      // 'requisition_no' => [ 'nullable', 'string', 'max:15', 'exists:requisitions,requisition_no' ],
      // 'supplier_id'    => [ 'nullable', 'integer', 'exists:suppliers,id' ],
      // 'supplier_name'  => [ 'required_unless:supplier_id,null', 'string', 'max:50' ],
    ], [
      'purchase_type.in'      => 'Only vehicle-parts is allowed.',
      'memo_no.required'      => 'The memo-number is required.',
      'vehicle_id.required'   => 'The vehicle-number is required.',
      'vehicle_id.exists'     => 'The vehicle-number does not exists.',
      'date.date_format'      => 'The date does not match the correct format (Day-Month-FullYear).',
    ]);
    if( $validator->fails() || $input_paidAmount > $input_total_amount || $input_dueAmount > $input_total_amount
      || (($input_paidAmount + $input_dueAmount) > $input_total_amount) ){
      if( $input_paidAmount > $input_total_amount ) $validator->errors()->add('paid_amount', 'Paid amount exceeds the total amount.');
      if( $input_dueAmount > $input_total_amount ) $validator->errors()->add('due_amount', 'Due amount exceeds the total amount.');
      if( ($input_paidAmount + $input_dueAmount) > $input_total_amount ){
        $validator->errors()->add('paid_amount', 'Paid & Due amount exceeds the total amount.');
        $validator->errors()->add('due_amount', 'Paid & Due amount exceeds the total amount.');
      }
      return back()->withErrors( $validator )->withInput();
    }


    // Get All Purchased Items
    $items_name       = $request->input('item_name');
    $items_id         = $request->input('item_id');
    $items_uid        = $request->input('item_uid');
    $items_slug       = $request->input('item_slug');
    $items_size       = $request->input('item_size');
    $items_serials    = $request->input('item_serials');
    $items_unit       = $request->input('item_unit');
    $items_unit_price = $request->input('item_unit_price');
    $items_quantity   = $request->input('item_qty');
    $items_amount     = $request->input('item_amount');
    $items_remarks    = $request->input('item_remarks');

    // Check item name, quantity & amount has value
    $has_item_name = null; $qty_not_present = null; $amount_not_present = null;
    $has_qty_without_item = null; $has_amount_without_item = null; $remarks_too_long = null;
    foreach( $items_name as $key => $item_name ){
      if( $item_name ){
        $has_item_name[] = $item_name;
        if( ! $items_quantity[$key] ){
          $qty_not_present[] = ($key + 1);
        }
        if( ! $items_amount[$key] ){
          $amount_not_present[] = ($key + 1);
        }
        if( strlen($items_remarks[$key]) > 191 ){
          $remarks_too_long[] = ($key + 1);
        }
      } elseif( $item_name == null ){
        if( $items_quantity[$key] ){
          $has_qty_without_item[] = ($key + 1);
        }
        if( $items_amount[$key] ){
          $has_amount_without_item[] = ($key + 1);
        }
      }
    }

    // Send error message if item name, quantity & amount has not value
    if( (! $has_item_name || count($has_item_name) < 1) || ($qty_not_present && count($qty_not_present) > 0)
    || ($amount_not_present && count($amount_not_present) > 0) || ($has_qty_without_item && count($has_qty_without_item) > 0)
    || ($has_amount_without_item && count($has_amount_without_item) > 0) || ($remarks_too_long && count($remarks_too_long) > 0) ){

      if( ! $has_item_name || count($has_item_name) < 1 ){
        session()->flash('error', 'Minimum 1 item required.');
        return back()->withInput();

      } elseif( $qty_not_present && count($qty_not_present) > 0 ){
        $lineNumbers = implode(', ', $qty_not_present);
        session()->flash('error', "Item quantity not present on line number ($lineNumbers).");
        return back()->withInput();

      } elseif( $amount_not_present && count($amount_not_present) > 0 ){
        $lineNumbers = implode(', ', $amount_not_present);
        session()->flash('error', "Item amount not present on line number ($lineNumbers).");
        return back()->withInput();

      } elseif( $has_qty_without_item && count($has_qty_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_qty_without_item);
        session()->flash('error', "Item name not present on line number ($lineNumbers).");
        return back()->withInput();

      } elseif( $has_amount_without_item && count($has_amount_without_item) > 0 ){
        $lineNumbers = implode(', ', $has_amount_without_item);
        session()->flash('error', "Item name not present on line number ($lineNumbers).");
        return back()->withInput();

      } elseif( $remarks_too_long && count($remarks_too_long) > 0 ){
        $lineNumbers = implode(', ', $remarks_too_long);
        session()->flash('error', "Item remarks too long on line number ($lineNumbers).");
        return back()->withInput();
      }
    }

    // Iterate Purchased Items



    if( $is_full_paid && $input_paidAmount == $total_amount ){
      $paid_amount = $total_amount;
      $due_amount  = 0;
    } else{
      $paid_amount = $input_paidAmount;
      $due_amount  = $input_dueAmount;
    }

    $vehicle_parts_new_purchase = [
      'uid'             => Str::uuid(),
      'purchase_no'     => $this->VehiclePartsPurchaseNo(),
      'purchase_type'   => $type,
      'date'            => $purchase_date,
      'memo_no'         => $request->memo_no,
      'vehicle_id'      => (int) $request->vehicle_id,
      'requisition_id'  => $requisition ? $requisition->id : null,
      'requisition_no'  => $requisition ? $requisition->requisition_no : null,
      'purchased_by'    => $request->purchased_by ? (int) $request->purchased_by : null,
      'purchaser_name'  => ! $request->purchased_by ? $request->purchaser_name : null,
      'is_authorized'   => $request->authorized_by ? true : false,
      'authorized_by'   => $request->authorized_by ? (int) $request->authorized_by : null,
      'checked_by'      => null,
      'supplier_id'     => $request->supplier_id ? (int) $request->supplier_id : null,
      'supplier_name'   => ! $request->supplier_id ? ($request->supplier_name ?? null) : null,
      'shop_name'       => $request->shop_name,
      'shop_slug'       => Str::slug( $request->shop_name ),
      'shop_contact'    => $request->shop_contact,
      'shop_location'   => $request->shop_location,
      'total_qty'       => $total_qty,
      'total_amount'    => $total_amount,
      'is_paid'         => $is_full_paid,
      'is_partial_paid' => $is_partial_paid,
      'paid_amount'     => $paid_amount,
      'due_amount'      => $due_amount,
      'is_billed'       => $billed ? true : false,
      'bill_id'         => $billed ? $billed->id : null,
      'bill_no'         => $billed ? $billed->bill_no : null,
      'user_id'         => Auth::check() ? Auth::id() : null,
      'entry_by'        => !Auth::check() && $request->entry_by ? (int) $request->entry_by : null,
      'notes'           => (string) $request->notes,
      'device'          => null,
      'ip'              => request()->ip(),
      'ip_address'      => $request->ip(),
      'session_id'      => $session_id,
    ];

    return $vehicle_parts_new_purchase;
  }



}
