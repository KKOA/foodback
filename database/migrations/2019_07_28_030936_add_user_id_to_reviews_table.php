<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('reviews', function (Blueprint $table) {
        //     //
        // });

        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(1)->after('id');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(null)->change();
        });

        Schema::table('reviews', function (Blueprint $table) {
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
    public function down()
    {
        // Schema::table('reviews', function (Blueprint $table) {
        //     //
        // });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_user_id_foreign');
            $table->dropColumn('user_id');
        });

    }
}
