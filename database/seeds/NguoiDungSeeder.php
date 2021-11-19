<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate(); // Dùng để xóa hoàn toàn dữ liệu từ một bảng đang tồn tại
        User::create([
            'ho_ten' => 'Trần Công Minh Trí',
            'email' => 'trancongminhtri@gmail.com',
            'chuc_vu' => 'admin',
            'password' => Hash::make('12345678'),
            'sdt' => '0798167955',
            'dia_chi' => 'số 9, đường Bạch Đằng, phường Phước Hiệp, Tỉnh Bà Rịa -Vũng Tàu',
            'kich_hoat' => '1'
        ]);
        User::create([
            'ho_ten' => 'Phạm Như Thuần',
            'email' => '0306181177@caothang.edu.vn',
            'chuc_vu' => 'user',
            'password' => Hash::make('12345678'),
            'sdt' => '0123456789',
            'dia_chi' => 'Đồng Tháp',
            'kich_hoat' => '1'
        ]);
    }
}
