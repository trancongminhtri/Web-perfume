<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignPhieuNhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieu_nhap', function (Blueprint $table) {
            $table->foreign('ncc_id')->references('id')->on('nha_cung_cap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phieu_nhap', function (Blueprint $table) {
            $table->foreign('ncc_id')->references('id')->on('nha_cung_cap');
        });
    }
}
