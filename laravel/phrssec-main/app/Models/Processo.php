<?php

namespace App\Models;

use App\Enums\DataMapping\BaseLegalEnum;
use App\Enums\DataMapping\TipoArmazenamentoEnum;
use App\Enums\DataMapping\VolumeDeDadosPessoaisEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "cod", //dmp-id Número de identificação do processo analisado			
        "nome_processo", //Nome do processo analisado			
        "descricao", //Descrição do processo analisado para auxiliar a sua identificação			
        "responsavel_processo", //Indicação se o responsável pelo processo analisado está dentro da empresa ou se é um terceiro contratado para esta finalidade			
        "cod_terceiro", // Caso o armazenamento seja realizado em terceiro, indicação do ID constante no data mapping de terceiros			
        "nome_terceiro", // Caso o armazenamento seja realizado em terceiro, indicação do nome do terceiro contratado			
        "forma_de_coleta_dos_dados", //Indicação sobre a forma como os dados são coletados em relação ao processo analisado			
        "id_coleta_ativos_ou_terceiros", //
        "tipo_de_armazenamento", //Indicação sobre o tipo de armazenamento do ativo analisado	 Pode ser: a) Físico, b) Digital, c) Físico e Digital.											
        "id_de_armazenamento_ativo", //
        "nome_sistema_de_armazenamento", // Indicação do nome do sistema utilizado para armazenamento durante o processo			
        "matriz_ou_filial_da_empresa", // Caso o armazenamensto seja interno, indicação se este armazenamento é feito na matriz ou filial da empresa			
        "localizacao_armazenamento_fisica_pais_estado", //Caso o armazenamento seja realizado em terceiro, indicação da localização física do armazenamento			
        "dados_pessoais_coletados", // Indicação de quais dados pessoais são coletados			
        "tipo_dado_especial", //indica se é criança, adolescente ou Idoso

        //ADD Volume estimado de titulares alcançados: Colocar este campo no Data Mapping, por primeiro e em seguida o Volume de Dados Tratados. 
        "volume_de_dados_pessoais", //Indicação da quantidade aproximada de dados pessoais tratados no processo analisado			// Mudar para o nome de “Volume de dados tratados”. – Colocar disclamer no DataMapping: Representa a quantidade total de informações que a organização manipula, independentemente do número de titulares.

        "tratamento_realizado", //Indicação de qual(ais) tratamento(s) são realizado(s)			
        //ADD Tráfego de Rede(Segurança Criptgrafica) IGUAL ATIVOS 
        "departamento_com_acesso_dados",
        "departamento", //Indicação de qual(ais) departamento(s) podem acessar os dados pessoais coletados		
        "finalidade", //Indicação sobre a finalidade da coleta e tratamento dos dados pessoais em relação ao processo analisado			
        "titular_de_dados", //Pessoa natural a quem se referem os dados pessoais que são objeto de tratamento			
        //ADD Categoria do Titular IGUAL ATIVOS
        //ADD É desempenhada alguma operação de tratamento mediante a tomada de decisões automatizadas? (Decisões automatizadas são aquelas tomadas apenas por máquinas ou inteligências artificiais)
        //ADD É realizado processamento que envolva a avaliação dos titulares, a exemplo de profiling, definição de perfil ou comportamento?
        //ADD Frequência do tratamento IGUAL AO PRAZO DE RETENÇÃO
        //checkbox não é realizado exclusão. SE SIM - Como é realizado a exclusão dos dados?
        "prazo_de_retencao_numero", //Indicação do prazo de manutenção dos dados em relação ao processo analisado	
        "prazo_de_retencao_tipo", //Indicação do prazo de manutenção dos dados em relação ao processo analisado			
        //SE NÃO Justificativa para conservação dos dados após o término do tratamento (art. 16 da LGPD) – No DM colocar Observação		
        "base_legal",
        "base_legal_obs",
        "responsavel_interno",
        "responsavel_interno_telefone",
        "responsavel_interno_email",
        "compartilhamento_externo_de_dados",
        "quem_esta_compartilhando_dados", //ALTERAR PARA COM QUEM ESTA COMPARTILHANDO OS DADOS // 
        "tipo_do_dado_compartilhado",
        //SE compartilhamento_externo_de_dados for sim ADD: Os dados são enviados para fora do Brasil?(sim, não)
        //SIM ADD: Como se dá a transferência?, É aplicada alguma proteção aos dados transferidos para fora do Brasil?.
        "origem_dos_dados_pessoais",
        //add new  Informe os meios utilizados para coletar os dados?, Informe o terceiro responsável por ceder os dados à empresa
        "created_by",
        'agente_de_tratamento',
        'log_de_transacao',
        'localizacao_log_de_transacao',

        //adicionado
        "volume_estimado_de_titular_alcancados",
        "trafego_de_rede",
        "categoria_do_titular",
        "categoria_do_titular_obs",
        "tratamento_mediante_decisao_automatizada",
        "decisao_automatizada_obs",
        "realizado_avaliacao_dos_titulares",
        "realizado_avaliacao_dos_titulares_obs",
        "frequencia_do_tratamento_numero",
        "frequencia_do_tratamento_tipo",
        "exclusao_dos_dados",
        "como_realiza_a_exclusao",
        "justificativa_da_nao_exclusao",
        "dados_sao_enviados_fora_brasil",
        "obs_da_transferencia",
        "meios_utilizados_para_coletar_dados",
        "qual_pais_e_realizada_transferencia",
        "finalidade_do_compartilhamento",
        "tipo_de_garantia_para_transferencia",
        "gerado_algum_documento",
        "quais_documentos",
        "quais_extensoes",
        "abrangencia_da_area_geografica_do_tratamento_de_dados_pessoais",
        "qual_a_previsao_legal_que_respalda_essa_finalidade",
    ];

    protected $casts = [
        'tipo_de_armazenamento'    => TipoArmazenamentoEnum::class,
        'base_legal'               => BaseLegalEnum::class,
        'volume_de_dados_pessoais' => VolumeDeDadosPessoaisEnum::class,
        'dados_sao_enviados_fora_brasil' => "boolean",
        'realizado_avaliacao_dos_titulares' => "boolean"
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function lias(): MorphMany
    {
        return $this->morphMany(Lia::class, 'liaable');
    }

    protected static function booted(): void
    {
        static::created(function (Processo $processo) {
            $processo->fill(['cod' => "dmp-" . $processo->id]);
            $processo->save();
        });
    }

    public function tipoDeGarantiaParaTransferencia()
    {
        $mapeamentoTransferencia = [
            0 => 'I - para países ou organismos internacionais que proporcionem grau de proteção de dados pessoais adequado ao previsto na LGPD',
            1 => 'II - quando o controlador oferecer e comprovar garantias de cumprimento dos princípios, dos direitos do titular e do regime de proteção de dados previstos na LGPD, na forma de: a) cláusulas contratuais específicas para determinada transferência; b) cláusulas-padrão contratuais; c) normas corporativas globais; d) selos, certificados e códigos de conduta regularmente emitidos;',
            2 => 'III - quando a transferência for necessária para a cooperação jurídica internacional entre órgãos públicos de inteligência, de investigação e de persecução, de acordo com os instrumentos de direito internacional;',
            3 => 'IV - quando a transferência for necessária para a proteção da vida ou da incolumidade física do titular ou de terceiro;',
            4 => 'V - quando a autoridade nacional autorizar a transferência;',
            5 => 'VI - quando a transferência resultar em compromisso assumido em acordo de cooperação internacional;',
            6 => 'VII - quando a transferência for necessária para a execução de política pública ou atribuição legal do serviço público, sendo dada publicidade nos termos do inciso I do caput do art. 23 da LGPD;',
            7 => 'VIII - quando o titular tiver fornecido o seu consentimento específico e em destaque para a transferência, com informação prévia sobre o caráter internacional da operação, distinguindo claramente esta de outras finalidades;',
            8 => 'IX - quando necessário para atender as hipóteses previstas nos incisos II, V e VI do art. 7º  da LGPD.'
        ];

        return $mapeamentoTransferencia[$this->tipo_de_garantia_para_transferencia] ?? "Chave inválida!";
        // return Attribute::make(
        //     get: fn(mixed $value) => $mapeamentoTransferencia[$value]??"Chave inválida!"
        // );
    }

    public function getTipoDeGarantiaParaTransferencia()
    {
        return $this->getOriginal('tipo_de_garantia_para_transferencia');
    }
}
