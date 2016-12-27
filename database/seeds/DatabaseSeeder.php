<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ScheduleItemSeeder::class);
        $this->call(MemberServicesSeeder::class);
        $this->call(MeasurementsSeeder::class);
    }
}
