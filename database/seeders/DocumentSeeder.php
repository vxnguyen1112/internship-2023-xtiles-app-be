<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            [
                'id' => '29fa7bf9-0728-4272-a7bc-5b7c964f332d',
                'name' => 'Document01',
                'img_cover_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'img_panel_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'is_deleted' => true,
                'account_id' => '8ddbd705-96ac-3f95-ac6a-3492eda100c7',
                'created_at' => '2023-02-27 08:26:36',
                'updated_at' => '2023-02-27 08:26:36'
            ],
            [
                'id' => 'c9edd02c-c9f3-41de-b9d9-22a146bf8550',
                'name' => 'Document02',
                'img_cover_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'img_panel_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'is_deleted' => true,
                'account_id' => 'cb533f13-d01a-3da9-8487-d6c8ade7b0d1',
                'created_at' => '2023-02-27 08:26:36',
                'updated_at' => '2023-02-27 08:26:36'
            ],
            [
                'id' => 'd6d98b88-c866-4496-9bd4-de7ba48d0f52',
                'name' => 'Document03',
                'img_cover_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'img_panel_url' => 'https://via.placeholder.com/640x480.png/0011ff?text=non',
                'is_deleted' => true,
                'account_id' => '06397596-d0d5-33e4-a86e-4675376a5fa8',
                'created_at' => '2023-02-27 08:26:36',
                'updated_at' => '2023-02-27 08:26:36'
            ],
        ]);
    }
}
