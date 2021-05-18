<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);           
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->float('alt', 10, 6);
            $table->tinyInteger('status')->default(1);
            $table->longText('log')->nullable(); 
            $table->timestamps();
            $table->integer('place_id')->unsigned();

            $table->foreign('place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
