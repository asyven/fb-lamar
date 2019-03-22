<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('keyword')->unsigned()->nullable();

            $table->string("fb_id");
            $table->string("name");
            $table->unsignedInteger("audience_size");
            $table->json("path");
            $table->string("description")->nullable();
            $table->string("topic")->nullable();

            $table->timestamps();
        });

        Schema::table('fb', function(Blueprint $table)
        {
            $table->foreign('keyword')->references('id')->on('fb_interests_keys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fb');
    }
}
