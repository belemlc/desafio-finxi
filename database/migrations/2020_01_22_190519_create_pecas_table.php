<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pecas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anunciante_id');
            $table->unsignedBigInteger('contato_id');
            $table->unsignedBigInteger('endereco_id');
            $table->string('descricao');
            $table->enum('status', ['aberto', 'finalizado'])
                ->comment('status aberto ou status finalizado');
            //
            $table->foreign('anunciante_id')->references('id')->on('users');
            $table->foreign('contato_id')->references('id')->on('contatos');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
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
        Schema::dropIfExists('pecas');
    }
}
