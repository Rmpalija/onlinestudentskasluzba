<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1553516865ProfesorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('profesoris')) {
            Schema::create('profesoris', function (Blueprint $table) {
                $table->increments('id');
                $table->string('ime');
                $table->string('prezime');
                $table->integer('telefon')->nullable()->unsigned();
                $table->enum('status', array('redovan', 'gostujuci', 'vanredni'))->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('profesoris');
    }
}
