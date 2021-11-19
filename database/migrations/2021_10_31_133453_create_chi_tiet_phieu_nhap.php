<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietPhieuNhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_phieu_nhap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phieu_nhap_id');
            $table->unsignedBigInteger('nuoc_hoa_id');
            $table->bigInteger('so_luong_nhap');
            $table->bigInteger('gia_tien_nuoc_hoa');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_phieu_nhap');
    }
}
