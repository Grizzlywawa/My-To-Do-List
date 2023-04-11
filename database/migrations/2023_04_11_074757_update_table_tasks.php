<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Charge une table existante grâce au Schema
        Schema::table('tasks', function(Blueprint $table){
            //ajoute une colonne d'une clé étrangère appelée user_id ayant le droit d'être null. Il va chercher la colonne id dans la table users grâce au nommage de la colonne
            $table->foreignId('user_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('tasks', function(Blueprint $table){
            //supprime la référence d'abord, car SQL regarde si la colonne n'est pas référence avant de pouvoir supprime la colonne
            $table->dropForeign('user_id');
            //supprime la colonne user_id
            $table->dropColumn('user_id');
        });
    }
}
