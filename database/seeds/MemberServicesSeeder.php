<?php

use Illuminate\Database\Seeder;

class MemberServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member_service')->insert(
            [
                [
                    'service_id' => 1,
                    'member_id' => 1,
                ],
                [
                    'service_id' => 1,
                    'member_id' => 2,
                ],
                [
                    'service_id' => 2,
                    'member_id' => 2,
                ]
            ]
        );
    }
}
