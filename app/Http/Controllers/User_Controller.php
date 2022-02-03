<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role_Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Employee_Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class User_Controller extends Controller
{

  // Show All User
  public function UserAll_Index( Request $request )
  {
    // if( Gate::allows('isSuperAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryIndex') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $search_by            = $request->search_by ?? null;
    $permission_selected  = $request->permission_selected ?? null;
    $route_selected       = $request->route_selected ?? null;

    $permission_selected = $permission_selected == 'all' || $permission_selected == "" || $permission_selected == null || empty($permission_selected) ? null : $permission_selected;

    $route_selected = $route_selected == 'all' || $route_selected == "" || $route_selected == null || empty($route_selected) ? null : $route_selected;

    $users = User::latest();

    if( ! empty($search_by) ){
      $searchColumns  = [ 'name', 'username', 'email' ];
      
      $users = $users->where( function($q) use( $searchColumns, $search_by ){
        foreach( $searchColumns as $column )
          $q->orWhere( $column, 'like', "%{$search_by}%" );
      });
    }

    if( ! empty($permission_selected) ){
      $users = $users->whereJsonContains('permissions', $permission_selected);
    }

    if( ! empty($route_selected) ){
      $users = $users->whereJsonContains('routes', $route_selected);
    }

    $users = $users->orderBy('name', 'asc')->paginate(10);

    return view('admin.user.index', [
      'users'                => $users,
      'search_by'            => $search_by,
      'permissions'          => Permissions(),
      'permission_selected'  => $permission_selected,
      'routes'               => Routes(),
      'route_selected'       => $route_selected,
    ]);
  }


  // Show New User Form
  public function NewUser_Form( Request $request )
  {
    // if( Gate::allows('isSuperAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $employees = Employee_Model::whereNull('user_id')->where('active', true)
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
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryCreate') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $employee = Employee_Model::find( $request->employee_id );

    if( ! $employee ) return back()->with('not-employee', 'Please, select an employee that you want to make user!');

    $validator = Validator::make( $request->all(), [
      'employee_id' => [ 'required', 'integer', 'exists:employees,id,active,1', 'unique:users,employee_id' ],
      'username'    => [ 'required', 'string', 'min:5', 'max:20', 'unique:users,username' ],
      'email'       => [ Rule::requiredIf(!$employee->email_official), 'email:rfc,dns', 'max:191', 'unique:users,email' ],
      'password'    => [ 'required', 'string', 'min:8', 'max:12', 'confirmed' ],
      'role_id'     => [ 'required', 'integer', 'not_in:1' ],
    ], [
      'employee_id.unique' => 'The employee already has user access!',
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

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
      'employee_id' => $employee->id,
      'permissions' => $permissions,
      'routes'      => $routes,
    ];

    $user_created = User::create( $request_all );

    $employee->update([ 'user_id' => $user_created->id ]);

    return back()->with('success', 'New User created successfully!');
  }


  // Show User Edit Form
  public function EditUser_Form( $uid, Request $request )
  {
    // if( Gate::allows('isSuperAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $user = User::where('uid', $uid)->first();

    if( ! $user ) return back()->with('error', 'The user not found!');

    $roles = Role_Model::get()->all();

    return view('admin.user.edit', [
      'user'        => $user,
      'roles'       => $roles,
      'permissions' => Permissions(),
      'routes'      => Routes(),
    ]);
  }


  // Update User
  public function Update_User( $uid, Request $request )
  {
    // if( Gate::allows('isSuperAdmin', Auth::user()) ){}
    if( Gate::denies('isSuperAdmin') || Gate::denies('entryEdit') || Gate::denies('routeHasAccess') ){
      return back()->with('error', 'You are not authorized to perform this action!');
    }


    $user = User::where('uid', $uid)->first();

    if( ! $user ) return back()->with('error', 'The user not found!');

    $validator = Validator::make( $request->all(), [
      'name'       => [ 'required', 'string', 'min:2', 'max:191' ],
      'status'     => [ 'required', 'string' ],
      'username'   => [ 'prohibited' ],
      'email'      => [ 'required', 'email:rfc,dns', 'max:191', "unique:users,email, $user->id" ],
      'password'   => [ 'nullable', 'string', 'min:8', 'max:12', 'confirmed' ],
      'role_id'    => [ 'required', 'integer' ],
      // 'role_id'   => [ 'required', 'integer', 'not_in:1' ],
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $employee = Employee_Model::find( $user->employee_id );

    $user_info = [
      'name'  => $user->name,
      'email' => $user->email,
    ];

    $permissions = $request->permissions ?? null;
    $routes      = $request->routes ?? null;

    if( $request->status == 'active' ){
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
    }

    if( $request->status != 'active' ){
      $permissions = [];
      $routes      = [];
    }
    
    $request_all = [
      'name'        => $request->name,
      'email'       => strtolower( $request->email ),
      // 'username'    => $request->username,
      'active'      => $request->status == 'active',
      'role_id'     => $request->role_id,
      'permissions' => $permissions,
      'routes'      => $routes,
    ];

    if( ! empty($request->password) ){
      $request_all['password'] = $request->password;
      // $request_all['password'] = Hash::make($request->password);
    }

    $user_updated = tap($user)->update( $request_all );

    if( $user_info['name'] != $request->name || $user_info['email'] != $request->email || $user_updated->active != $employee->active || $user_updated->active == false ){
      if( $user_info['name'] != $request->name ){
        $employee_update['name'] = $request->name;
      }

      if( $user_info['email'] != $request->email ){
        $employee_update['email_official'] = $request->email;
      }

      if( $user_updated->active != $employee->active ){
        $employee_update['active'] = $user_updated->active;
      }

      if( $user_updated->active == false ){
        $employee_update['authorize_power'] = false;
        $employee_update['purchase_power']  = false;
      }

      $employee->update( $employee_update );
    }

    return redirect()->route('user.all.index')
           ->with('success', 'User updated successfully!');
  }



}
