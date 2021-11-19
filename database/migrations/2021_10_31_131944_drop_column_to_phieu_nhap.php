<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToPhieuNhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieu_nhap', function (Blueprint $table) {
            $table->dropColumn('nuoc_hoa_id');
            $table->dropColumn('so_luong_nhap');
            $table->dropColumn('gia_tien_nuoc_hoa');
            $table->bigInteger('tong_so_luong')->after('quan_ly_id');
            $table->bigInteger('tong_tien')->after('tong_so_luong');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phieu_nhap', function (Blueprint $table) {
            $table->dropColumn('nuoc_hoa_id');
            $table->dropColumn('so_luong_nhap');
            $table->dropColumn('gia_tien_nuoc_hoa');
            $table->bigInteger('tong_so_luong')->after('quan_ly_id');
            $table->bigInteger('tong_tien')->after('tong_so_luong');
        });
    }
}
