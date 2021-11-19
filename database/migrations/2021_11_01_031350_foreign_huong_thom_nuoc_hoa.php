<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignHuongThomNuocHoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('huong_thom_nuoc_hoa', function (Blueprint $table) {
            $table->foreign('huong_thom_id')->references('id')->on('huong_thom');
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('huong_thom_nuoc_hoa', function (Blueprint $table) {
            $table->foreign('huong_thom_id')->references('id')->on('huong_thom');
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
        });
    }
}
