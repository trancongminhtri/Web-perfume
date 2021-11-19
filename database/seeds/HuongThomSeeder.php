<?php

use Illuminate\Database\Seeder;
use App\HuongThom;

class HuongThomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HuongThom::truncate(); // Dùng để xóa hoàn toàn dữ liệu từ một bảng đang tồn tại
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Hoa Cỏ - Floral']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Thơm Ngát - Aromatic']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Síp - Chypre']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Cam Chanh - Citrus']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Da Thuộc - Leather']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Phương Đông - Oriental']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Gỗ - Woody']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Hoa cỏ Phương đông - Oriental Floral']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Hoa cỏ Trái cây - Floral Fruity']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Gỗ Cay Nồng - Woody Spicy']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Gỗ Hoa cỏ Xạ hương - Woody Floral Musk']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Hoa cỏ Gỗ Xạ hương - Floral Woody Musk']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Gỗ thơm - Woody Aromatic']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Hoa cỏ Síp - Chypre Floral']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Cam chanh Thơm ngát - Citrus Aromatic']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Cay nồng Phương đông - Oriental Spicy']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Thơm biển - Aromatic Aquatic']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương thơm Dương xỉ - Aromatic Fougere']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương thơm trái cây - Aromatic Fruity']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương thơm cây cỏ tự nhiên - Aromatic Green']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương thơm cay nồng - Aromatic Spicy']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương trái cây SÍP - Chypre Fruity']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương cam chanh thực phẩm - Citrus Gourmand']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương hoa cỏ An Đê Hít - Floral Aldehyde']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương hoa cỏ biển - Floral Aquatic']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hoa cỏ Trái cây Thực phẩm - Floral Fruity ']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương hoa cỏ xanh tự nhiên - Floral Green']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương hoa cỏ Gỗ Xạ hương - Floral Woody Musk']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương Dương xỉ phương đông - Oriental Fougere']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương va-ni phương đông - Oriental Vanilla']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương gỗ biển - Woody Aquatic']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương gỗ SÍP - Woody Chypre']
        );
        HuongThom::create(
            ['ten_huong_thom' => 'Hương gỗ phương đông - Oriental Woody']
        );
    }
}
