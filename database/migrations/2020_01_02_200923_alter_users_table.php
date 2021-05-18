<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->date('birth', 100)->nullable()->after('name');
          $table->tinyInteger('type')->default(0)->after('birth');
          $table->bigInteger('cpf')->default(0)->after('type');
          $table->bigInteger('phone1')->default(0)->after('password');
          $table->bigInteger('phone2')->default(0)->after('phone1');
          $table->string('person1', 50)->nullable()->after('phone2');
          $table->bigInteger('personphone1')->default(0)->after('person1');
          $table->string('person2', 50)->nullable()->after('personphone1');
          $table->bigInteger('personphone2')->default(0)->after('person2');
          $table->integer('postalcode')->default(0)->after('personphone2');
          $table->string('address', 180)->nullable()->after('postalcode');
          $table->tinyInteger('webaccess');
          
          $table->integer('state_id')->unsigned();
          $table->integer('city_id')->unsigned();
          $table->integer('district_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn(['birth']);
          $table->dropColumn(['type']);
          $table->dropColumn(['cpf']);
          $table->dropColumn(['phone1']);
          $table->dropColumn(['phone2']);
          $table->dropColumn(['person1']);
          $table->dropColumn(['personphone1']);
          $table->dropColumn(['person2']);
          $table->dropColumn(['personphone2']);
          $table->dropColumn(['postalcode']);
          $table->dropColumn(['address']);
          $table->dropColumn(['webaccess']);

          $table->dropColumn('state_id');
          $table->dropColumn('city_id');
          $table->dropColumn('district_id');
        });
    }
}
