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
        Schema::create('ativos', function (Blueprint $table) {
            $table->id();
            $table->string("cod")->default('dma-');
            $table->string("ativos_sis_doc");
            $table->string("descricao");
            $table->string("tipo_ativo");
            $table->string("link_ip");
            $table->string("formato_ativo");
            $table->string("responsavel_ativo");
            $table->string("cod_do_terceiro")->nullable();
            $table->string("nome_do_terceiro")->nullable();
            $table->string("tipo_de_armazenamento");
            $table->string("formato_de_armazenamento");
            $table->string("nome_do_sistema_de_armazenamento");
            $table->string("matriz_ou_filial_da_empresa");
            $table->string("departamento");
            $table->string("localizacao_fisica_pais_estado");
            $table->text("dados_pessoais_coletados")->nullable();
            $table->text("tipo_dado_especial")->nullable();
            $table->string("volume_de_dados_pessoais");
            $table->string("trafego_de_rede");
            $table->string("autenticacao");
            $table->string("criptografia_do_armazenamento");
            $table->string("finalidade");
            $table->string("forma_de_coleta");
            $table->string("categoria_de_dados");
            $table->string("titular_de_dados");
            $table->string("categoria_do_titular");
            $table->string("categoria_do_titular_outros")->nullable();
            $table->string("prazo_de_retencao_numero");
            $table->string("prazo_de_retencao_tipo");
            $table->string("base_legal");
            $table->string("base_legal_obs")->nullable();
            $table->string("responsavel_interno");
            $table->string("agente_de_tratamento");
            $table->string("log_de_transacao");
            $table->string("localizacao_log_de_transacao")->nullable();
            $table->text("tratamento_realizado")->nullable();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativos');
    }
};
