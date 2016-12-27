<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert(
            [
                [
                    'type_id' => 1,
                    'name' => 'Sithira',
                    'last_name' => 'Munasinghe',
                    'nic' => 'NIC NIC',
                    'email' => 'sithiraac@gamil.com',
                    'address' => 'adress',
                    'phone' => '159753468',
                    'active' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'type_id' => 2,
                    'name' => 'Tharuka',
                    'last_name' => 'Perera',
                    'nic' => 'NIC NIC NIC',
                    'email' => 'tharuka@gamil.com',
                    'address' => 'adress',
                    'phone' => '159753468',
                    'active' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]
        );
    }
}
