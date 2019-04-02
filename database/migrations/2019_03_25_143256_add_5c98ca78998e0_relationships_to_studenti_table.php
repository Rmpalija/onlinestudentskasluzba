<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c98ca78998e0RelationshipsToStudentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studentis', function(Blueprint $table) {
            if (!Schema::hasColumn('studentis', 'fakultet_id')) {
                $table->integer('fakultet_id')->unsigned()->nullable();
                $table->foreign('fakultet_id', '282267_5c98ca7464e74')->references('id')->on('fakultetis')->onDelete('cascade');
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
        Schema::table('studentis', function(Blueprint $table) {
            
        });
    }
}
