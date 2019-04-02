<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c9bd848250f8RelationshipsToSkolarinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skolarinas', function(Blueprint $table) {
            if (!Schema::hasColumn('skolarinas', 'student_id')) {
                $table->integer('student_id')->unsigned()->nullable();
                $table->foreign('student_id', '283464_5c9bd845c8545')->references('id')->on('studentis')->onDelete('cascade');
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
        Schema::table('skolarinas', function(Blueprint $table) {
            
        });
    }
}
