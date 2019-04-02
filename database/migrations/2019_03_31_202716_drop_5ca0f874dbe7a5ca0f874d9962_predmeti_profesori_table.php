<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5ca0f874dbe7a5ca0f874d9962PredmetiProfesoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('predmeti_profesori');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('predmeti_profesori')) {
            Schema::create('predmeti_profesori', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('predmeti_id')->unsigned()->nullable();
            $table->foreign('predmeti_id', 'fk_p_282248_282268_profes_5c98c947b405c')->references('id')->on('predmetis');
                $table->integer('profesori_id')->unsigned()->nullable();
            $table->foreign('profesori_id', 'fk_p_282268_282248_predme_5c98c947b5000')->references('id')->on('profesoris');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
