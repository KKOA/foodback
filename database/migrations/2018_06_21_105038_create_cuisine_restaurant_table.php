<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Class CreateCuisineRestaurantTable
 */
class CreateCuisineRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() :void
    {
        Schema::create('cuisine_restaurant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cuisine_id')->unsigned();
            $table->bigInteger('restaurant_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('cuisine_restaurant', function (Blueprint $table) {
            $table->foreign('cuisine_id')
            ->references('id')
            ->on('cuisines')
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ;
        });

        Schema::table('cuisine_restaurant', function (Blueprint $table) {
            $table->foreign('restaurant_id')
            ->references('id')
            ->on('restaurants')
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() :void
    {
        Schema::table('cuisine_restaurant', function (Blueprint $table) {
            $table->dropForeign('cuisine_restaurant_cuisine_id_foreign');
            $table->dropForeign('cuisine_restaurant_restaurant_id_foreign');
        });
        Schema::dropIfExists('cuisine_restaurant');
    }
}
