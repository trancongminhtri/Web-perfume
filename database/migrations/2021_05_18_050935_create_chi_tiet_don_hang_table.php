<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietDonHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_don_hang', function (Blueprint $table) {
            $table->string('don_hang_id', 255);
            $table->unsignedBigInteger('nuoc_hoa_id');
            $table->bigInteger('so_luong_san_pham');
            $table->bigInteger('gia_tien_goc');
            $table->bigInteger('gia_tien_km');
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
        Schema::dropIfExists('chi_tiet_don_hang');
    }
}
