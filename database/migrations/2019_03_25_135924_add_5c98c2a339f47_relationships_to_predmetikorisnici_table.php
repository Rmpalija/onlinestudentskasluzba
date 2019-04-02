<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c98c2a339f47RelationshipsToPredmetiKorisniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('predmeti_korisnicis', function(Blueprint $table) {
            if (!Schema::hasColumn('predmeti_korisnicis', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '282252_5c98c29f7d89c')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('predmeti_korisnicis', 'role_id')) {
                $table->integer('role_id')->unsigned()->nullable();
                $table->foreign('role_id', '282252_5c98c29f9beb5')->references('id')->on('roles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('predmeti_korisnicis', 'predmet_id')) {
                $table->integer('predmet_id')->unsigned()->nullable();
                $table->foreign('predmet_id', '282252_5c98c29fbba3a')->references('id')->on('predmetis')->onDelete('cascade');
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
        Schema::table('predmeti_korisnicis', function(Blueprint $table) {
            
        });
    }
}
