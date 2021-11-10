<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Purchase_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'purchases';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'purchase_no',
    'type',
    'vehicle_id',
    'requisition_id',
    'requisition_no',
    'purchaser_id',
    'purchaser_name',
    'supplier_id',
    'supplier_name',
    'date',
    'shop_name',
    'shop_slug',
    'shop_contact',
    'shop_location',
    'memo_no',
    'total_qty',
    'total_amount',
    'is_paid',
    'is_partial_paid',
    'paid_amount',
    'due_amount',
    'is_billed',
    'bill_id',
    'bill_no',
    'is_authorized',
    'authorizer_id',
    'user_id',
    'entry_by',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



}
