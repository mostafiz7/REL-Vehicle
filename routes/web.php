<?php

use App\Http\Controllers\Purchase_Controller;
use App\Http\Controllers\Vehicle_Controller;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
  return view('homepage.home');
});


Route::get('/module/vehicles/vehicle/add', [Vehicle_Controller::class, 'Show_VehicleAddForm'])->name('vehicle.new.add');
Route::post('/module/vehicles/vehicle/add', [Vehicle_Controller::class, 'VehicleNew_Store'])->name('vehicle.new.add');

Route::get('/module/vehicles/parts/purchase-index', [Purchase_Controller::class, 'VehicleParts_Purchase_Index'])->name('vehicle.parts.purchase.all');
Route::get('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Form'])->name('vehicle.parts.purchase.new');
Route::post('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Store'])->name('vehicle.parts.purchase.new');

