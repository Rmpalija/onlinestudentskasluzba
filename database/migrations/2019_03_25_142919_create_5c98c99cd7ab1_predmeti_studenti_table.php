<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c98c99cd7ab1PredmetiStudentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('predmeti_studenti')) {
            Schema::create('predmeti_studenti', function (Blueprint $table) {
                $table->integer('predmeti_id')->unsigned()->nullable();
                $table->foreign('predmeti_id', 'fk_p_282248_282267_studen_5c98c99cd7c34')->references('id')->on('predmetis')->onDelete('cascade');
                $table->integer('studenti_id')->unsigned()->nullable();
                $table->foreign('studenti_id', 'fk_p_282267_282248_predme_5c98c99cd7d20')->references('id')->on('studentis')->onDelete('cascade');
                
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
        Schema::dropIfExists('predmeti_studenti');
    }
}
