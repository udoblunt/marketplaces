<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('description');
            $table->string('banner_filename');
            $table->string('logo_filename');
            $table->integer('upvote');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('market_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('market_id')->unsigned()->index();
            $table->foreign('market_id')->references('id')->on('markets')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('market_user');
        Schema::drop('markets');
    }
}
