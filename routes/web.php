<?php

use App\Http\Controllers\Parts_Controller;
use App\Http\Controllers\PartsCategory_Controller;
use App\Http\Controllers\Purchase_Controller;
use App\Http\Controllers\Vehicle_Controller;
use App\Models\PartsCategory_Model;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
  return view('homepage.home');
});


Route::get('/module/vehicles/add-vehicle', [Vehicle_Controller::class, 'Show_VehicleAddForm'])->name('vehicle.new.add');
Route::post('/module/vehicles/add-vehicle', [Vehicle_Controller::class, 'VehicleNew_Store'])->name('vehicle.new.add');

Route::get('/module/vehicles/add-parts', [Parts_Controller::class, 'Show_PartsAddForm'])->name('vehicle.parts.add.new');
Route::post('/module/vehicles/add-parts', [Parts_Controller::class, 'PartsNew_Store'])->name('vehicle.parts.add.new');

Route::get('/module/vehicles/parts-categories', [PartsCategory_Controller::class, 'PartsCategoryAddForm'])->name('vehicle.parts.categories');
Route::post('/module/vehicles/parts-categories', [PartsCategory_Controller::class, 'Store_NewPartsCategory'])->name('vehicle.parts.categories');

Route::get('/module/vehicles/parts/purchase-index', [Purchase_Controller::class, 'VehicleParts_Purchase_Index'])->name('vehicle.parts.purchase.all');
Route::get('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Form'])->name('vehicle.parts.purchase.new');
Route::post('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Store'])->name('vehicle.parts.purchase.new');

