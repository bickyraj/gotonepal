<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            'name' => 'trekking',
            'slug' => 'trekking',
            'destination_id' => 1,
            'description' => 'good activity'
        ]);
        $activity = App\Activity::find(1);
        $activity->destinations()->attach([1]);

    }
}
