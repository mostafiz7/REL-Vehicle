<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VehicleCategory_Model extends Model
{
  use HasFactory;

  // connect with db table
  public $table = 'vehicle_category';


  // protected $primaryKey = 'id';
  // public $incrementing = false;


  // protected $guarded = [];
  // protected $guarded = array();
  protected $fillable = [
    'uid',
    'name',
    'slug',
  ];


  // Declare any field as json array
  /*protected $casts = [
    'cubic_capacity' => 'array',
  ];*/



  // relationship with Parts model
  public function vehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Vehicle_Model::class, 'category_id');
  }



}
