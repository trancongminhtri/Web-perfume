<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignNhanXetVaDanhGia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nhan_xet_va_danh_gia', function (Blueprint $table) {
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
            $table->foreign('nguoi_dung_id')->references('id')->on('nguoi_dung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nhan_xet_va_danh_gia', function (Blueprint $table) {
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
            $table->foreign('nguoi_dung_id')->references('id')->on('nguoi_dung');
        });
    }
}
