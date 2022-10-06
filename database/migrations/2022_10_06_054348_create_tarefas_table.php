<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();

            $table->id('Identificador da tarefa');
            $table->string('Nome da tarefa',255);
            $table->float('Custo');
            $table->date('Data limite');
            $table->integer('Ordem de apresentacao')->unique();
            $table->timestamps();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
};
