<?php

namespace App\Http\Controllers;

use App\Models\Brand_Model;
use App\Models\Department_Model;
use App\Models\Designation_Model;
use App\Models\Employee_Model;
use App\Models\VehicleCategory_Model;
use Illuminate\Http\Request;


class Vehicle_Controller extends Controller
{
  // Show Vehicle-Add-Form
  function Show_VehicleAddForm( Request $request )
  {
    $brand_all           = Brand_Model::orderBy('name', 'asc')->get()->all();
    $vehicle_categories  = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();
    $department_all      = Department_Model::orderBy('name', 'asc')->get()->all();

    $driver_all          = Designation_Model::where('slug', 'driver')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();
    $helper_all          = Designation_Model::where('slug', 'helper')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();

    return view('modules.vehicle-module.vehicles.new')->with([
      'brand_all'           => $brand_all,
      'vehicle_categories'  => $vehicle_categories,
      'department_all'      => $department_all,
      'driver_all'          => $driver_all,
      'helper_all'          => $helper_all,
    ]);
  }


  // Store New-Vehicle
  function VehicleNew_Store( Request $request )
  {


    return $request->all();
  }



}
