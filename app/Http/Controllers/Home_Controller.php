<?php

namespace App\Http\Controllers;

use App\Models\Parts_Model;
use Illuminate\Http\Request;
use App\Models\Vehicle_Model;
use Illuminate\Support\Facades\Artisan;


class Home_Controller extends Controller
{
  /**
   * Create a new controller instance.
   * @return void
   */
  /* public function __construct()
  {
    $this->middleware('auth');
  } */


  /**
   * Show the application dashboard.
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function Homepage()
  {
    $parts_all   = Parts_Model::orderBy( 'name', 'asc' )->get()->all();
    $vehicle_all = Vehicle_Model::orderBy( 'vehicle_no', 'asc' )->get()->all();

    return view('homepage.home')->with([
      'parts_all'     => $parts_all,
      'vehicle_all'   => $vehicle_all,
    ]);
  }


  // Create-Symbolic-Link
  public function CreateSymbolicLink()
  {
    $target_folder = '/home/rangsapp/public_html/public/assets';
    $link_folder   = '/home/rangsapp/public_html/assets';

    symlink( $target_folder, $link_folder );

    return redirect()->route('homepage')->with('success', 'Symbolic-Link created successfully!');
  }
  
  
  // Create-Laravel-Storage-Link
  public function CreateStorageLink()
  {
    // Call Artisan Command in Controller
    Artisan::call('storage:link', []);

    return redirect()->route('homepage')->with('success', 'Symbolic-Link created successfully!');
  }


  // Database/Migration Table Update by Artisan Command
  public function DatabaseTableUpdate()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate', []);

    return redirect()->route('homepage')->with('success', 'Migration updated successfully!');
  }
  
  
  // Database/Migration Table Fresh by Artisan Command
  public function DatabaseTableFresh()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:fresh', []);

    return redirect()->route('homepage')->with('success', 'Migration successfully!');
  }
  
  
  // Database/Migration Table Fresh by Artisan Command
  public function DatabaseTableFreshSeed()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:fresh --seed', []);

    return redirect()->route('homepage')->with('success', 'Migration with dummy data successfully done!');
  }

  
  // Database/Migration Table Rollback by Artisan Command
  public function DatabaseTableRollback()
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:rollback', []);

    return redirect()->route('homepage')->with('success', 'Migration rollbacked successfully!');
  }
  

  // DB/Seed by Artisan Command
  public function DatabaseSeed()
  {
    // Call Artisan Command in Controller
    Artisan::call('db:seed', []);

    return redirect()->route('homepage')->with('success', 'Dummy data inserted successfully!');
  }
  

  // clear-view by Artisan Command
  public function ViewClear()
  {
    // Call Artisan Command in Controller
    Artisan::call('view:clear', []);

    return redirect()->route('homepage')->with('success', 'View cleared successfully!');
  }
  

  // clear-route by Artisan Command
  public function RouteClear()
  {
    // Call Artisan Command in Controller
    Artisan::call('route:clear', []);

    return redirect()->route('homepage')->with('success', 'Route cleared successfully!');
  }
  

  // clear-cache by Artisan Command
  public function CacheClear()
  {
    // Call Artisan Command in Controller
    Artisan::call('cache:clear', []);

    return redirect()->route('homepage')->with('success', 'Cache cleared successfully!');
  }
  

  // clear-config by Artisan Command
  public function ConfigClear()
  {
    // Call Artisan Command in Controller
    Artisan::call('config:clear', []);

    return redirect()->route('homepage')->with('success', 'Config cleared successfully!');
  }
  

  // cache-config by Artisan Command
  public function ConfigCache()
  {
    // Call Artisan Command in Controller
    Artisan::call('config:cache', []);

    return redirect()->route('homepage')->with('success', 'Config cached successfully!');
  }



}
