<?php

namespace App\Http\Controllers;

use App\Models\Employee_Model;
use App\Models\Parts_Model;
use App\Models\Supplier_Model;
use App\Models\Vehicle_Model;
use App\Models\PartsCategory_Model;
use App\Models\VehicleCategory_Model;
use Illuminate\Http\Request;


class Purchase_Controller extends Controller
{
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

    $supplier_all         = Supplier_Model::get()->all();

    return view('modules.vehicle.purchase-parts.purchase-new')->with([
      'parts_all'             => $parts_all,
      'vehicle_all'           => $vehicle_all,
      'purchaser_all'         => $purchaser_all,
      'authorizer_all'        => $authorizer_all,
      'parts_category_all'    => $parts_category_all,
      'vehicle_category_all'  => $vehicle_category_all,
    ]);
  }



}
