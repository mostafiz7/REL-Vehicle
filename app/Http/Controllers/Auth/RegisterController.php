<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

  use RegistersUsers;


  /**
   * Where to redirect users after registration.
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;


  /**
   * Create a new controller instance.
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }


  // Show-New-User-Registration-Form
  public function registerForm()
  {
    // return view('auth.register');
    return redirect()->route('login');
  }


  /**
   * Get a validator for an incoming registration request.
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name'      => [ 'required', 'string', 'max:191' ],
      'email'     => [ 'required', 'string', 'email:rfc,dns', 'max:191', 'unique:users' ],
      'password'  => [ 'required', 'string', 'min:8', 'confirmed' ],
    ]);
  }


  /**
   * Create a new user instance after a valid registration.
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    return User::create([
      'name'      => $data['name'],
      'email'     => $data['email'],
      // 'password'  => Hash::make($data['password']),
      'password'  => $data['password'],
    ]);
  }

}
