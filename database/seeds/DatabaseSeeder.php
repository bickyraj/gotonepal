<?php

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
        $this->call(AdminSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(RegionSeeder::class);
    }
}
