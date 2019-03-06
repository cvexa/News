<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$role = Role::where('role','admin')->first();
        App\User::create([
                'name' => 'Admin',
		        'email' => 'admin@gmail.com',
		        'email_verified_at' => now(),
		        'password' => Hash::make(123321123),
		        'remember_token' => Str::random(10),
		        'role_id' => $role->id,
        ]);
    }
}
