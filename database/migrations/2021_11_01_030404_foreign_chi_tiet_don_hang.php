<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignChiTietDonHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chi_tiet_don_hang', function (Blueprint $table) {
            $table->foreign('don_hang_id')->references('id')->on('don_hang');
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
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
            $table->foreign('don_hang_id')->references('id')->on('don_hang');
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
        });
    }
}
