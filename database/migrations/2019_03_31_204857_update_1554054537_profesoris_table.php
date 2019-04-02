<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1554054537ProfesorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesoris', function (Blueprint $table) {
            
if (!Schema::hasColumn('profesoris', 'slika')) {
                $table->string('slika')->nullable();
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
        Schema::table('profesoris', function (Blueprint $table) {
            $table->dropColumn('slika');
            
        });

    }
}
