<?php

namespace Database\Seeders;

use App\Models\VehicleType_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class VehicleType_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=VehicleType_Seeder

    VehicleType_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Pickup Van',
      'slug'  => 'pickup-van',
    ]);

    VehicleType_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Cover Van',
      'slug'  => 'cover-van',
    ]);

    VehicleType_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Truck',
      'slug'  => 'truck',
    ]);

    VehicleType_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Private Car',
      'slug'  => 'private-car',
    ]);

    VehicleType_Model::create([
      'uid'   => Str::uuid(),
      'name'  => 'Micro Bus',
      'slug'  => 'micro-bus',
    ]);

  }



}
