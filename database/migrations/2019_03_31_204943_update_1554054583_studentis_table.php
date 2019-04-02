<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1554054583StudentisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studentis', function (Blueprint $table) {
            
if (!Schema::hasColumn('studentis', 'slika')) {
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
        Schema::table('studentis', function (Blueprint $table) {
            $table->dropColumn('slika');
            
        });

    }
}
