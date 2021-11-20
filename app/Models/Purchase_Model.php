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
    'purchase_type',
    'date',
    'memo_no',
    'vehicle_id',
    'requisition_id',
    'requisition_no',
    'purchased_by',
    'purchaser_name',
    'is_authorized',
    'authorized_by',
    'checked_by',
    'supplier_id',
    'supplier_name',
    'shop_name',
    'shop_slug',
    'shop_contact',
    'shop_location',
    'total_qty',
    'total_amount',
    'is_paid',
    'is_partial_paid',
    'paid_amount',
    'due_amount',
    'is_billed',
    'bill_id',
    'bill_no',
    'user_id',
    'entry_by',
    'notes',
    'device',
    'ip',
    'ip_address',
    'session_id',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



  public function purchaseDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(PurchaseDetails_Model::class, 'purchase_id');
  }


  public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Vehicle_Model::class);
  }


  public function requisition(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Requisition_Model::class);
  }


  public function purchaser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'purchased_by');
  }


  public function authorizer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'authorized_by');
  }


  public function checker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'checked_by');
  }


  public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Supplier_Model::class);
  }


  public function bill(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Bill_Model::class);
  }


  public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(User::class);
  }


  public function entryBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Employee_Model::class, 'entry_by');
  }



}
