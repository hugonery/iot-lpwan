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
			$table->longText('note')->nullable();
            $table->tinyInteger('status')->default(1)->after('note');
            $table->longText('log')->nullable()->after('adminappaccess');
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
            $table->dropColumn(['note']);
			$table->dropColumn(['status']);
			$table->dropColumn(['log']);
        });
    }
}
