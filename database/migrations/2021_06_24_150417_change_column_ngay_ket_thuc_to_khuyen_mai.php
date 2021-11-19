<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnNgayKetThucToKhuyenMai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('khuyen_mai', function (Blueprint $table) {
            $table->dateTime('ngay_ket_thuc')->nullable()->change();
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
            $table->dateTime('ngay_ket_thuc')->nullable()->change();
        });
    }
}
