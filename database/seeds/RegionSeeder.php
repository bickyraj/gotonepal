<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            'name' => 'himalaya',
            'slug' => 'himalaya',
            'description' => 'himalayan region'
        ]);

        $region = App\Region::find(1);
        $region->destinations()->attach([1]);

        // save activities to the region_destination table
        $region->activities()->attach([1]);
    }
}
