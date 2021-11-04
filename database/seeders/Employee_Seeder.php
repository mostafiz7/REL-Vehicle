<?php

namespace Database\Seeders;

use App\Models\Employee_Model;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class Employee_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Employee_Seeder

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010058',
      'user_id'        => null,
      'name'           => 'Md. Sohag',
      'nickname'       => 'Sohag 1',
      'active'         => true,
      'designation_id' => 4,
      'department_id'  => 1,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010098',
      'user_id'        => null,
      'name'           => 'Md. Rajib',
      'nickname'       => 'Rajib',
      'active'         => true,
      'designation_id' => 4,
      'department_id'  => 1,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010145',
      'user_id'        => null,
      'name'           => 'Md. Jahangir',
      'nickname'       => 'Jahangir',
      'active'         => true,
      'designation_id' => 4,
      'department_id'  => 3,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010284',
      'user_id'        => null,
      'name'           => 'Md. Selim Molla',
      'nickname'       => 'Molla',
      'active'         => true,
      'designation_id' => 4,
      'department_id'  => 2,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010376',
      'user_id'        => null,
      'name'           => 'Md. Tuhin',
      'nickname'       => 'Tuhin',
      'active'         => true,
      'designation_id' => 4,
      'department_id'  => 3,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010428',
      'user_id'        => null,
      'name'           => 'Md. Sharafat',
      'nickname'       => 'Sharafat',
      'active'         => true,
      'designation_id' => 5,
      'department_id'  => 1,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010467',
      'user_id'        => null,
      'name'           => 'Md. Rayhan',
      'nickname'       => 'Rayhan',
      'active'         => true,
      'designation_id' => 5,
      'department_id'  => 1,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010572',
      'user_id'        => null,
      'name'           => 'Md. Mannan',
      'nickname'       => 'Mannan',
      'active'         => true,
      'designation_id' => 5,
      'department_id'  => 3,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010518',
      'user_id'        => null,
      'name'           => 'Md. Sajal Ahmed',
      'nickname'       => 'Sajal',
      'active'         => true,
      'designation_id' => 5,
      'department_id'  => 2,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010239',
      'user_id'        => null,
      'name'           => 'Md. Hannan Mridha',
      'nickname'       => 'Hannan',
      'active'         => true,
      'designation_id' => 5,
      'department_id'  => 3,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010464',
      'user_id'        => null,
      'name'           => 'Md. Ruhul Amin',
      'nickname'       => 'Ruhul 1',
      'active'         => true,
      'designation_id' => 6,
      'department_id'  => 1,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010483',
      'user_id'        => null,
      'name'           => 'Md. Ruhul Amin',
      'nickname'       => 'Ruhul 2',
      'active'         => true,
      'designation_id' => 6,
      'department_id'  => 1,
    ]);

    Employee_Model::create([
      'uid'            => Str::uuid(),
      'office_id'      => '010359',
      'user_id'        => null,
      'name'           => 'Md. Khalil Mondol',
      'nickname'       => 'Khalil',
      'active'         => true,
      'designation_id' => 6,
      'department_id'  => 2,
    ]);

  }



}
