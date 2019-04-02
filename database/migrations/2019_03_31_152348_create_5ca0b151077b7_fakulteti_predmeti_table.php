<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ca0b151077b7FakultetiPredmetiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('fakulteti_predmeti')) {
            Schema::create('fakulteti_predmeti', function (Blueprint $table) {
                $table->integer('fakulteti_id')->unsigned()->nullable();
                $table->foreign('fakulteti_id', 'fk_p_282269_282248_predme_5ca0b151078e4')->references('id')->on('fakultetis')->onDelete('cascade');
                $table->integer('predmeti_id')->unsigned()->nullable();
                $table->foreign('predmeti_id', 'fk_p_282248_282269_fakult_5ca0b151079ed')->references('id')->on('predmetis')->onDelete('cascade');
                
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
        Schema::dropIfExists('fakulteti_predmeti');
    }
}
