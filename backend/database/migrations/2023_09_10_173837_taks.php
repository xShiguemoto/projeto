<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function ($table){
            $table->id();
            $table->string('id_usuario');
            $table->string('token_tarefa', 8);
            $table->string('titulo');
            $table->longtext('descricao');
            $table->datetime('data_vencimento');
            $table->enum('status', ['Pendente', 'Completa'])->default('Pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tasks");
    }
};
