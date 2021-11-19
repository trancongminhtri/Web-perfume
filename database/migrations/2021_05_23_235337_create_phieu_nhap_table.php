<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuNhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_nhap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nuoc_hoa_id');
            $table->unsignedBigInteger('ncc_id');
            $table->unsignedBigInteger('quan_ly_id');
            $table->bigInteger('so_luong_nhap');
            $table->bigInteger('gia_tien_nuoc_hoa');
            $table->date('ngay_nhap');
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
        Schema::dropIfExists('phieu_nhap');
    }
}
