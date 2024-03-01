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
        Schema::create('lias', function (Blueprint $table) {
            $table->id();
            $table->string('lia_descricao_finalidade');
            $table->string('lia_dados_pessoais_tratados');
            $table->string('lia_finalidade_letima');
            $table->string('lia_situacao_concreta');
            $table->string('lia_minimizacao');
            $table->string('lia_outras_bases_legais');
            $table->string('lia_legitima_expectativa');
            $table->string('lia_direitos_e_liberdades_fundamentais');
            $table->string('lia_transparencia');
            $table->string('lia_mecanismos_de_oposicao');
            $table->string('lia_mitigacao_de_riscos');
            $table->tinyInteger('lia_aprovado')->nullable();
            $table->string('lia_nome_do_dpo');
            $table->timestamp('lia_data_da_avaliacao');
            $table->integer('liaable_id');
            $table->string('liaable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lias');
    }
};
