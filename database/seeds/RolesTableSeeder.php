<?php

use Illuminate\Database\Seeder;
use NttpDev\Model\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ADMIN ROLE
        $role_employee = new Role();
        $role_employee->name = 'admin';
        $role_employee->display_name = 'ADMIN';
        $role_employee->save();

        //MANAGER ROLE
        $role_employee = new Role();
        $role_employee->name = 'manager';
        $role_employee->display_name = 'MANAGER';
        $role_employee->save();

        //USER ROLE
        $role_employee = new Role();
        $role_employee->name = 'user';
        $role_employee->display_name = 'USER';
        $role_employee->save();

    }
}
