<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('address1')->default('aaa')->after('description');
            $table->string('address2')->default('aaa')->after('address1');
            $table->string('city')->default('aaa')->after('address2');
            $table->string('county')->default('aaa')->after('city');
            $table->string('postcode')->default('aaa')->after('county');
        });
        
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('address1')->default(null)->change();
            $table->string('address2')->default(null)->nullable()->change();
            $table->string('city')->default(null)->change();
            $table->string('county')->default(null)->nullable()->change();
            $table->string('postcode')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['address1','address2','city','county','postcode']);
        });
    }
}
