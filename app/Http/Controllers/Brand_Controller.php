<?php

namespace App\Http\Controllers;

use App\Models\Brand_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Brand_Controller extends Controller
{
  // Show Brand-Add-Form
  function BrandAddForm( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $brand_all    = Brand_Model::orderBy('name', 'asc')->get()->all();

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

    return view('modules.vehicle-module.vehicles.brands')->with([
      'brand_all'      => $brand_all,
      'origin_country' => $origin_country,
    ]);
  }


  // Store New-Brand
  function Store_NewBrand( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'name'    => [ 'required', 'string', 'max:50', 'unique:brands,name' ],
      'origin'  => [ 'required', 'string', 'max:20' ],
    ], [
      'name.required'        => 'The brand-name is required.',
      'name.max'             => 'The brand-name must be less than 50 characters.',
      'name.unique'          => 'The brand-name must be unique.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $newVehicleBrandData = [
      'uid'     => Str::uuid(),
      'name'    => $request->name,
      'slug'    => Str::slug( $request->name ),
      'origin'  => $request->origin ?? null,
    ];

    $newVehicleBrandAdded = Brand_Model::create( $newVehicleBrandData );

    return back()->with('success', 'New Vehicle-Brand added successfully!');
  }
  

  // Show Brand-Edit-Form
  function BrandEditForm( Brand_Model $brand, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $brand ) return back()->with('error', 'The brand not found in system!');
    
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

    return view('modules.vehicle-module.vehicles.brand-edit')->with([
      'brand'          => $brand,
      'origin_country' => $origin_country,
    ]);
  }


  // Update Brand
  function BrandUpdate( Brand_Model $brand, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $brand ) return back()->with('error', 'The brand not found in system!');

    $validator = Validator::make( $request->all(), [
      'name'    => [ 'required', 'string', 'max:50', "unique:brands,name, $brand->id" ],
      'origin'  => [ 'required', 'string', 'max:20' ],
    ], [
      'name.required'        => 'The brand-name is required.',
      'name.max'             => 'The brand-name must be less than 50 characters.',
      'name.unique'          => 'The brand-name must be unique.',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $updateBrandData = [
      'name'    => $request->name,
      'slug'    => Str::slug( $request->name ),
      'origin'  => $request->origin,
    ];

    $brandUpdated = $brand->update( $updateBrandData );

    return redirect()->route('vehicle.brands')->with('success', "The brand ($brand->name) updated successfully!");
  }



}
