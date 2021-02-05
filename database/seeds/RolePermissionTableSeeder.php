<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'super admin',
            'email' => 'playground@mail.com',
            'password' => Hash::make('12345')
        ]);

        $superAdmin = Role::create([
            'name' => 'super admin',
            'slug' => 'super.admin',
            'description' => '',
            'level' => '10'
        ]);

        $user->attachRole($superAdmin);
    }
}
