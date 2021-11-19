<?php

use Illuminate\Database\Seeder;
use App\GioiTinh;

class GioiTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GioiTinh::truncate(); // Dùng để xóa hoàn toàn dữ liệu từ một bảng đang tồn tại
        GioiTinh::create(
            ['ten_gioi_tinh' => 'Nam']
        );
        GioiTinh::create(
            ['ten_gioi_tinh' => 'Nữ']
        );
        GioiTinh::create(
            ['ten_gioi_tinh' => 'Unisex']
        );
    }
}
