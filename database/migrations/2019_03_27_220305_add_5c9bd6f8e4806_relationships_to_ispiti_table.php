<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c9bd6f8e4806RelationshipsToIspitiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ispitis', function(Blueprint $table) {
            if (!Schema::hasColumn('ispitis', 'profesor_id')) {
                $table->integer('profesor_id')->unsigned()->nullable();
                $table->foreign('profesor_id', '282395_5c992a66dbc63')->references('id')->on('profesoris')->onDelete('cascade');
                }
                if (!Schema::hasColumn('ispitis', 'predmet_id')) {
                $table->integer('predmet_id')->unsigned()->nullable();
                $table->foreign('predmet_id', '282395_5c992a6705996')->references('id')->on('predmetis')->onDelete('cascade');
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
        Schema::table('ispitis', function(Blueprint $table) {
            
        });
    }
}
