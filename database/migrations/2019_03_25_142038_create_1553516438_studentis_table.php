<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1553516438StudentisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('studentis')) {
            Schema::create('studentis', function (Blueprint $table) {
                $table->increments('id');
                $table->string('ime');
                $table->string('prezime');
                $table->string('jmb');
                $table->string('index');
                $table->enum('status', array('redovan'))->nullable();
                
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
        Schema::dropIfExists('studentis');
    }
}
