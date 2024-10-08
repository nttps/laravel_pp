<?php

use Illuminate\Database\Seeder;
use NttpsApp\Models\Role;
use NttpsApp\Models\Permission;
use NttpsApp\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Explode roles
        $roles_array = array(
            'ADMIN',
            'USER',
        );

        // add roles
        foreach($roles_array as $role) {
            $role = Role::firstOrCreate(['name' => trim($role)]);

            if( $role->name == 'Admin' ) {                // assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('Admin granted all the permissions');
            } else {
                // for others by default only read access
                $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
            }            // create one user for each role
            $this->createUser($role);
        }
       
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if( $role->name == 'Admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
