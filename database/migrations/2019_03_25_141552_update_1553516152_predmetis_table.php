<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1553516152PredmetisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('predmetis', function (Blueprint $table) {
            if(Schema::hasColumn('predmetis', 'uloga_id')) {
                $table->dropForeign('282248_5c98c647ed524');
                $table->dropIndex('282248_5c98c647ed524');
                $table->dropColumn('uloga_id');
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
        Schema::table('predmetis', function (Blueprint $table) {
                        
        });

    }
}
