<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDuongDanToTrangTinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trang_tinh', function (Blueprint $table) {
            $table->string('duong_dan')->after('id');
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
            $table->string('duong_dan')->after('id');
        });
    }
}
