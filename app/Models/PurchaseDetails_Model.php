<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PurchaseDetails_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'purchase_details';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'purchase_type',
    'purchase_id',
    'purchase_no',
    'vehicle_id',
    'parts_id',
    'accessories_id',
    'serial',
    'size',
    'unit',
    'rate',
    'quantity',
    'amount',
    'remarks',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



}
