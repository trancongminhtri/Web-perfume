<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignChiTietPhieuNhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chi_tiet_phieu_nhap', function (Blueprint $table) {
            $table->foreign('phieu_nhap_id')->references('id')->on('phieu_nhap');
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
        Schema::table('chi_tiet_phieu_nhap', function (Blueprint $table) {
            $table->foreign('phieu_nhap_id')->references('id')->on('phieu_nhap');
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
        });
    }
}
