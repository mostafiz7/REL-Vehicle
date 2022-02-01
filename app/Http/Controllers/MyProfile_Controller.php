<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class MyProfile_Controller extends Controller
{

  public function PasswordChange()
  {
    $user = auth()->user();

    return view('admin.my-profile.password-change', [
      'user' => $user,
    ]);
  }
  

  public function ChangePassword( Request $request )
  {
    if( $request->input('userId') != auth()->user()->id ){
      return back()->with('error', 'The user not matched with system!');
    }

    $validator = Validator::make( $request->all(), [
      'old_password' => [ 'required', 'string' ],
      'password'     => [ 'required', 'string', 'min:8', 'max:12', 'confirmed' ],
    ], [
      /*'password.required' => 'The designation-name is required.',*/
    ]);
    if( $validator->fails() ) return back()->withErrors( $validator )->withInput();

    $user = User::find( auth()->user()->id );

    if( Hash::check( $request->old_password, $user->password ) ){
      if( ! Hash::check( $request->password, $user->password ) ){
        $user->update([ 'password' => $request->password ]);

        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');

      } else{
        $validator->errors()->add('password', 'New password should not be same as previous one.');
        // session()->flash('error', 'New password should not be same as previous one.');
        return back()->withErrors( $validator )->withInput();
      }
    } else{
      $validator->errors()->add('old_password', 'Old password does not matched.');
      // session()->flash('error', 'Old password doesn\'t matched.');
      return back()->withErrors( $validator )->withInput();
    }
    
  }



}
