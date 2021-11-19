<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuongThomNuocHoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huong_thom_nuoc_hoa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('huong_thom_id');
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
        Schema::dropIfExists('huong_thom_nuoc_hoa');
    }
}
