<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_items')->insert(
            [
                [
                    'schedule_id' => 1,
                    'day' => 1,
                    'name' => 'Lat Pull Down',
                    'reps' => '10 x 3 = 30 Reps',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'schedule_id' => 1,
                    'day' => 2,
                    'name' => 'Bench Press',
                    'reps' => '10 x 3 = 30 Reps',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'schedule_id' => 1,
                    'day' => 3,
                    'name' => 'Dumbbell Pull Over',
                    'reps' => '10 x 3 = 30 Reps',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]
        );
    }
}
