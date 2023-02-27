<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            [
                'id' => '06397596-d0d5-33e4-a86e-4675376a5fa8',
                'name' => 'Tran Nguyen Diem Hoang',
                'email' => 'hoang@gmail.com',
                'avatar_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'password' => bcrypt('123456'),
                'created_at' => '2023-02-23 08:26:36',
                'updated_at' => '2023-02-23 08:26:36'
            ],
            [
                'id' => '11a323e2-78ef-36ab-8adc-27f3ed1b8c0b',
                'name' => 'Phung Ngoc Tuan',
                'email' => 'tuan@gmail.com',
                'avatar_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'password' => bcrypt('123456'),
                'created_at' => '2023-02-23 08:26:36',
                'updated_at' => '2023-02-23 08:26:36'
            ],
            [
                'id' => '8ddbd705-96ac-3f95-ac6a-3492eda100c7',
                'name' => 'Vu Xuan Nguyen',
                'email' => 'nguyen@gmail.com',
                'avatar_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'password' => bcrypt('123456'),
                'created_at' => '2023-02-23 08:26:36',
                'updated_at' => '2023-02-23 08:26:36'
            ],
            [
                'id' => 'cb533f13-d01a-3da9-8487-d6c8ade7b0d1',
                'name' => 'Thai Van Chuong',
                'email' => 'chuong@gmail.com',
                'avatar_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'password' => bcrypt('123456'),
                'created_at' => '2023-02-23 08:26:36',
                'updated_at' => '2023-02-23 08:26:36'
            ]
        ]);
    }
}
