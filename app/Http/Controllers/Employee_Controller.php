<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Employee_Model;
use Illuminate\Validation\Rule;
use App\Models\Department_Model;
use App\Models\Designation_Model;
use Illuminate\Support\Facades\Validator;


class Employee_Controller extends Controller
{
  // Show New-Employee-Form
  function EmployeeNew_Form( Request $request )
  {
    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    $employment_statuses = [ 'daily-basis', 'casual', 'permanent', 'probation' ];

    return view('modules.employees.new')->with([
      'department_all'      => $department_all,
      'designation_all'     => $designation_all,
      'employment_statuses' => $employment_statuses,
    ]);
  }


  // Store New-Employee
  function EmployeeNew_Store( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $employment_statuses = 'daily-basis,casual,permanent,probation';
    $employment_status = $request->employment_status == 'permanent';

    $validator = Validator::make( $request->all(), [
      'name'              => [ 'required', 'string', 'max:50' ],
      'nickname'          => [ 'nullable', 'string', 'max:20' ],
      'employment_status' => [ 'required', 'string', "in:$employment_statuses" ],
      'office_id'         => [ 'nullable', 'required_if:employment_status,==,permanent', 'string', 'max:10', 'unique:employees,office_id' ],
      /* 'office_id'         => [ 'nullable', Rule::requiredIf( $employment_status ), 'string', 'max:10', 'unique:employees,office_id' ], */
      'department_id'     => [ 'required', 'integer', 'exists:departments,id' ],
      'designation_id'    => [ 'required', 'integer', 'exists:designations,id' ],
      'authorize_power'   => [ 'nullable', 'string', 'in:authorizer' ],
      'purchase_power'    => [ 'nullable', 'string', 'in:purchaser' ],
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
      'uid'               => Str::uuid(),
      'name'              => $request->name,
      'nickname'          => ucwords( $request->nickname ),
      'active'            => true,
      'employment_status' => $request->employment_status,
      'office_id'         => $request->office_id ? strtoupper( $request->office_id ) : null,
      'designation_id'    => $request->designation_id,
      'department_id'     => $request->department_id,
      'user_id'           => null,
      'authorize_power'   => $authorize_power,
      'purchase_power'    => $purchase_power,
    ];

    $newEmployeeAdded = Employee_Model::create( $newEmployeeData );

    return back()->with('success', 'New Employee added successfully!');
  }


  // Single-Employee-Edit_Form
  function EmployeeSingleEdit_Form( Employee_Model $employee, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $employee ){
      return back()->with('error', 'The employee not found in system!');
    }

    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    $employment_statuses = [ 'daily-basis', 'casual', 'permanent', 'probation' ];

    return view('modules.employees.edit')->with([
      'employee'            => $employee,
      'department_all'      => $department_all,
      'designation_all'     => $designation_all,
      'employment_statuses' => $employment_statuses,
    ]);
  }


  // Single-Employee-Edit_Form
  function EmployeeSingle_Update( Employee_Model $employee, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    if( ! $employee ){
      return back()->with('error', 'The employee not found in system!');
    }
    

    return $employee;
  }



}
