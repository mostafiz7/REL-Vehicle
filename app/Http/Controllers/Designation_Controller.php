<?php

namespace App\Http\Controllers;

use App\Models\Designation_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Designation_Controller extends Controller
{
  // Show New-Designation-Form
  function DesignationNew_Form( Request $request )
  {
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.employees.designations')->with([
      'designation_all' => $designation_all,
    ]);
  }


  // Store New-Designation
  function DesignationNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'name'       => [ 'required', 'string', 'max:50', 'unique:designations,name' ],
      'short_name' => [ 'required', 'string', 'max:20' ],
    ], [
      'name.required'        => 'The designation-name is required.',
      'name.max'             => 'The designation-name must be less than 50 characters.',
      'name.unique'          => 'The designation-name must be unique.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $newDesignationData = [
      'uid'         => Str::uuid(),
      'name'        => $request->name,
      'slug'        => Str::slug( $request->name ),
      'short_name'  => $request->short_name,
    ];

    $newDesignationAdded = Designation_Model::create( $newDesignationData );

    return back()->with('success', 'New Designation added successfully!');
  }



}
