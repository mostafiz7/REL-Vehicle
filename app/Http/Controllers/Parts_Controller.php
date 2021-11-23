<?php

namespace App\Http\Controllers;

use App\Models\Parts_Model;
use App\Models\PartsCategory_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Parts_Controller extends Controller
{
  // Show Parts-Add-Form
  function Show_PartsAddForm( Request $request )
  {
    $category_all    = PartsCategory_Model::orderBy('name', 'asc')->get()->all();

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

    $units  = [ 'feet', 'inch', 'litre', 'mitre', 'pcs' ];

    return view('modules.vehicle-module.parts.new')->with([
      'category_all'    => $category_all,
      'origin_country'  => $origin_country,
      'units'           => $units,
    ]);
  }


  // Store New-Parts
  function PartsNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'name'           => [ 'required', 'string', 'max:50', 'unique:parts,name' ],
      'category_id'    => [ 'required', 'integer', 'exists:parts_category,id' ],
      'unit'           => [ 'required', 'string', 'max:10' ],
      'origin'         => [ 'required', 'string', 'max:20' ],

      'description'    => [ 'nullable', 'string', 'max:191' ],
      'sizes'          => [ 'nullable', 'string', 'max:191' ],
      'metals'         => [ 'nullable', 'string', 'max:191' ],
      'materials'      => [ 'nullable', 'string', 'max:191' ],
    ], [
      'name.required'        => 'The parts-name is required.',
      'name.max'             => 'The parts-name must be less than 50 characters.',
      'name.unique'          => 'The parts-name must be unique.',
      'category_id.required' => 'The category is required.',
      'category_id.exists'   => 'The category does not exists.',
      'origin.required'      => 'The origin-country is required.',
      'origin.max'           => 'The origin-country must be less than 20 characters.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $origin = ucwords( str_replace('-', ' ', $request->origin) );
    $parts_name = $request->name . ' - ' . str_replace(' ', '-', $origin);

    $newPartsData = [
      'uid'          => Str::uuid(),
      'name'         => $parts_name,
      'slug'         => Str::slug( $parts_name ),
      'category_id'  => $request->category_id ?? null,
      'description'  => $request->description ?? null,
      'sizes'        => $request->sizes ?? null,
      'metals'       => $request->metals ?? null,
      'materials'    => $request->materials ?? null,
      'unit'         => $request->unit ?? null,
      'origin'       => $request->origin ?? null,
    ];

    $newPartsAdded = Parts_Model::create( $newPartsData );

    return back()->with('success', 'New Parts added successfully!');
  }



}
