<?php

use App\TrangThaiDonHang;
use Illuminate\Database\Seeder;

class TrangThaiDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrangThaiDonHang::truncate(); // Dùng để xóa hoàn toàn dữ liệu từ một bảng đang tồn tại
        TrangThaiDonHang::create(
            ['trang_thai' => 'Đang xử lý']
        );
        TrangThaiDonHang::create(
            ['trang_thai' => 'Đã xử lý']
        );
        TrangThaiDonHang::create(
            ['trang_thai' => 'Hoàn thành']
        );
        TrangThaiDonHang::create(
            ['trang_thai' => 'Hủy đơn']
        );
    }
}
