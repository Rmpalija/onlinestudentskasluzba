<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1553516521StudentisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studentis', function (Blueprint $table) {
            if(Schema::hasColumn('studentis', 'status')) {
                $table->dropColumn('status');
            }
            
        });
Schema::table('studentis', function (Blueprint $table) {
            
if (!Schema::hasColumn('studentis', 'status')) {
                $table->enum('status', array('redovan.vanredan'))->nullable();
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
            $table->dropColumn('status');
            
        });
Schema::table('studentis', function (Blueprint $table) {
                        $table->enum('status', array('redovan'))->nullable();
                
        });

    }
}
