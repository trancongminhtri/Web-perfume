<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuocHoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuoc_hoa', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nuoc_hoa');
            $table->date('nam_phat_hanh')->nullable();
            $table->string('nha_pha_che')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->bigInteger('gia_tien');
            $table->longText('bai_viet')->nullable();
            $table->bigInteger('so_luong_ton');
            $table->unsignedBigInteger('gioi_tinh_id');
            $table->unsignedBigInteger('nong_do_id');
            $table->unsignedBigInteger('khuyen_mai_id')->nullable();
            $table->unsignedBigInteger('thuong_hieu_id');
            $table->unsignedBigInteger('danh_muc_id')->nullable();
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
        Schema::dropIfExists('nuoc_hoa');
    }
}
