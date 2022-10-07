<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();

            $table->id('identificador_da_tarefa');
            $table->string('nome_da_tarefa',255);
            $table->float('custo');
            $table->date('data_limite');
            $table->integer('ordem_de_apresentacao')->unique();
            $table->timestamps();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
};
