<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1553716981IspitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ispitis', function (Blueprint $table) {
            
if (!Schema::hasColumn('ispitis', 'kalendarski_naziv')) {
                $table->string('kalendarski_naziv')->nullable();
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ispitis', function (Blueprint $table) {
            $table->dropColumn('kalendarski_naziv');
            
        });

    }
}
