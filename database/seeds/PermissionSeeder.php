<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sell = new Permission();
      $sell->name         = 'sell';
      $sell->display_name = 'Sell';
      $sell->description  = 'Sell items'; // optional
      $sell->save();

      $managesales = new Permission();
      $managesales->name         = 'manage-sales';
      $managesales->display_name = 'Manage Sell';
      $managesales->description  = 'Manage Selss'; // optional
      $managesales->save();

      $manageusers = new Permission();
      $manageusers->name         = 'manage-user';
      $manageusers->display_name = 'Manage Users';
      $manageusers->description  = 'Manage Users'; // optional
      $manageusers->save();

      $generatereports = new Permission();
      $generatereports->name         = 'generate-reports';
      $generatereports->display_name = 'Generate Reports';
      $generatereports->description  = 'Generate sales reports'; // optional
      $generatereports->save();

      $manageproducts = new Permission();
      $manageproducts->name         = 'manage-products';
      $manageproducts->display_name = 'Manage Products';
      $manageproducts->description  = 'Manage Products'; // optional
      $manageproducts->save();
    }
}
