<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('status')->default(1);
            $table->longText('log')->nullable();
            $table->timestamps();
            
            //$table->integer('state_id')->unsigned();
            
            //$table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
        
        //$table->dropForeign(['state_id']);
        //$table->dropColumn('state_id');
    }
}
