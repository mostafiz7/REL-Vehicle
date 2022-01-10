<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
      {
        return route('homepage');

        /* if( Auth::user()->active ){
          // $Role_id = Auth::user()->role_id;
          $Role_id = Auth::user()->role_id;
          if( $Role_id == 1 || $Role_id == 2 || $Role_id == 3 || $Role_id == 4 || $Role_id == 5 ){
            return route('admin.dashboard');
          } elseif( $Role_id == 6 ){
            return route('members.home');
          }
        } else{
          Auth::logout();
          Session::flush();
          session()->flash('error', 'The user not active.');
          return route('login');
        } */
      }


  /**
   * Create a new controller instance.
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

}
