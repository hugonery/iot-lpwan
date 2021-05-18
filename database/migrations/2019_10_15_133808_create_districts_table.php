<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('status')->default(1);
            $table->longText('log')->nullable();
            $table->timestamps();
            
            //$table->integer('city_id')->unsigned();
            
            //$table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
        
        //$table->dropForeign(['city_id']);
        //$table->dropColumn('city_id');
    }
}
