<?php

use App\Enums\DataMapping\BaseLegalEnum;
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
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->string('cod', 255)->default('dmp')->unique();
            $table->string('nome_processo', 255);
            $table->string('descricao', 255);
            $table->string('responsavel_processo', 255);
            $table->string('forma_de_coleta_dos_dados', 255);
            $table->string('id_coleta_ativos_ou_terceiros', 255);
            $table->string('tipo_de_armazenamento', 255);
            $table->string('id_de_armazenamento_ativo', 255);
            $table->string('nome_sistema_de_armazenamento', 255);
            $table->string('matriz_ou_filial_da_empresa', 255);
            $table->string('cod_terceiro', 50)->nullable();
            $table->string('nome_terceiro', 255)->nullable();
            $table->string('localizacao_armazenamento_fisica_pais_estado', 255);
            $table->text('dados_pessoais_coletados')->nullable();
            $table->text('tipo_dado_especial')->nullable();
            $table->string('volume_de_dados_pessoais', 255);
            $table->text('tratamento_realizado')->nullable();
            $table->text('departamento_com_acesso_dados')->nullable();
            $table->string('departamento', 255);
            $table->string('finalidade', 255);
            $table->string('titular_de_dados', 255);
            $table->integer('prazo_de_retencao_numero');
            $table->string('prazo_de_retencao_tipo', 15); //dia(s),mes(es), ano(s)
            $table->string('base_legal', 255);
            $table->string('base_legal_obs', 255)->nullable();
            $table->string('responsavel_interno', 255);
            $table->string('responsavel_interno_telefone', 255);
            $table->string('responsavel_interno_email', 255);
            $table->string('origem_dos_dados_pessoais', 255);
            $table->string('compartilhamento_externo_de_dados', 10);
            $table->string('quem_esta_compartilhando_dados', 255)->nullable();
            $table->string('tipo_do_dado_compartilhado', 255)->nullable();
            $table->string('agente_de_tratamento', 255)->nullable();
            $table->string('log_de_transacao', 50)->nullable();
            $table->string('localizacao_log_de_transacao', 255)->nullable();
            $table->integer('created_by', false, true);
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
        Schema::dropIfExists('processos');
    }
};


//Oi Bruna, boa tarde!
//me enviaram um e-mail da pós à 599 + matricula
//a empresa em que eu trabalho 