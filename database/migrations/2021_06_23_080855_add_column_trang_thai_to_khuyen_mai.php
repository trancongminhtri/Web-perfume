<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTrangThaiToKhuyenMai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('khuyen_mai', function (Blueprint $table) {
            $table->boolean('trang_thai')->default(false)->after('gia_khuyen_mai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('khuyen_mai', function (Blueprint $table) {
            $table->boolean('trang_thai')->default(false)->after('gia_khuyen_mai');
        });
    }
}
