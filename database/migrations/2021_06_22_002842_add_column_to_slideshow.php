<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSlideshow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slideshow', function (Blueprint $table) {
            $table->string('mo_ta')->nullable()->after('duong_dan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slideshow', function (Blueprint $table) {
            $table->string('mo_ta')->nullable()->after('duong_dan');
        });
    }
}
