<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1554053043ProfesorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesoris', function (Blueprint $table) {
            if(Schema::hasColumn('profesoris', 'telefon')) {
                $table->dropColumn('telefon');
            }
            
        });
Schema::table('profesoris', function (Blueprint $table) {
            
if (!Schema::hasColumn('profesoris', 'zvanje')) {
                $table->string('zvanje');
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
            $table->dropColumn('zvanje');
            
        });
Schema::table('profesoris', function (Blueprint $table) {
                        $table->integer('telefon')->nullable()->unsigned();
                
        });

    }
}
