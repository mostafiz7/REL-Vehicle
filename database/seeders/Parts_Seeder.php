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
      'uid'    => Str::uuid(),
      'name'   => 'Wheel-Japan',
      'slug'   => 'wheel-japan',
      'origin' => 'Japan',
      'metal'  => 'Rubber',
    ]);

    Parts_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Wheel-China',
      'slug'   => 'wheel-china',
      'origin' => 'China',
      'metal'  => 'Rubber',
    ]);

    Parts_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Wheel-India',
      'slug'   => 'wheel-india',
      'origin' => 'India',
      'metal'  => 'Rubber',
    ]);

    Parts_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Headlight-Japan',
      'slug'   => 'headlight-japan',
      'origin' => 'Japan',
      'metal'  => 'Glass & Aluminium',
    ]);

    Parts_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Headlight-China',
      'slug'   => 'headlight-china',
      'origin' => 'China',
      'metal'  => 'Glass & Aluminium',
    ]);

    Parts_Model::create([
      'uid'    => Str::uuid(),
      'name'   => 'Headlight-India',
      'slug'   => 'headlight-india',
      'origin' => 'India',
      'metal'  => 'Glass & Aluminium',
    ]);
  }



}
