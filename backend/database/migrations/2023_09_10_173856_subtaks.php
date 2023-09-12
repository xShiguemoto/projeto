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
        Schema::create('subtasks', function ($table){
            $table->id();
            $table->foreignId('id_tarefa')->constrained('tasks');
            $table->string('titulo');
            $table->longtext('descricao');
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
        Schema::dropIfExists("subtasks");
    }
};
