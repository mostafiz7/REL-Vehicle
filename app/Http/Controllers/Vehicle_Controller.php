<?php

namespace App\Http\Controllers;

use App\Models\Brand_Model;
use App\Models\Vehicle_Model;
use App\Models\Department_Model;
use App\Models\Designation_Model;
use App\Models\VehicleCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DateTime;


class Vehicle_Controller extends Controller
{
  // Show Vehicle-Add-Form
  function Show_VehicleAddForm( Request $request )
  {
    $brand_all       = Brand_Model::orderBy('name', 'asc')->get()->all();
    $category_all    = VehicleCategory_Model::orderBy('name', 'asc')->get()->all();
    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();

    $driver_all      = Designation_Model::where('slug', 'driver')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();
    $helper_all      = Designation_Model::where('slug', 'helper')->first()->employee()
      ->orderBy('name', 'asc')->get()->all();

    // $origin_country = ['bangladesh', 'china', 'germany', 'india', 'indonesia', 'italy', 'japan', 'south-korea', 'thailand', 'taiwan', 'united-kingdom', 'united-states'];
    $origin_country = [
      [ 'name' => 'Bangladesh',     'slug' => 'bangladesh' ],
      [ 'name' => 'China',          'slug' => 'china' ],
      [ 'name' => 'Germany',        'slug' => 'germany' ],
      [ 'name' => 'India',          'slug' => 'india' ],
      [ 'name' => 'Indonesia',      'slug' => 'indonesia' ],
      [ 'name' => 'Italy',          'slug' => 'italy' ],
      [ 'name' => 'Japan',          'slug' => 'japan' ],
      [ 'name' => 'South Korea',    'slug' => 'south-korea' ],
      [ 'name' => 'Thailand',       'slug' => 'thailand' ],
      [ 'name' => 'Taiwan',         'slug' => 'taiwan' ],
      [ 'name' => 'United Kingdom', 'slug' => 'united-kingdom' ],
      [ 'name' => 'United States',  'slug' => 'united-states' ]
    ];

    return view('modules.vehicle-module.vehicles.new')->with([
      'brand_all'       => $brand_all,
      'category_all'    => $category_all,
      'department_all'  => $department_all,
      'driver_all'      => $driver_all,
      'helper_all'      => $helper_all,
      'origin_country'  => $origin_country,
    ]);
  }


  // Store New-Vehicle
  function VehicleNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'vehicle_no'     => [ 'required', 'string', 'max:50', 'unique:vehicles,vehicle_no' ],
      'brand_id'       => [ 'required', 'integer', 'exists:brands,id' ],
      'category_id'    => [ 'required', 'integer', 'exists:vehicle_category,id' ],
      'purchase_date'  => [ 'nullable', 'date_format:d-m-Y' ],
      'department_id'  => [ 'nullable', 'integer', 'exists:departments,id' ],
      'driver_id'      => [ 'nullable', 'integer', 'exists:employees,id' ],
      'helper_id'      => [ 'nullable', 'integer', 'exists:employees,id' ],
      'helper_name'    => [ 'nullable', 'string', 'max:50' ],
      'wheels'         => [ 'nullable', 'integer', 'max:10' ],
      'engine_cc'      => [ 'nullable', 'integer', 'max:2000' ],
      'origin'         => [ 'nullable', 'string', 'max:20' ],
    ], [
      'vehicle_no.required'   => 'Vehicle-number is required.',
      'vehicle_no.max'        => 'Vehicle-number must be less than 50 characters.',
      'vehicle_no.unique'     => 'Vehicle-number must be unique.',
      'purchase_date.date_format' => 'The date does not match the correct format (Day-Month-FullYear).',
      'brand_id.required'      => 'The brand is required.',
      'brand_id.exists'        => 'The brand does not exists.',
      'category_id.required'   => 'The category is required.',
      'category_id.exists'     => 'The category does not exists.',
      'department_id.required' => 'The department is required.',
      'department_id.exists'   => 'The department does not exists.',
      'driver_id.exists'       => 'The driver does not exists.',
      'helper_id.exists'       => 'The helper does not exists.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $purchase_date  = $request->purchase_date ? DateTime::createFromFormat('d-m-Y', $request->purchase_date)->format('Y-m-d') : null;

    $newVehicleData = [
      'uid'           => Str::uuid(),
      'vehicle_no'    => $request->vehicle_no ?? null,
      'slug'          => Str::slug( $request->vehicle_no ),
      'brand_id'      => $request->brand_id ?? null,
      'category_id'   => $request->category_id ?? null,
      'department_id' => $request->department_id ?? null,
      'driver_id'     => $request->driver_id ?? null,
      'helper_id'     => $request->helper_id ?? null,
      'helper_name'   => ! $request->helper_id ? ($request->helper_name ?? null) : null,
      'is_running'    => true,
      'wheels'        => $request->wheels ?? null,
      'engine_cc'     => $request->engine_cc ?? null,
      'origin'        => $request->origin ?? null,
      'purchase_date' => $purchase_date,
      'sold_date'     => null,
    ];

    $newVehicleAdded = Vehicle_Model::create( $newVehicleData );

    return back()->with('success', 'New Vehicle added successfully!');
  }



}
