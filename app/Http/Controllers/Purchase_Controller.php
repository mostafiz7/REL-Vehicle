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
    $parts_all            = Parts_Model::get()->all();
    $vehicle_all          = Vehicle_Model::get()->all();
    $parts_category_all   = PartsCategory_Model::get()->all();
    $vehicle_category_all = VehicleCategory_Model::get()->all();

    $purchaser_all        = Employee_Model::where('purchase_power', 1)
      ->where('active', 1)->get()->all();
    $authorizer_all       = Employee_Model::where('authorize_power', 1)
      ->where('active', 1)->get()->all();

    $employee_all         = Employee_Model::where('active', 1)
      ->orderBy('name', 'asc')->get()->all();

    $supplier_all         = Supplier_Model::get()->all();

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

    $requisition = Requisition_Model::where('requisition_no', $request->requisition_no)->get()->first();

    $purchaser   = Employee_Model::where('id', $request->purchaser_id)
      ->where('purchase_power', 1)->where('active', 1)->get()->first();

    $authorizer  = Employee_Model::where('id', $request->purchaser_id)
      ->where('authorize_power', 1)->where('active', 1)->get()->first();

    $supplier    = Supplier_Model::find($request->supplier_id);

    $billed      = Bill_Model::where('bill_no', $request->bill_no)->get()->first();

    $entry_by    = Employee_Model::where('id', $request->entry_by)
      ->where('active', 1)->get()->first();

    $total_qty = 0; $total_amount = (int) 0; $paid_amount = 0; $due_amount = 0;
    $input_paidAmount = (int) $request->paid_amount;
    $input_dueAmount  = (int) $request->due_amount;
    $is_full_paid     = $request->has('is_paid') && $request->is_paid == 'full-paid';
    $is_partial_paid  = $request->has('is_partial_paid') && $request->is_partial_paid == 'partial-paid';

    $validator = '';
    if( $input_paidAmount > $total_amount ){
      $validator->errors()->add('paid_amount', 'Paid amount exceeds the total amount.');
    }
    if( $input_dueAmount > $total_amount ){
      $validator->errors()->add('due_amount', 'Due amount exceeds the total amount.');
    }
    if( ($input_paidAmount + $input_dueAmount) > $total_amount ){
      $validator->errors()->add('paid_amount', 'Paid & Due amount exceeds the total amount.');
      $validator->errors()->add('due_amount', 'Paid & Due amount exceeds the total amount.');
    }

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
      'purchased_by'    => $purchaser ? $purchaser->id : null,
      'purchaser_name'  => null,
      'is_authorized'   => $authorizer ? true : false,
      'authorized_by'   => $authorizer ? $authorizer->id : null,
      'checked_by'      => null,
      'supplier_id'     => $supplier ? $supplier->id : null,
      'supplier_name'   => $request->supplier_name ?? $supplier ? $supplier->name : null,
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
      'entry_by'        => !Auth::check() && $entry_by ? $entry_by->id : null,
      'notes'           => (string) $request->notes,
      'device'          => null,
      'ip'              => request()->ip(),
      'ip_address'      => $request->ip(),
      'session_id'      => $session_id,
    ];

    return $vehicle_parts_new_purchase;
  }



}
