<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class Home_Controller extends Controller
{


  // Create-Symbolic-Link
  public function CreateSymbolicLink(): string
  {
    $link_folder   = '/home/nurullah/vehicle.nurullah.biz/assets';
    $target_folder = '/home/nurullah/vehicle.nurullah.biz/public/assets';

    symlink( $target_folder, $link_folder );

    return redirect()->route('homepage')->with('success', 'Symbolic-Link created successfully!');
  }


  // Database/Migration Table Update by Artisan Command
  public function DatabaseTableUpdate(): string
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate', []);

    return redirect()->route('homepage')->with('success', 'Migration updated successfully!');
  }
  
  
  // Database/Migration Table Fresh by Artisan Command
  public function DatabaseTableFresh(): string
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:fresh', []);

    return redirect()->route('homepage')->with('success', 'Migration successfully!');
  }

  
  // Database/Migration Table Rollback by Artisan Command
  public function DatabaseTableRollback(): string
  {
    // Call Artisan Command in Controller
    Artisan::call('migrate:rollback', []);

    return redirect()->route('homepage')->with('success', 'Migration rollbacked successfully!');
  }



}
