<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vehicle_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'vehicles';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'vehicle_no',
    'slug',
    'vehicle_type',
    'brand_id',
    'department_id',
    'driver_id',
    'helper_id',
    'helper_name',
    'is_running',
    'wheels',
    'engine_cc',
    'purchase_date',
    'sold_date',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



}
