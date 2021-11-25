<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Home_Controller extends Controller
{



  public function CreateSymbolicLink(): string
  {
    $target_folder = '/home/nurullah/vehicle.nurullah.biz/public/assets';
    $link_folder = '/home/nurullah/vehicle.nurullah.biz/assets';

    symlink( $target_folder, $link_folder );

    return '<h1 style="font-size: 52px;">Symbolic Link created successfully!</h1>';
  }



}
