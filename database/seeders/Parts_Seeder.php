<?php

namespace Database\Seeders;

use App\Models\Parts_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Parts_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Parts_Seeder

    Parts_Model::create([
      'uid'         => Str::uuid(),
      'name'        => 'Wheel-Japan',
      'slug'        => 'wheel-japan',
      'category_id' => 1,
      'origin'      => 'Japan',
      'sizes'       => null,
      'metals'      => null,
      'materials'   => null,
      'unit'        => 'Pcs',
    ]);

    Parts_Model::create([
      'uid'         => Str::uuid(),
      'name'        => 'Wheel-China',
      'slug'        => 'wheel-china',
      'category_id' => 1,
      'origin'      => 'China',
      'sizes'       => null,
      'metals'      => null,
      'materials'   => null,
      'unit'        => 'Pcs',
    ]);

    Parts_Model::create([
      'uid'         => Str::uuid(),
      'name'        => 'Wheel-India',
      'slug'        => 'wheel-india',
      'category_id' => 2,
      'origin'      => 'India',
      'sizes'       => null,
      'metals'      => null,
      'materials'   => null,
      'unit'        => 'Pcs',
    ]);

    Parts_Model::create([
      'uid'         => Str::uuid(),
      'name'        => 'Headlight-Japan',
      'slug'        => 'headlight-japan',
      'category_id' => 2,
      'origin'      => 'Japan',
      'sizes'       => null,
      'metals'      => null,
      'materials'   => null,
      'unit'        => 'Pcs',
    ]);

    Parts_Model::create([
      'uid'         => Str::uuid(),
      'name'        => 'Headlight-China',
      'slug'        => 'headlight-china',
      'category_id' => 1,
      'origin'      => 'China',
      'sizes'       => null,
      'metals'      => null,
      'materials'   => null,
      'unit'        => 'Pcs',
    ]);

    Parts_Model::create([
      'uid'         => Str::uuid(),
      'name'        => 'Headlight-India',
      'slug'        => 'headlight-india',
      'category_id' => 2,
      'origin'      => 'India',
      'sizes'       => null,
      'metals'      => null,
      'materials'   => null,
      'unit'        => 'Pcs',
    ]);

  }



}
