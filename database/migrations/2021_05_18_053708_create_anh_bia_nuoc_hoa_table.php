<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnhBiaNuocHoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anh_bia_nuoc_hoa', function (Blueprint $table) {
            $table->id();
            $table->string('duong_dan');
            $table->string('ten');
            $table->unsignedBigInteger('nuoc_hoa_id');
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
        Schema::dropIfExists('anh_bia_nuoc_hoa');
    }
}
