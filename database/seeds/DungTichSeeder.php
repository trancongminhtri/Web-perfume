<?php

use Illuminate\Database\Seeder;
use App\DungTich;

class DungTichSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DungTich::truncate(); // Dùng để xóa hoàn toàn dữ liệu từ một bảng đang tồn tại
        DungTich::create(
            ['ten_dung_tich' => '10ml']
        );
        DungTich::create(
            ['ten_dung_tich' => '50ml']
        );
        DungTich::create(
            ['ten_dung_tich' => '75ml']
        );
        DungTich::create(
            ['ten_dung_tich' => '100ml']
        );
        DungTich::create(
            ['ten_dung_tich' => '150ml']
        );
        DungTich::create(
            ['ten_dung_tich' => '200ml']
        );
    }
}
