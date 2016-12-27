<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert(
            [
                [
                    'member_id' => 1,
                    'issued_date' => Carbon::today()->toDateString(),
                    'active' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'member_id' => 2,
                    'issued_date' => Carbon::today()->subMonth(2)->toDateString(),
                    'active' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]
        );
    }
}
