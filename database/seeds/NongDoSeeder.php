<?php

use Illuminate\Database\Seeder;
use App\NongDo;

class NongDoSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NongDo::truncate(); // Dùng để xóa hoàn toàn dữ liệu từ một bảng đang tồn tại
        NongDo::create(
            ['ten_nong_do' => 'Perfume extract']
        );
        NongDo::create(
            ['ten_nong_do' => 'Eau de Parfum']
        );
        NongDo::create(
            ['ten_nong_do' => 'Eau de Toilette']
        );
        NongDo::create(
            ['ten_nong_do' => 'Eau de Cologne']
        );
        NongDo::create(
            ['ten_nong_do' => 'Eau Fraiche']
        );
    }
}
