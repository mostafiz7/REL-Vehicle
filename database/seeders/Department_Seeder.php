<?php

namespace Database\Seeders;

use App\Models\Department_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Department_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Department_Seeder

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'CI&DD',
      'slug' => 'ci&dd',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Marketing',
      'slug' => 'marketing',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Sales',
      'slug' => 'sales',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Audit',
      'slug' => 'audit',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Accounts',
      'slug' => 'accounts',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Finance',
      'slug' => 'finance',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Admin',
      'slug' => 'admin',
    ]);

    Department_Model::create([
      'uid'  => Str::uuid(),
      'name' => 'Factory',
      'slug' => 'factory',
    ]);

  }



}
