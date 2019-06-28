<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Class AddCoverImageToRestaurantsTable
 */
class AddCoverImageToRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() :void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->after('postcode');
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
            $table->dropColumn(['cover_image']);
        });
    }
}
