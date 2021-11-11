<?php

use App\Http\Controllers\Purchase_Controller;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
  return view('homepage.home');
});


Route::get('/vehicle/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Form'])->name('vehicle.parts.purchase.new');
Route::post('/vehicle/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Store'])->name('vehicle.parts.purchase.new');

