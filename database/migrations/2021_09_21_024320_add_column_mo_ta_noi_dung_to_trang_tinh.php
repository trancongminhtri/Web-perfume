<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMoTaNoiDungToTrangTinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trang_tinh', function (Blueprint $table) {
            $table->string('mo_ta_noi_dung')->after('tieu_de');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trang_tinh', function (Blueprint $table) {
            $table->string('mo_ta_noi_dung')->after('tieu_de');
        });
    }
}
