<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignAnhBiaNuocHoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anh_bia_nuoc_hoa', function (Blueprint $table) {
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
        Schema::table('anh_bia_nuoc_hoa', function (Blueprint $table) {
            $table->foreign('nuoc_hoa_id')->references('id')->on('nuoc_hoa');
        });
    }
}
