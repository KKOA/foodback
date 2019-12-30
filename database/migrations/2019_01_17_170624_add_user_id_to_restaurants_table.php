<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Class AddUserIdToRestaurantsTable
 */
class AddUserIdToRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() :void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->default(1)->after('id');
        });
        Schema::table('restaurants', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->default(null)->change();
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign('restaurants_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
