<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('terceiros', function (Blueprint $table) {
            $table->id();
            $table->string('cod')->default('dmt-');
            $table->string('nome_terceiro');
            //$table->string('descricao');
            //$table->string('localizacao_fisica_pais_estado');
            //$table->string('responsavel_interno_ativo');
            //$table->string('tipo_servico_prestado');
            //$table->string('status');
            //$table->string('importancia');
            $table->string('site_terceiro');
            $table->string('cnpj_terceiro');
            $table->string('nome_do_representante');
            $table->string('email_do_representante');
            $table->string('telefone_do_representante');
            // $table->string('responsavel_interno_terceiro');
            $table->foreignId('empresa_id')->constrained("empresas")->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terceiros');
    }
};
