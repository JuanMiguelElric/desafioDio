<div class="row">
    <div class="col-md-3 ">
        <!-- Button trigger modal -->
        <button id="engrenagem" type="button" class="btn btn-primary position-fixed bottom-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-gear"></i>
        </button>
        <!-- Modal -->
        <div class="modal fade h-75" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex">
                        <div class="text-center me-auto" style="width: 6rem;">
                            <img src="{{Vite::asset('resources/images/phrssec/m.png')}}" style="width: 36px;">
                            <h1 class="modal-title fs-6 text-wrap text-secondary text-center">PHRSSEC
                                <br>Segurança da informação
                            </h1>
                        </div>
                        <h1 class="modal-title fs-5 titulo-politica" id="staticBackdropLabel">Política de Privacidade</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="min-height: 150px;">
                        <div class="row">
                            <div class="col-md-3 mb-5">
                                <div class="col-md-12 position-relative">
                                    <div class="btn-group-vertical w-100 position-absolute top-0" role="group" aria-label="Vertical button group">
                                        <button type="button" class="btn btn-primary" onclick="togglePrivacidade()">Política de
                                            Privacidade</button>
                                        <button type="button" class="btn btn-primary" onclick="toggleTermosDeUso()">Termos de Uso</button>
                                        <!-- <button type="button" class="btn btn-primary">Button3</button>
                                                <button type="button" class="btn btn-primary">Button4</button>  -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 pt-5 pt-md-0" id="privacidade">
                                <h1 class="text-center mb-3">Política de Privacidade e Proteção de Dados Pessoais</h1>
                                <p class="text-start">A PHRSSEC – Segurança da Informação, entende como
                                    extremamente relevantes os registros eletrônicos e dados pessoais deixados
                                    do Titular ao utilizar os diversos sites, aplicativos e serviços. Esta
                                    política de privacidade tem o objetivo de para regular, de forma simples,
                                    transparente e objetiva, quais dados pessoais serão obtidos, assim como
                                    quando e de qual forma eles poderão ser utilizados.</p>
                                <p>Esta política se aplica a serviços e produtos relacionados a quaisquer das
                                    marcas e atividades da PHRSSEC – Segurança da Informação, ou seja, aquelas
                                    contidas no site oficial <a href="https://www.phrssec.com" class="fw-bold" target="_blank">https://www.phrssec.com.</a></p>
                                <p>Esta política é voltada a clientes da PHRSSEC – Segurança da Informação e ao
                                    público, e engloba as formas nas quais tratamos dados pessoais destas
                                    pessoas. Caso você seja um colaborador ou fornecedor da PHRSSEC – Segurança
                                    da Informação, deve-se buscar o respectivo aviso de privacidade emitido pela
                                    PHRSSEC – Segurança da Informação, ou o responsável por sua contratação,
                                    para que forneça os termos aplicáveis e o informe sobre seus direitos sobre
                                    seus dados.</p>
                                <p>Em caso de dúvidas adicionais ou requisições, por favor, entre em contato
                                    através do endereço de e-mail: <a href="mailto:dpo@phrssec.com">dpo@phrssec.com.</a></p>
                                <p>A seguir é demonstrado como ocorre o tratamento de dados, apresentando a
                                    Política de Privacidade e Proteção de Dados Pessoais:</p>
                                <p>Esta política poderá ser atualizada, a qualquer tempo, pela PHRSSEC –
                                    Segurança da Informação, mediante aviso no site oficial:
                                    <a href="https://www.phrssec.com" class="fw-bold" target="_blank">https://www.phrssec.com.</a>
                                </p>
                                <h3>1. Definições</h3>
                                <p>Segue um resumo com as principais definições sobre os termos utilizados nesta
                                    política de privacidade.</p>
                                <h5 class="fw-bold">DEFINIÇÕES DE POLÍTICA DE PRIVACIDADE</h5>
                                <p><span class="fw-bold"> Dado Pessoal:</span> Qualquer informação relacionada a pessoa natural, direta ou
                                    indiretamente, identificada ou identificável;</p>
                                <p><span class="fw-bold">Dado Pessoal Sensível:</span> Categoria especial de dados pessoais referentes a
                                    origem racial ou étnica, convicção religiosa, opinião política, filiação a
                                    sindicato ou a organização de carácter religioso, filosófico ou político,
                                    referentes à saúde ou à vida sexual, dados genéticos ou biométricos
                                    relativos à pessoa natural;</p>
                                <p>Titular Pessoa natural a quem se referem os dados pessoais, tais como
                                    antigos, presentes ou potenciais clientes, colaboradores, contratados,
                                    parceiros comerciais e terceiros;</p>
                                <p><span class="fw-bold">Tratamento:</span> Toda operação realizada com dados pessoais, como as que se
                                    referem: a coleta, produção, recepção, classificação, utilização, acesso,
                                    reprodução, transmissão, distribuição, processamento, arquivamento,
                                    armazenamento, eliminação, avaliação ou controle da informação, modificação,
                                    comunicação, transferência, difusão ou extração;</p>
                                <p><span class="fw-bold">Anonimização:</span> Processo de dados relativo a titular que não possa ser
                                    identificado, considerando a utilização de meios técnicos razoáveis e
                                    disponíveis na ocasião de seu tratamento.</p>
                                <h3>2. Quais Dados Serão Utilizados</h3>
                                <p>A PHRSSEC – Segurança da Informação poderá coletar as informações inseridas
                                    pelo Titular no momento do contato ou cadastro e informações coletadas
                                    automaticamente quando da utilização dos Serviços e da rede, como IP
                                    (Internet Protocol) com data e hora da conexão. Assim, o tratamento de dois
                                    tipos de dados pessoais:</p>
                                <p class="fw-bold text-secondary">
                                    * I — Aqueles fornecidos pelo próprio Titular;<br>
                                    * II — Aqueles coletados automaticamente.
                                </p>
                                <p>
                                    I — Dados pessoais fornecidos pelo Titular: A PHRSSEC – Segurança da
                                    Informação coleta todos os dados pessoais inseridos ou encaminhados pelo
                                    Titular, seja ao entrar em contato ou acessar os sistemas da PHRSSEC –
                                    Segurança da Informação. Dados como nome, e-mail, telefone, quando do
                                    preenchimento de formulários, com a adição de outros dados pessoais
                                    fornecidos pelo Titular ao entrar em contato com a PHRSSEC – Segurança da
                                    Informação. Independentemente de quais dados o Titular fornece à PHRSSEC –
                                    Segurança da Informação, apenas faremos uso daqueles efetivamente relevantes
                                    e necessários para o atingimento das finalidades.
                                </p>
                                <p>II — Dados coletados automaticamente: A PHRSSEC – Segurança da Informação
                                    também coleta uma série de informações de modo automático, tais como:
                                    características do dispositivo de acesso, do navegador, IP (com data e
                                    hora), informações sobre cliques, páginas acessadas, entre outros. Para tal
                                    coleta, a PHRSSEC – Segurança da Informação usará algumas tecnologias
                                    padrões, como cookies, utilizadas com o propósito de melhorar a experiência
                                    de navegação do Titular nos serviços, de acordo com seus hábitos e suas
                                    preferências.</p>
                                <p>O Titular poderá acessar, atualizar e complementar seus dados, bem como
                                    poderá solicitar a exclusão dos seus dados entre outros direitos, através do
                                    e-mail: <a href="mailto:dpo@phrssec.com" class="fw-bold">dpo@phrssec.com</a></p>
                                <p>A PHRSSEC – Segurança da Informação reforça que não trata, para as
                                    finalidades gerais aqui dispostas, dados considerados sensíveis pela LGPD
                                    (Lei Geral de Proteção de Dados), como aqueles relacionados a convicção
                                    religiosa, opinião política, filiação a sindicato ou a organização de
                                    caráter religioso, filosófico ou político, dado referente à saúde ou à vida
                                    sexual, dado genético ou biométrico. Nas remotas e específicas hipóteses em
                                    que o faz, o tratamento se fundamenta em termos específicos previamente
                                    disponibilizados aos Titulares, mediante seu consentimento específico ou com
                                    base em autorização legal expressa.</p>
                                <h3>3. Onde os Dados Serão Utilizados</h3>
                                <p>
                                    Os dados pessoais tratados pela PHRSSEC – Segurança da Informação têm como
                                    finalidade o estabelecimento de vínculo contratual ou a gestão,
                                    administração, prestação, ampliação e melhoria dos serviços.</p>
                                <h3> 4. Como São Utilizados os Cookies</h3>
                                <p>
                                    Cookies são arquivos ou informações que podem ser armazenadas em
                                    dispositivos quando se visita sites ou utiliza os serviços on-line, como da
                                    PHRSSEC – Segurança da Informação.</p>
                                <p>A PHRSSEC – Segurança da Informação utiliza cookies para facilitar o uso e
                                    melhor adaptar suas páginas aos interesses e necessidades dos Titulares, bem
                                    como para compilarmos informações sobre a utilização de nossos sites e
                                    serviços, auxiliando a melhorar suas estruturas e seus conteúdos. Os cookies
                                    também podem ser utilizados para acelerar suas atividades e experiências
                                    futuras em nosso site (experiência ao usuário).
                                </p>
                                <p>O que são cookies e como são utilizados no site?
                                    Os cookies são pequenos arquivos criados por sites visitados e que são
                                    salvos no computador do usuário, por meio do navegador (browser). Esses
                                    arquivos contêm informações que servem para identificar o visitante,
                                    facilitando o transporte de dados entre as páginas de um mesmo site.</p>
                                <p>Após o Titular consentir para a utilização de cookies, quando do uso das
                                    páginas se armazenará um cookie no dispositivo para lembrar na próxima
                                    sessão.
                                </p>
                                <p>A qualquer momento, o Titular poderá revogar seu consentimento quanto aos
                                    cookies, pelo que deverá apagar os cookies das páginas da PHRSSEC –
                                    Segurança da Informação, utilizando as configurações de seu
                                    navegador(browser).
                                </p>
                                <p>Por fim, lembramos que, caso o Titular não aceite a política de cookies da
                                    página da PHRSSEC – Segurança da Informação, os serviços poderão não
                                    funcionar de maneira correta, tendo a experiência do usuário afetada. Não
                                    acesse o site, caso não aceite da utilização de cookies.
                                </p>
                                <h3>5. Compartilhamento de Dados
                                </h3>
                                <p>Ao aceitar a política de privacidade e aceite dos cookies, o usuário tem
                                    ciência e concorda que, na necessidade, haverá compartilhamento de dados em
                                    ferramentas de terceiros, como ferramentas de marketing, comerciais, de
                                    gestão de pessoas, entre outras.
                                </p>
                                <h3>6. Como Mantemos os Dados Seguros
                                </h3>
                                <p>A PHRSSEC – Segurança da Informação utiliza os meios regulares do mercado e
                                    legalmente atribuídos para garantir a proteção dos dados pessoais.
                                </p>

                                <p>Além dos esforços técnicos, a PHRSSEC – Segurança da Informação também adota
                                    medidas institucionais visando a proteção de dados pessoais, de modo que
                                    mantém programa de segurança da informação tendo a privacidade aplicado às
                                    suas atividades e estrutura, sendo constantemente atualizado.
                                </p>
                                <p>Embora a PHRSSEC – Segurança da Informação adote os melhores esforços no
                                    sentido de preservar a privacidade e proteger os dados dos Titulares,
                                    nenhuma transmissão de informações é totalmente segura. A PHRSSEC –
                                    Segurança da Informação não pode garantir integralmente que todas as
                                    informações que recebe ou envia não sejam alvo de acessos não autorizados
                                    através de métodos desenvolvidos para obter informações indevidamente.
                                    Incentivamos que os Titulares devam tomar as medidas apropriadas para se
                                    proteger, como, manter confidenciais todos os documentos pessoais e senhas,
                                    sendo certo que tais informações são pessoais, intransferíveis, e de
                                    exclusiva responsabilidade dos Titulares.
                                </p>
                                <h3>7. Retenção das Informações
                                </h3>
                                <p>Visando proteger a privacidade dos Titulares, os dados pessoais tratados pela
                                    PHRSSEC – Segurança da Informação serão automaticamente eliminados quando
                                    deixarem de ser úteis para os fins para os quais foram coletados, ou quando
                                    o Titular solicitar sua eliminação, exceto se sua manutenção for
                                    expressamente autorizada por lei ou regulação aplicável.
                                </p>
                                <p>Contudo, as informações poderão ser conservadas para cumprimento de obrigação
                                    legal ou regulatória, transferência a terceiro, desde que respeitados os
                                    requisitos de tratamento de dados, inclusive para o exercício de seus
                                    direitos em processos judiciais ou administrativos.
                                </p>
                                <h3>8. Direitos dos Titulares
                                </h3>
                                <p>Em cumprimento à regulamentação aplicável, no que diz respeito ao tratamento
                                    de dados pessoais, a PHRSSEC – Segurança da Informação respeita e garante ao
                                    Titular, a possibilidade de apresentação de solicitações baseadas nos
                                    seguintes direitos:
                                </p>
                                <p><span class="fw-bold">I.</span> A confirmação da existência de tratamento;<br>
                                    <span class="fw-bold">II.</span> O acesso aos dados;<br>
                                    <span class="fw-bold">III.</span> A correção de dados incompletos, inexatos ou desatualizados;<br>
                                    <span class="fw-bold">IV.</span> A anonimização, bloqueio ou eliminação de dados desnecessários,
                                    excessivos ou tratados em desconformidade;<br>
                                    <span class="fw-bold">V.</span> A portabilidade de seus dados a outro fornecedor de serviço ou produto,
                                    mediante requisição expressa pelo Titular;<br>
                                    <span class="fw-bold">VI.</span> A eliminação dos dados tratados com consentimento do Titular;<br>
                                    <span class="fw-bold">VII.</span> A obtenção de informações sobre as entidades públicas ou privadas com
                                    as quais a PHRSSEC – Segurança da Informação compartilhou seus dados;<br>
                                    <span class="fw-bold">VIII.</span> A informação sobre a possibilidade de não fornecer o seu
                                    consentimento, bem como de ser informado sobre as consequências, em caso de
                                    negativa;<br>
                                    <span class="fw-bold">IX.</span> A revogação do consentimento.
                                </p>
                                <p>Os direitos poderão ser exercidos pelo titular através de uma requisição
                                    direta através do e-mail: <a href="mailto:dpo@phrssec.com" class="fw-bold">dpo@phrssec.com.</a>
                                </p>
                                <p>A PHRSSEC – Segurança da Informação empreenderá todos os esforços para
                                    atender tais pedidos no menor espaço de tempo possível, no entanto, fatores
                                    justificáveis, tais como a complexidade da ação requisitada, poderão atrasar
                                    ou impedir seu rápido atendimento.
                                </p>
                                <p>Por fim, o Titular deve estar ciente que sua requisição poderá ser legalmente
                                    rejeitada, seja por motivos formais (a exemplo de sua incapacidade de
                                    comprovar sua identidade) ou legais (a exemplo do pedido de exclusão de
                                    dados cuja manutenção é livre exercício de direito da PHRSSEC – Segurança da
                                    Informação).
                                </p>
                                <h3>9. Legislação e Foro
                                </h3>
                                <p>Esta Política será regida, interpretada e executada de acordo com as Leis da
                                    República Federativa do Brasil, especialmente a Lei n.º 13.709/2018 e Lei
                                    n.º 13.853/2019 (atualmente em vigência), independentemente das Leis de
                                    outros estados ou Países, sendo competente o foro de Mafra/SC, para qualquer
                                    dúvida decorrente sobre este documento.
                                </p>
                                <h3>10. Encarregado
                                </h3>
                                <p>A PHRSSEC – Segurança da Informação define como encarregado pelo tratamento
                                    de informações pessoais:
                                </p>
                                <p>* Pedro Henrique Rauen Sprotte (DPO) — <a href="mailto:dpo@phrssec.com" class="fw-bold">dpo@phrssec.com.</a></p>
                                <p>Ao navegar em nosso site, você consente com a utilização de cookies e a nossa
                                    Política de Privacidade.</p>
                                <p>Atualizado em 08 de janeiro de 2023.</p>
                            </div>
                            <div class="col-md-9 termos-de-uso d-none pt-5 pt-md-0" id="termos-de-uso">
                                <h1 class="text-center mb-3">
                                    Ao acessar e utilizar o site e sistema da PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA, você concorda com os seguintes termos de uso:
                                </h1>
                                <h3>
                                    1. Definições
                                </h3>
                                <p>PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA: A empresa responsável pelo site e sistema.
                                    Usuário: A pessoa física ou jurídica que acessa e utiliza o site e sistema.
                                    Dados pessoais: Todas as informações que permitem a identificação do usuário, como nome, endereço, e-mail, telefone, entre outros os quais serão colocados para finalidade e necessidade descritas em contrato.
                                    LGPD: Lei Geral de Proteção de Dados Pessoais.</p>
                                <h3>2. Objeto</h3>
                                <p>Estes termos de uso estabelecem as condições gerais de utilização do site e sistema da PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA.</p>
                                <h3>3. Acesso ao site e sistema</h3>
                                <p>O acesso ao site e sistema é gratuito e livre para qualquer usuário. No entanto, alguns serviços e funcionalidades podem estar disponíveis apenas para usuários registrados.</p>
                                <h3>4. Cadastro</h3>
                                <p>Para acessar alguns serviços e funcionalidades do site e sistema, o usuário deverá se cadastrar, fornecendo os seguintes dados pessoais: nome, e-mail, endereço.</p>
                                <h3>5. Dados pessoais</h3>
                                <p>A PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA coleta e armazena os dados pessoais dos usuários para fins de identificação, comunicação, prestação de serviços e cumprimento de obrigações legais.</p>
                                <p>A PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA utiliza as seguintes medidas de segurança para proteger os dados pessoais dos usuários:</p>
                                <p>Criptografia de dados;<br>
                                    Firewall;<br>
                                    Controle de acesso;<br>
                                    Políticas de segurança;<br>
                                    Treinamento de colaboradores;<br>
                                    Sempre seguindo as boas práticas de segurança da informação e privacidade de dados.</p>
                                <h3>6. Direitos do usuário</h3>
                                <p>O usuário tem o direito de acessar, corrigir, atualizar e excluir os seus dados pessoais. O usuário também tem o direito de solicitar o bloqueio ou eliminação dos seus dados pessoais, nos casos previstos na LGPD.</p>
                                <h3>7. Alterações aos termos de uso</h3>
                                <p>A PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA se reserva o direito de alterar estes termos de uso a qualquer momento. As alterações serão divulgadas no site e sistema da PHRSSEC SEGURANÇA DA INFORMAÇÃO - <a href="https://www.phrssec.com" class="fw-bold">www.phrssec.com.</a></p>
                                <h3>8. Foro</h3>
                                <p>As questões relacionadas a estes termos de uso serão dirimidas no foro da comarca de Mafra/SC.</p>
                                <h3>9. Aceite</h3>
                                <p>Ao acessar e utilizar o site e sistema da PHRSSEC SEGURANÇA DA INFORMAÇÃO LTDA, você concorda com estes termos de uso.</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="me-auto">
                            <h1 class="fs-6 lh-sm">PHRSSEC <br> by PHRSSEC -
                                <?php echo date('Y'); ?>
                            </h1>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Rejeitar</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceitar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const toggleDisplay = (elementToShow, elementToHide) => {
        elementToHide.classList.remove('d-block');
        elementToHide.classList.add('d-none');
        elementToShow.classList.remove('d-none');
        elementToShow.classList.add('d-block');
    };

    const togglePrivacidade = () => {
        const privacidade = document.querySelector('#privacidade');
        const termosDeUso = document.querySelector('#termos-de-uso');
        const tituloPolitica = document.querySelector('.titulo-politica');
        tituloPolitica.innerHTML = "Política de Privacidade"
        toggleDisplay(privacidade, termosDeUso);
    };

    const toggleTermosDeUso = () => {
        const termosDeUso = document.querySelector('#termos-de-uso');
        const privacidade = document.querySelector('#privacidade');
        const tituloPolitica = document.querySelector('.titulo-politica');
        tituloPolitica.innerHTML = "Termos de Uso"
        toggleDisplay(termosDeUso, privacidade);
    };
</script>