<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Employee_Model;
use Illuminate\Database\Seeder;

class User_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=User_Seeder

    User::create([
      'uid'               => Str::uuid(),
      'name'              => 'Nurullah Mohammad',
      'email'             => 'nurullah@rangs.com.bd',
      'username'          => 'nurullah',
      'active'            => 1,
      'password'          => '000',
      'role_id'           => 1,
      'employee_id'       => 1,
      'email_verified_at' => now(),
      'permissions'       => ['index', 'create', 'view', 'edit', 'delete', 'print'],
      'routes'            => [
        'admin.dashboard',
        /* 'database.migration.update',
        'database.migration.fresh',
        'database.migration.fresh.seed',
        'database.migration.rollback',
        'database.seed', */
        'employee.all.show',
        'employee.add.new',
        'employee.single.edit',
        'profile.password.change',
        'user.all.index',
        'user.add.new',
        'user.single.edit',
      ],
    ]);
    

    /* User::create([
      'uid'               => Str::uuid(),
      'name'              => 'Kamrul Islam',
      'email'             => 'kamrul_islam@gmail.com',
      'username'          => 'kamrul_islam',
      'active'            => 1,
      'password'          => '00',
      'role_id'           => 2,
      'employee_id'       => 2,
      'email_verified_at' => now(),
      'permissions'       => ['index', 'create', 'view', 'edit', 'delete', 'print'],
      'routes'            => [
        'employee.all.show',
        'employee.add.new',
        'employee.single.edit',
      ],
    ]); */


    Employee_Model::find(1)->update([
      'email_official'    => 'nurullah@rangs.com.bd',
      'employment_status' => 'permanent',
      'user_id'           => 1,
    ]);
    
  }

}
