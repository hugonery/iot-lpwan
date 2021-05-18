<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->tinyInteger('type')->default(0);
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->integer('postalcode')->default(0);
            $table->string('address', 180)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->longText('log')->nullable();
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('district_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }
       
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
