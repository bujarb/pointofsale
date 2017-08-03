<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $owner = new Role();
      $owner->name         = 'cashier';
      $owner->display_name = 'Cashierr'; // optional
      $owner->description  = 'User is the cashier'; // optional
      $owner->save();

      $admin = new Role();
      $admin->name         = 'admin';
      $admin->display_name = 'User Administrator'; // optional
      $admin->description  = 'User is allowed to manage and edit other users'; // optional
      $admin->save();
    }
}
