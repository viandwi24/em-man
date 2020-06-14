<?php

use App\Models\Web;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Web::create([]);
        $this->call(UsersTableSeeder::class);
    }
}
