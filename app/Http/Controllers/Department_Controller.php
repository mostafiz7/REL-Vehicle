<?php

namespace App\Http\Controllers;

use App\Models\Department_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Department_Controller extends Controller
{
  // Show New-Department-Form
  function DepartmentNew_Form( Request $request )
  {
    $department_all = Department_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.employees.departments')->with([
      'department_all' => $department_all,
    ]);
  }


  // Store New-Department
  function DepartmentNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'name'       => [ 'required', 'string', 'max:50', 'unique:departments,name' ],
      'short_name' => [ 'required', 'string', 'max:20' ],
    ], [
      'name.required'        => 'The department-name is required.',
      'name.max'             => 'The department-name must be less than 50 characters.',
      'name.unique'          => 'The department-name must be unique.',
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $newDepartmentData = [
      'uid'         => Str::uuid(),
      'name'        => $request->name,
      'slug'        => Str::slug( $request->name ),
      'short_name'  => $request->short_name,
    ];

    $newDepartmentAdded = Department_Model::create( $newDepartmentData );

    return back()->with('success', 'New Department added successfully!');
  }



}
