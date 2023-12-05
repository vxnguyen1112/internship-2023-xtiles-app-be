<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'id' => '5b2c0654-de5e-3153-ac1f-751cac718e4e',
                'name' => 'Page01',
                'document_id' => 'c9edd02c-c9f3-41de-b9d9-22a146bf8550',
                'created_at' => '2023-02-27 08:26:36',
                'updated_at' => '2023-02-27 08:26:36'
            ],
            [
                'id' => '8a5f03ff-1875-4bf3-a3f4-aef1264e3bcc',
                'name' => 'Page02',
                'document_id' => 'd6d98b88-c866-4496-9bd4-de7ba48d0f52',
                'created_at' => '2023-02-27 08:26:36',
                'updated_at' => '2023-02-27 08:26:36'
            ],
            [
                'id' => 'bf91c434-dcf3-3a4c-b49a-12e0944ef1e2',
                'name' => 'Page03',
                'document_id' => '29fa7bf9-0728-4272-a7bc-5b7c964f332d',
                'created_at' => '2023-02-27 08:26:36',
                'updated_at' => '2023-02-27 08:26:36'
            ],
        ]);
    }
}
