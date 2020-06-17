<?php

use App\Country;
use App\User;
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
        Country::truncate();
        User::truncate();

        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
        ]);
    }
}
