<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c98ca4fd47d9FakultetiProfesoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('fakulteti_profesori')) {
            Schema::create('fakulteti_profesori', function (Blueprint $table) {
                $table->integer('fakulteti_id')->unsigned()->nullable();
                $table->foreign('fakulteti_id', 'fk_p_282269_282268_profes_5c98ca4fd49ae')->references('id')->on('fakultetis')->onDelete('cascade');
                $table->integer('profesori_id')->unsigned()->nullable();
                $table->foreign('profesori_id', 'fk_p_282268_282269_fakult_5c98ca4fd4a97')->references('id')->on('profesoris')->onDelete('cascade');
                
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
        Schema::dropIfExists('fakulteti_profesori');
    }
}
