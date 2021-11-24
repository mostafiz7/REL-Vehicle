<?php

namespace App\Http\Controllers;

use App\Models\Department_Model;
use App\Models\Designation_Model;
use App\Models\Employee_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class Employee_Controller extends Controller
{
  // Show New-Employee-Form
  function EmployeeNew_Form( Request $request )
  {
    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.employees.new')->with([
      'department_all'  => $department_all,
      'designation_all' => $designation_all,
    ]);
  }


  // Store New-Employee
  function EmployeeNew_Store( Request $request ): \Illuminate\Http\RedirectResponse
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $validator = Validator::make( $request->all(), [
      'office_id'       => [ 'required', 'string', 'max:10', 'unique:employees,office_id' ],
      'name'            => [ 'required', 'string', 'max:50' ],
      'department_id'   => [ 'required', 'integer', 'exists:departments,id' ],
      'designation_id'  => [ 'required', 'integer', 'exists:designations,id' ],
      'nickname'        => [ 'nullable', 'string', 'max:20' ],
      'authorize_power' => [ 'nullable', 'string', 'in:authorizer' ],
      'purchase_power'  => [ 'nullable', 'string', 'in:purchaser' ],
    ], [
      /*'name.required'        => 'The designation-name is required.',
      'name.max'             => 'The designation-name must be less than 50 characters.',
      'name.unique'          => 'The designation-name must be unique.',*/
    ]);
    if( $validator->fails() ){
      return back()->withErrors( $validator )->withInput();
    }

    $authorize_power = $request->has('authorize_power') && $request->authorize_power == 'authorizer';
    $purchase_power  = $request->has('purchase_power') && $request->purchase_power == 'purchaser';

    $newEmployeeData = [
      'uid'             => Str::uuid(),
      'office_id'       => strtoupper( $request->office_id ),
      'name'            => $request->name,
      'nickname'        => ucwords( $request->nickname ),
      'active'          => true,
      'designation_id'  => $request->designation_id,
      'department_id'   => $request->department_id,
      'user_id'         => null,
      'authorize_power' => $authorize_power,
      'purchase_power'  => $purchase_power,
    ];

    $newEmployeeAdded = Employee_Model::create( $newEmployeeData );

    return back()->with('success', 'New Employee added successfully!');
  }



}
