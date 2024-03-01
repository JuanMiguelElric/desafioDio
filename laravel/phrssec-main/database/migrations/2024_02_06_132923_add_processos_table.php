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
        Schema::table('processos', function (Blueprint $table) {
            $table->string('volume_estimado_de_titular_alcancados');//check
            $table->string('trafego_de_rede'); //check
            $table->string('categoria_do_titular'); //check
            $table->string('categoria_do_titular_obs')->nullable(); //check
            $table->tinyInteger('tratamento_mediante_decisao_automatizada');//check
            $table->string('decisao_automatizada_obs')->nullable();//check
            $table->tinyInteger('realizado_avaliacao_dos_titulares');//check
            $table->string('realizado_avaliacao_dos_titulares_obs')->nullable();//check
            $table->integer('frequencia_do_tratamento_numero');//check
            $table->string('frequencia_do_tratamento_tipo');//check
            $table->tinyInteger('exclusao_dos_dados');//check
            $table->string('como_realiza_a_exclusao')->nullable();//check
            $table->string('justificativa_da_nao_exclusao')->nullable();//check
            $table->tinyInteger('dados_sao_enviados_fora_brasil')->nullable();//check
            $table->string('obs_da_transferencia')->nullable();//check
            $table->string('meios_utilizados_para_coletar_dados');//check
            //mudança na tabela anterior labelClass="text-red"
            $table->integer('prazo_de_retencao_numero')->nullable()->change();
            $table->string('prazo_de_retencao_tipo', 15)->nullable()->change();
            $table->string('qual_pais_e_realizada_transferencia')->nullable();
            $table->string('finalidade_do_compartilhamento')->nullable();
            $table->integer('tipo_de_garantia_para_transferencia')->nullable();
            $table->tinyInteger('gerado_algum_documento');
            $table->string('quais_documentos')->nullable();
            $table->string('quais_extensoes')->nullable();
            $table->string('abrangencia_da_area_geografica_do_tratamento_de_dados_pessoais');
            $table->string('qual_a_previsao_legal_que_respalda_essa_finalidade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('processos', function (Blueprint $table) {
            $table->dropColumn([
                'volume_estimado_de_titular_alcancados',
                'trafego_de_rede',
                'categoria_do_titular',
                'categoria_do_titular_obs',
                'tratamento_mediante_decisao_automatizada',
                'decisao_automatizada_obs',
                'realizado_avaliacao_dos_titulares',
                'realizado_avaliacao_dos_titulares_obs',
                'frequencia_do_tratamento_numero',
                'frequencia_do_tratamento_tipo',
                'exclusao_dos_dados',
                'como_realiza_a_exclusao',
                'justificativa_da_nao_exclusao',
                'dados_sao_enviados_fora_brasil',
                'obs_da_transferencia',
                'meios_utilizados_para_coletar_dados',
                'qual_pais_e_realizada_transferencia',
                'finalidade_do_compartilhamento',
                'tipo_de_garantia_para_transferencia',
                'gerado_algum_documento',
                'quais_documentos',
                'quais_extensoes',
                'abrangencia_da_area_geografica_do_tratamento_de_dados_pessoais',
                'qual_a_previsao_legal_que_respalda_essa_finalidade',
            ]);
            $table->integer('prazo_de_retencao_numero')->nullable(false)->change();
            $table->string('prazo_de_retencao_tipo', 15)->nullable(false)->change();
        });
    }
};
