<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignNuocHoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nuoc_hoa', function (Blueprint $table) {
            $table->foreign('dung_tich_id')->references('id')->on('dung_tich');
            $table->foreign('gioi_tinh_id')->references('id')->on('gioi_tinh');
            $table->foreign('nong_do_id')->references('id')->on('nong_do');
            $table->foreign('khuyen_mai_id')->references('id')->on('khuyen_mai');
            $table->foreign('thuong_hieu_id')->references('id')->on('thuong_hieu');
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc_san_pham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nuoc_hoa', function (Blueprint $table) {
            $table->foreign('dung_tich_id')->references('id')->on('dung_tich');
            $table->foreign('gioi_tinh_id')->references('id')->on('gioi_tinh');
            $table->foreign('nong_do_id')->references('id')->on('nong_do');
            $table->foreign('khuyen_mai_id')->references('id')->on('khuyen_mai');
            $table->foreign('thuong_hieu_id')->references('id')->on('thuong_hieu');
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc');
        });
    }
}
