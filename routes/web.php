<?php

use App\Http\Controllers\Purchase_Controller;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
  return view('homepage.home');
});


Route::get('/vehicle/parts/purchase/new', [Purchase_Controller::class, 'VehicleParts_Purchase_Form'])->name('vehicle.parts.new.purchase');
