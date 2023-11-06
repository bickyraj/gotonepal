<?php

use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinations')->insert([
            'name' => 'nepal',
            'slug' => 'nepal',
            'description' => 'very good country for trekking'
        ]);
    }
}
