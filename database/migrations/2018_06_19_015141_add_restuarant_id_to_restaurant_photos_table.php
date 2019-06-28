<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddRestuarantIdToRestaurantPhotosTable
 */
class AddRestuarantIdToRestaurantPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() :void
    {
        Schema::table('restaurant_photos', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned()->default(1)->after('id');
        });

        Schema::table('restaurant_photos', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned()->default(null)->change();
        });

        Schema::table('restaurant_photos', function (Blueprint $table) {
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
        Schema::table('restaurant_photos', function (Blueprint $table) {
            $table->dropForeign('restaurant_photos_restaurant_id_foreign');
            $table->dropColumn(['restaurant_id']);
        });
    }
}
