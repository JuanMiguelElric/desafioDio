<?php

namespace App\Enums\DataMapping;


enum BaseLegalEnum: string implements EnumInterface
{
    case CONSENTIMENTO                                    = "I - Consentimento";
    case CUMPRIMENTO_DE_OBRIGACAO_LEGAL                   = "II - Cumprimento de obrigação legal ou regulatória pelo controlador";
    case EXECUCAO_DE_POLITICAS_PUBLICAS                   = "III - Administração pública para execução de políticas públicas";
    case ESTUDOS_POR_ORGAO_DE_PESQUISA                    = "IV - Realização de estudos por órgão de pesquisa";
    case EXECUCAO_DE_CONTRATO_DILIGENCIAS_PRE_CONTRATUAIS = "V - Execução de contrato ou procedimentos preliminares";
    case EXERCICIO_REGULAR_DE_DIREITOS                    = "VI - Exercício regular de direitos em processo judicial ou arbitral";
    case PROTECAO_DA_VIDA                                 = "VII - Proteção da vida ou da incolumidade física";
    case TUTELA_DE_SAUDE                                  = "VIII - Tutela da saúde";
    case INTERESSE_LEGITIMO_DO_CONTROLADOR_TERCEIRO       = "IX - Atendimento aos interesses legítimos do controlador ou terceiro";
    case PROTECAO_AO_CREDITO                              = "X - Proteção do crédito";
   // case PREVENCAO_A_FRAUDE_E_A_SEGURANCA_DO_TITULAR      = "Prevenção à Fraude e à Segurança do Titular (aplicável somente para dados pessoais sensíveis)";
    case NAO_APLICAVEL                                    = "Não aplicável";
    
    public static function iterarEnum(): array
    {
        $baseLegalOptions = [];
        foreach (BaseLegalEnum::cases() as $case) {
        $baseLegalOptions[$case->value] = $case->value;
        }
        return $baseLegalOptions;
    }
}
