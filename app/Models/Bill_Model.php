<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bill_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'bills';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'bill_no',
    'type',
    'requisition_id',
    'requisition_no',
    'user_id',
    'employee_id',
    'billPayer_id',
    'checked_by',
    'bill_date',
    'total_amount',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'materials' => 'array',
  ];*/



}
