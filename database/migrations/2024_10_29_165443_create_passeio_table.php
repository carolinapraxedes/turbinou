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
        Schema::create('passeio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destino_id');
            $table->string('nome');
            $table->enum('horario',  ['morning', 'afternoon', 'night']);
            $table->string('imagem',100)->nullable();
            $table->string('descricao', 260)->nullable();
            
            $table->foreign('destino_id')->references('id')->on('destino');
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
        Schema::dropIfExists('passeio');
    }
};
