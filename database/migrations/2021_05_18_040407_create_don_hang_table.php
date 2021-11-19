<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('don_hang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('khach_hang_id');
            $table->unsignedBigInteger('quan_ly_id')->nullable();
            $table->bigInteger('tong_tien');
            $table->bigInteger('tong_tien_giam');
            $table->bigInteger('tong_so_luong');
            $table->bigInteger('tong_thanh_toan');
            $table->string('dia_diem');
            $table->string('sdt');
            $table->string('ten_khach_hang');
            $table->unsignedBigInteger('trang_thai_id');
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
        Schema::dropIfExists('don_hang');
    }
}
