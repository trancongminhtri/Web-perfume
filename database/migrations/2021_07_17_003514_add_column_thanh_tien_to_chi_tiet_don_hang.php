<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnThanhTienToChiTietDonHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chi_tiet_don_hang', function (Blueprint $table) {
            $table->bigInteger('thanh_toan')->after('gia_tien_km');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chi_tiet_don_hang', function (Blueprint $table) {
            $table->bigInteger('thanh_toan')->after('gia_tien_km');
        });
    }
}
