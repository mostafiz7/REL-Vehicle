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
  // Show All-Employee
  function EmployeeAll_Index( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $status             = $request->status ?? null;
    $search_by          = $request->search_by ?? null;
    $assigned_role      = $request->assigned_role ?? null;
    $department_id      = $request->department_id ?? null;
    $designation_id     = $request->designation_id ?? null;
    $employment_status  = $request->employment_status ?? null;

    $status            = $status == 'all' || empty($status) ? null : $status;
    $assigned_role     = $assigned_role == 'all' || empty($assigned_role) ? null : $assigned_role;
    $department_id     = $department_id == 'all' || empty($department_id) ? null : $department_id;
    $designation_id    = $designation_id == 'all' || empty($designation_id) ? null : $designation_id;
    $employment_status = $employment_status == 'all' || empty($employment_status) ? null : $employment_status;
    
    $searchColumns  = [ 'name', 'nickname', 'office_id' ];

    // Filter or Search using relationship
    /*
    $employee_all = Employee_Model::orderBy('vehicle_no', 'asc')
      //->with('details')->has('details')
      //->whereRelation('details', 'vehicle_id', '=', $vehicle_id)
      ->whereHas('details', function($query) use($vehicle_id){
        $query->where('vehicle_id', '=', $vehicle_id);
      })
      ->get()->all();
      */

    $employee_all = null;
    
    if( $search_by ){
      $employee_all = Employee_Model::where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      })
      ->orderBy('name', 'asc')->get()->all();
    }

    elseif( $department_id ){
      $employee_all = Employee_Model::orderBy('name', 'asc')
      ->whereRelation('department', 'id', '=', $department_id)->get()->all();
    }

    elseif( $designation_id ){
      $employee_all = Employee_Model::orderBy('name', 'asc')
      ->whereRelation('designation', 'id', '=', $designation_id)->get()->all();
    }

    elseif( $assigned_role == 'authorize_power' ){
      $employee_all = Employee_Model::where('authorize_power', 1)
      ->orderBy('name', 'asc')->get()->all();
    }
    elseif( $assigned_role == 'purchase_power' ){
      $employee_all = Employee_Model::where('purchase_power', 1)
      ->orderBy('name', 'asc')->get()->all();
    }

    elseif( $employment_status ){
      $employee_all = Employee_Model::where('employment_status', $employment_status)
      ->orderBy('name', 'asc')->get()->all();
    }

    elseif( $status == 'active' ){
      $employee_all = Employee_Model::where('active', 1)
      ->orderBy('name', 'asc')->get()->all();
    }
    elseif( $status == 'not-active' ){
      $employee_all = Employee_Model::where('active', 0)
      ->orderBy('name', 'asc')->get()->all();
    }

    else{
      $employee_all = Employee_Model::orderBy('name', 'asc')->get()->all();
    }

    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    $employment_statuses = [ 'daily-basis', 'casual', 'permanent', 'probation' ];

    return view('modules.employees.index')->with([
      'employee_all'        => $employee_all,
      'status'              => $status,
      'search_by'           => $search_by,
      'assigned_role'       => $assigned_role,
      'department_id'       => $department_id,
      'department_all'      => $department_all,
      'designation_id'      => $designation_id,
      'designation_all'     => $designation_all,
      'employment_status'   => $employment_status,
      'employment_statuses' => $employment_statuses,
    ]);

  }


  // Show New-Employee-Form
  function EmployeeNew_Form( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

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


  // Employee Edit Form
  function EmployeeSingleEdit_Form( $employee_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $employee = Employee_Model::where('uid', $employee_uid)->first();

    if( ! $employee ) return back()->with('error', 'The employee not found in system!');

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


  // Update Employee
  function EmployeeSingle_Update( $employee_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /*if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }*/

    $employee = Employee_Model::where('uid', $employee_uid)->first();

    if( ! $employee ) return back()->with('error', 'The employee not found in system!');
    

    return $employee;
  }



}
