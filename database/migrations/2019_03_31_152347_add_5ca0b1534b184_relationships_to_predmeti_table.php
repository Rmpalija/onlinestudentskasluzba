<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ca0b1534b184RelationshipsToPredmetiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('predmetis', function(Blueprint $table) {
            if (!Schema::hasColumn('predmetis', 'profesor_id')) {
                $table->integer('profesor_id')->unsigned()->nullable();
                $table->foreign('profesor_id', '282248_5c98c11b6b7ba')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('predmetis', function(Blueprint $table) {
            
        });
    }
}
