<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c992a6a68752FakultetiIspitiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('fakulteti_ispiti')) {
            Schema::create('fakulteti_ispiti', function (Blueprint $table) {
                $table->integer('fakulteti_id')->unsigned()->nullable();
                $table->foreign('fakulteti_id', 'fk_p_282269_282395_ispiti_5c992a6a688ca')->references('id')->on('fakultetis')->onDelete('cascade');
                $table->integer('ispiti_id')->unsigned()->nullable();
                $table->foreign('ispiti_id', 'fk_p_282395_282269_fakult_5c992a6a68985')->references('id')->on('ispitis')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fakulteti_ispiti');
    }
}
