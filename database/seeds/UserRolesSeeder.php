<?php

use Illuminate\Database\Seeder;
use App\Role;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin','user'];
        foreach ($roles as $key => $role) {
            App\Role::create([
                'role' => $role,
            ]);
        }
    }
}
