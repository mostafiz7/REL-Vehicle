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



}
