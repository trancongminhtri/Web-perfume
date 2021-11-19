<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignDonHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->foreign('trang_thai_id')->references('id')->on('trang_thai_don_hang');
            $table->foreign('khach_hang_id')->references('id')->on('nguoi_dung');
            $table->foreign('quan_ly_id')->references('id')->on('nguoi_dung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->foreign('trang_thai_id')->references('id')->on('trang_thai_don_hang');
            $table->foreign('khach_hang_id')->references('id')->on('nguoi_dung');
            $table->foreign('quan_ly_id')->references('id')->on('nguoi_dung');
        });
    }
}
