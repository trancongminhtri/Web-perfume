<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanXetVaDanhGia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhan_xet_va_danh_gia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nuoc_hoa_id');
            $table->unsignedBigInteger('nguoi_dung_id');
            $table->bigInteger('diem_danh_gia')->nullable();
            $table->longText('noi_dung_danh_gia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhan_xet_va_danh_gia');
    }
}
