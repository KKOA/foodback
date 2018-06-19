<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRestuarantIdToRestaurantPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurant_photos', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned()->default(1)->after('id');
        });
        Schema::table('restaurant_photos', function (Blueprint $table) {
            $table->integer('restaurant_id')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurant_photos', function (Blueprint $table) {
            $table->dropColumn(['restaurant_id']);
        });
    }
}
