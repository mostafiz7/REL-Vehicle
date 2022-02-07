<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Employee_Model;
use Illuminate\Validation\Rule;
use App\Models\Department_Model;
use App\Models\Designation_Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class Employee_Controller extends Controller
{
  // Show All-Employee
  function EmployeeAll_Index( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


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

    $pagination_count = 10;
    $employee_all = Employee_Model::latest();

    if( ! empty($department_id) ){
      $employee_all = $employee_all->whereRelation('department', 'id', '=', $department_id);
    }

    if( ! empty($designation_id) ){
      $employee_all = $employee_all->whereRelation('designation', 'id', '=', $designation_id);
    }

    if( $assigned_role == 'authorize_power' ){
      $employee_all = $employee_all->where('authorize_power', 1);
    }

    if( $assigned_role == 'purchase_power' ){
      $employee_all = $employee_all->where('purchase_power', 1);
    }

    if( ! empty($employment_status) ){
      $employee_all = $employee_all->where('employment_status', $employment_status);
    }

    if( $status == 'active' ){
      $employee_all = $employee_all->where('active', 1);
    }

    if( $status == 'not-active' ){
      $employee_all = $employee_all->where('active', 0);
    }

    if( ! empty($search_by) ){
      $employee_all = $employee_all->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      });
    }

    $employee_all = $employee_all->orderBy('name', 'asc')
                                  ->paginate($pagination_count);

    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    return view('modules.employees.index')->with([
      'employee_all'        => $employee_all,
      'pagination_count'    => $pagination_count,
      'status'              => $status,
      'search_by'           => $search_by,
      'assigned_role'       => $assigned_role,
      'department_id'       => $department_id,
      'department_all'      => $department_all,
      'designation_id'      => $designation_id,
      'designation_all'     => $designation_all,
      'employment_status'   => $employment_status,
      'employment_statuses' => EmploymentStatus(),
    ]);

  }


  // Show New-Employee-Form
  function EmployeeNew_Form( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    // $employment_statuses = [ 'daily-basis', 'casual', 'permanent', 'probation' ];

    return view('modules.employees.new')->with([
      'department_all'      => $department_all,
      'designation_all'     => $designation_all,
      'employment_statuses' => EmploymentStatus(),
    ]);
  }


  // Store New-Employee
  function EmployeeNew_Store( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $employment_statuses = implode(',', EmploymentStatus());
    $employment_status = $request->employment_status == 'permanent';
    
    $validator = Validator::make( $request->all(), [
      'name'              => [ 'required', 'string', 'max:50' ],
      'nickname'          => [ 'nullable', 'string', 'max:20' ],
      'employment_status' => [ 'required', 'string', "in:$employment_statuses" ],
      'office_id'         => [ 'nullable', 'required_if:employment_status,==,permanent', 'string', 'max:10', 'unique:employees,office_id' ],
      /* 'office_id'         => [ 'nullable', Rule::requiredIf( $employment_status ), 'string', 'max:10', 'unique:employees,office_id' ], */
      'email_official'    => [ 'nullable', 'email:rfc,dns', 'max:191', 'unique:employees,email_official' ],
      'email_personal'    => [ 'nullable', 'email:rfc,dns', 'max:191' ],
      'department_id'     => [ 'required', 'integer', 'exists:departments,id' ],
      'designation_id'    => [ 'required', 'integer', 'exists:designations,id' ],
      'authorize_power'   => [ 'nullable', 'string', 'in:authorizer' ],
      'purchase_power'    => [ 'nullable', 'string', 'in:purchaser' ],
    ], [
      /*'name.required'        => 'The designation-name is required.',*/
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $authorize_power = $request->has('authorize_power') && $request->authorize_power == 'authorizer' && $request->employment_status == 'permanent';
    $purchase_power  = $request->has('purchase_power') && $request->purchase_power == 'purchaser' && $request->employment_status == 'permanent';

    $newEmployeeData = [
      'uid'               => Str::uuid(),
      'name'              => $request->name,
      'nickname'          => ucwords( $request->nickname ),
      'active'            => true,
      'employment_status' => $request->employment_status,
      'office_id'         => strtoupper( $request->office_id ),
      'email_official'    => $request->email_official,
      'email_personal'    => $request->email_personal,
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
  function EmployeeSingle_Edit( $employee_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $employee = Employee_Model::where('uid', $employee_uid)->first();

    if( ! $employee ) return back()->with('error', 'The employee not found in system!');

    $department_all  = Department_Model::orderBy('name', 'asc')->get()->all();
    $designation_all = Designation_Model::orderBy('name', 'asc')->get()->all();

    // $employment_statuses = [ 'daily-basis', 'casual', 'permanent', 'probation' ];
    
    return view('modules.employees.edit')->with([
      'employee'            => $employee,
      'department_all'      => $department_all,
      'designation_all'     => $designation_all,
      'employment_statuses' => EmploymentStatus(),
    ]);
  }


  // Update Employee
  function EmployeeSingle_Update( $employee_uid, Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    if( Gate::denies('isAdmins') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $employee = Employee_Model::where('uid', $employee_uid)->first();

    if( ! $employee ) return back()->with('error', 'The employee not found in system!');

    $user = $employee->user;
    
    $employment_statuses = implode(',', EmploymentStatus());
    $employment_status = $request->employment_status == 'permanent';

    $validator = Validator::make( $request->all(), [
      'name'              => [ 'required', 'string', 'max:50' ],
      'nickname'          => [ 'nullable', 'string', 'max:20' ],
      'status'            => [ 'required', 'string' ],
      'email_official'    => [ 'nullable', Rule::requiredIf($user), 'email:rfc,dns', 'max:191', "unique:employees,email_official, $employee->id" ],
      'email_personal'    => [ 'nullable', 'email:rfc,dns', 'max:191' ],
      'employment_status' => [ 'required', 'string', "in:$employment_statuses" ],
      'office_id'         => [ 'nullable', 'required_if:employment_status,==,permanent', 'string', 'max:10', "unique:employees,office_id, $employee->id" ],
      /* 'office_id'         => [ 'nullable', Rule::requiredIf( $employment_status ), 'string', 'max:10', 'unique:employees,office_id' ], */
      'department_id'     => [ 'required', 'integer', 'exists:departments,id' ],
      'designation_id'    => [ 'required', 'integer', 'exists:designations,id' ],
      'authorize_power'   => [ 'nullable', 'string', 'in:authorizer' ],
      'purchase_power'    => [ 'nullable', 'string', 'in:purchaser' ],
    ], [
      /*'name.unique' => 'The designation-name must be unique.',*/
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    if( $user ){
      $duplicate_user = User::where('email', $request->email_official)
                              ->where('id', '!=', $user->id)->first();
      if( $duplicate_user ){
        $validator->errors()->add('duplicate_user', 'The official-email must be unique!');
        return back()->withErrors( $validator )->withInput();
      }
      if( $request->employment_status != 'permanent' ){
        return back()->with('not-permanent', 'The employment-status should be must permanent!');
      }
    }

    $employee_info = [
      'name'  => $employee->name,
      'email' => $employee->email_official,
    ];

    $authorize_power = $request->has('authorize_power') && $request->authorize_power == 'authorizer' && $request->status == 'active';
    $purchase_power  = $request->has('purchase_power') && $request->purchase_power == 'purchaser' && $request->status == 'active';

    $employeeUpdateData = [
      'office_id'         => $request->office_id ? strtoupper( $request->office_id ) : $employee->office_id,
      'name'              => $request->name,
      'nickname'          => ucwords( $request->nickname ),
      'active'            => $request->status == 'active',
      'email_official'    => $request->email_official,
      'email_personal'    => $request->email_personal,
      'employment_status' => $request->employment_status,
      'designation_id'    => $request->designation_id,
      'department_id'     => $request->department_id,
      'authorize_power'   => $authorize_power,
      'purchase_power'    => $purchase_power,
    ];

    $employee_updated = tap($employee)->update( $employeeUpdateData );

    // if employee an user - update
    if( $user ){
      if( $employee_info['name'] != $request->name || $employee_info['email'] != $request->email_official || !$employee_updated->active ){
        if( $employee_info['name'] != $request->name ){
          $user_update['name'] = $request->name;
        }
        
        if( $employee_info['email'] != $request->email_official ){
          $user_update['email'] = $request->email_official;
        }

        if( !$employee_updated->active ){
          $user_update['active'] = false;
        }

        $user->update( $user_update );
      }
    }

    return redirect()->route('employee.all.show')->with('success', "The employee ($employee->name) updated successfully!");
  }



}
