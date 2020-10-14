<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('id', '!=', 0)->delete();

        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'roles' => 'user',
            'password' => Hash::make('user'),
            'is_active' => true
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'roles' => 'admin',
            'password' => Hash::make('admin'),
            'is_active' => true
        ]);
    }
}
