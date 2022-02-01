<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Employee_Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class User_Controller extends Controller
{

  // Show New User Form
  public function NewUser_Form( Request $request )
  {
    // if( Gate::allows('isSuperAdmin', Auth::user()) ){}
    /* if( Gate::denies('isSuperAdmin') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    } */

    $employees = Employee_Model::whereNull('user_id')
                               ->orderBy('name', 'asc')->get()->all();

    $roles     = Role_Model::get()->all();

    return view('admin.user.new', [
      'employees'   => $employees,
      'roles'       => $roles,
      'permissions' => Permissions(),
      'routes'      => Routes(),
    ]);
  }


  // Save New User
  public function Store_NewUser( Request $request )
  {
    // if( Gate::allows('isAdmin', Auth::user()) ){}
    /* if( Gate::denies('isSuperAdmin') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    } */

    $employee = Employee_Model::find( $request->employee_id );

    if( ! $employee ) return back()->with('not-employee', 'Please, select employee that you wanted to make user!');

    $validator = Validator::make( $request->all(), [
      'employee_id' => [ 'required', 'integer', 'exists:employees,id,active,1', 'unique:users,employee_id' ],
      'username'    => [ 'required', 'string', 'min:5', 'max:20', 'unique:users,username' ],
      'email'       => [ Rule::requiredIf(!$employee->email_official), 'email:rfc,dns', 'max:191', 'unique:users,email' ],
      //'email'       => [ 'required', 'email:rfc,dns', 'max:191', 'unique:users,email' ],
      'password'    => [ 'required', 'string', 'confirmed' ],
      //'password'    => [ 'required', 'string', 'min:8', 'max:12', 'confirmed' ],
      'role_id'     => [ 'required', 'integer', 'not_in:1' ],
    ], [
      'employee_id.unique' => 'The employee already has user access!',
    ]);
    if( $validator->fails() ){ return back()->withErrors( $validator )->withInput(); }

    $permissions = $request->permissions ?? null;
    $routes      = $request->routes ?? null;

    if( ! $permissions ){
      $validator->errors()->add('permissions', 'At-least one permission is required!');
      // session()->flash('error', 'At-least one permission is required!');
      return back()->withErrors( $validator )->withInput();
    }
    if( ! $routes ){
      $validator->errors()->add('routes', 'At-least one route is required!');
      // session()->flash('error', 'At-least one route is required!');
      return back()->withErrors( $validator )->withInput();
    }
    
    $request_all = [
      // 'id'          => mb_strtoupper( Str::orderedUid() ),
      'uid'         => Str::uuid(),
      'name'        => $employee->name,
      'email'       => $employee->email_official ?? strtolower( $request->email ),
      'username'    => $request->username,
      'active'      => true,
      'password'    => $request->password,
      // 'password'    => Hash::make($request->password),
      'role_id'     => $request->role_id,
      'employee_id' => $request->employee_id,
      'permissions' => $permissions,
      'routes'      => $routes,
    ];

    $user_created = User::create( $request_all );

    return back()->with('success', 'New User created successfully!');
  }



}
