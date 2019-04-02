<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c98c947c70cePredmetiProfesoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('predmeti_profesori')) {
            Schema::create('predmeti_profesori', function (Blueprint $table) {
                $table->integer('predmeti_id')->unsigned()->nullable();
                $table->foreign('predmeti_id', 'fk_p_282248_282268_profes_5c98c947c7259')->references('id')->on('predmetis')->onDelete('cascade');
                $table->integer('profesori_id')->unsigned()->nullable();
                $table->foreign('profesori_id', 'fk_p_282268_282248_predme_5c98c947c7336')->references('id')->on('profesoris')->onDelete('cascade');
                
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
        Schema::dropIfExists('predmeti_profesori');
    }
}
