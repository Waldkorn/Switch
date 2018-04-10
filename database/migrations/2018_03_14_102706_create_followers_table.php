<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
       {
           Schema::create('followers', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('follower_id')->unsigned();
           $table->integer('streamer_id')->unsigned();
           $table->timestamps();
           $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreign('streamer_id')->references('id')->on('users')->onDelete('cascade');
       });
       }
       /**
        * Reverse the migrations.
        *
        * @return void
        */
       public function down()
       {
           Schema::dropIfExists('followers');
       }

}
