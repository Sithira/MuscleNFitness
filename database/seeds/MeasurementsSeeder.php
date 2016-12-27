<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeasurementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurements')->insert(
            [
                [
                    'member_id' => 1,
                    'weight' => 70,
                    'height' => 167,
                    'bmi' => 45,
                    'fat' => 26,
                    'chest' => 14,
                    'waist' => 45,
                    'hip' => 41,
                    'arm_left' => 10,
                    'arm_right' => 10,
                    'forearm_left' => 13,
                    'forearm_right' => 13,
                    'thigh_left' => 10,
                    'thigh_right' => 10,
                    'calf_left' => 13,
                    'calf_right' => 13,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'member_id' => 2,
                    'weight' => 70,
                    'height' => 167,
                    'bmi' => 45,
                    'fat' => 26,
                    'chest' => 14,
                    'waist' => 45,
                    'hip' => 41,
                    'arm_left' => 10,
                    'arm_right' => 10,
                    'forearm_left' => 13,
                    'forearm_right' => 13,
                    'thigh_left' => 10,
                    'thigh_right' => 10,
                    'calf_left' => 13,
                    'calf_right' => 13,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]
        );
    }
}
