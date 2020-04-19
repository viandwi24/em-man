<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = User::create([
            'nama' => 'Super Admin',
            'username' => 'admin',
            'password' => bcrypt('password')
        ]);
    }
}
