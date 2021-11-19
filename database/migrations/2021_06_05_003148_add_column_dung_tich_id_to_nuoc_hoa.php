<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDungTichIdToNuocHoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nuoc_hoa', function (Blueprint $table) {
            $table->unsignedBigInteger('dung_tich_id')->after('so_luong_ton');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nuoc_hoa', function (Blueprint $table) {
            $table->unsignedBigInteger('dung_tich_id')->after('so_luong_ton');
        });
    }
}
