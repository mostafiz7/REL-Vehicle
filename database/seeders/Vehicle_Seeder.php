<?php

namespace Database\Seeders;

use App\Models\Vehicle_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Vehicle_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Vehicle_Seeder

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro TA-0439',
      'slug'           => 'dhaka-metro-ta-0439',
      'brand_id'       => 1,
      'department_id'  => 1,
      'vehicleType_id' => 2,
      'running'        => 1,
      'wheels'         => 6,
      'cubic_capacity' => 1500,
      'purchase_date'  => '2010-07-25',
      'sold_date'      => null,
    ]);

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro TA-1516',
      'slug'           => 'dhaka-metro-ta-1516',
      'brand_id'       => 1,
      'department_id'  => 1,
      'vehicleType_id' => 2,
      'running'        => 1,
      'wheels'         => 4,
      'cubic_capacity' => 1200,
      'purchase_date'  => '2012-05-18',
      'sold_date'      => null,
    ]);

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro TA-6539',
      'slug'           => 'dhaka-metro-ta-6539',
      'brand_id'       => 5,
      'department_id'  => 2,
      'vehicleType_id' => 1,
      'running'        => 1,
      'wheels'         => 4,
      'cubic_capacity' => 800,
      'purchase_date'  => '2015-09-22',
      'sold_date'      => null,
    ]);

    Vehicle_Model::create([
      'uid'            => Str::uuid(),
      'vehicle_no'     => 'Dhaka Metro KA-6065',
      'slug'           => 'dhaka-metro-ka-6065',
      'brand_id'       => 5,
      'department_id'  => 3,
      'vehicleType_id' => 4,
      'running'        => 1,
      'wheels'         => 4,
      'cubic_capacity' => 1800,
      'purchase_date'  => '2018-11-05',
      'sold_date'      => null,
    ]);

  }



}
