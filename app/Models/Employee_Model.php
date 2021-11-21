<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'employees';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'office_id',
    'name',
    'nickname',
    'active',
    'designation_id',
    'department_id',
    'authorize_power',
    'purchase_power',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'employees' => 'array',
  ];*/



  public function designation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Designation_Model::class);
  }


  public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Department_Model::class);
  }


  public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(User::class);
  }


  public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Vehicle_Model::class, 'driver_id');
  }


  public function bills(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Bill_Model::class, 'employee_id');
  }


  public function billPaying(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Bill_Model::class, 'billPayer_id');
  }


  public function billChecked(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Bill_Model::class, 'checked_by');
  }



}
