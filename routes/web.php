<?php

use App\Http\Controllers\Brand_Controller;
use App\Http\Controllers\Department_Controller;
use App\Http\Controllers\Designation_Controller;
use App\Http\Controllers\Employee_Controller;
use App\Http\Controllers\Home_Controller;
use App\Http\Controllers\Parts_Controller;
use App\Http\Controllers\PartsCategory_Controller;
use App\Http\Controllers\Purchase_Controller;
use App\Http\Controllers\Vehicle_Controller;
use App\Http\Controllers\VehicleCategory_Controller;
use App\Models\PartsCategory_Model;
use Illuminate\Support\Facades\Route;


Route::get('/', function (){
  return redirect()->route('vehicle.parts.purchase.search');
})->name('homepage');


// Create-Symbolic-Link
Route::get('/symlink', [Home_Controller::class, 'CreateSymbolicLink']);

// Database/Migration Table programmatically by using Artisan::call()
Route::get('/migration-update', [Home_Controller::class, 'DatabaseTableUpdate'])->name('database-migration-update');
Route::get('/migration-fresh', [Home_Controller::class, 'DatabaseTableFresh'])->name('database-migration-fresh');
Route::get('/migration-rollback', [Home_Controller::class, 'DatabaseTableRollback'])->name('database-migration-rollback');


Route::get('/module/employees/employee-new', [Employee_Controller::class, 'EmployeeNew_Form'])->name('employee.add.new');
Route::post('/module/employees/employee-new', [Employee_Controller::class, 'EmployeeNew_Store'])->name('employee.add.new');

Route::get('/module/employees/departments', [Department_Controller::class, 'DepartmentNew_Form'])->name('department.add.new');
Route::post('/module/employees/departments', [Department_Controller::class, 'DepartmentNew_Store'])->name('department.add.new');

Route::get('/module/employees/designations', [Designation_Controller::class, 'DesignationNew_Form'])->name('designation.add.new');
Route::post('/module/employees/designations', [Designation_Controller::class, 'DesignationNew_Store'])->name('designation.add.new');

Route::get('/module/vehicles/vehicle-new', [Vehicle_Controller::class, 'Show_VehicleAddForm'])->name('vehicle.add.new');
Route::post('/module/vehicles/vehicle-new', [Vehicle_Controller::class, 'VehicleNew_Store'])->name('vehicle.add.new');

Route::get('/module/vehicles/vehicle-brands', [Brand_Controller::class, 'BrandAddForm'])->name('vehicle.brands');
Route::post('/module/vehicles/vehicle-brands', [Brand_Controller::class, 'Store_NewBrand'])->name('vehicle.brands');

Route::get('/module/vehicles/vehicle-categories', [VehicleCategory_Controller::class, 'VehicleCategoryAddForm'])->name('vehicle.categories');
Route::post('/module/vehicles/vehicle-categories', [VehicleCategory_Controller::class, 'Store_NewVehicleCategory'])->name('vehicle.categories');

Route::get('/module/vehicles/parts-new', [Parts_Controller::class, 'Show_PartsAddForm'])->name('vehicle.parts.add.new');
Route::post('/module/vehicles/parts-new', [Parts_Controller::class, 'PartsNew_Store'])->name('vehicle.parts.add.new');

Route::get('/module/vehicles/parts-categories', [PartsCategory_Controller::class, 'PartsCategoryAddForm'])->name('vehicle.parts.categories');
Route::post('/module/vehicles/parts-categories', [PartsCategory_Controller::class, 'Store_NewPartsCategory'])->name('vehicle.parts.categories');

Route::get('/module/vehicles/parts/purchase-index', [Purchase_Controller::class, 'VehicleParts_Purchase_Index'])->name('vehicle.parts.purchase.all');
Route::get('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Form'])->name('vehicle.parts.purchase.new');
Route::post('/module/vehicles/parts/new-purchase', [Purchase_Controller::class, 'VehicleParts_Purchase_Store'])->name('vehicle.parts.purchase.new');
Route::get('/module/vehicles/parts/purchase/{purchase}/edit', [Purchase_Controller::class, 'VehiclePartsPurchase_EditForm'])->name('vehicle.parts.purchase.edit');
Route::post('/module/vehicles/parts/purchase/{purchase}/edit', [Purchase_Controller::class, 'VehiclePartsPurchase_Update'])->name('vehicle.parts.purchase.edit');

Route::get('/module/vehicles/parts/purchase/{purchase_uid}/item/{item_uid}/delete', [Purchase_Controller::class, 'VehiclePartsPurchaseItem_Delete'])->name('vehicle.parts.purchase.item.delete');

Route::get('/module/vehicles/parts/purchase-search', [Purchase_Controller::class, 'SearchForm_VehiclePartsPurchase'])->name('vehicle.parts.purchase.search');
Route::get('/module/vehicles/parts/purchase-search-result', [Purchase_Controller::class, 'SearchResult_VehiclePartsPurchase'])->name('vehicle.parts.purchase.search-result');


