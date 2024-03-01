@extends('layouts.phrssec')
@section('title', 'Página inicial')
@section('content')

<header class="container-fluid" id="inicio">
    <div class="container header ">
        <div class="row d-flex align-items-md-center justify-content-between h-100 ">
            <div class="col-sm-12 col-md-12 col-lg-6 animate__animated ">
                <div class="col-md-12">
                    <h1>Consultoria e Serviços em Segurança da Informação e LGPD</h1>
                </div>
                <div class="col-md-12">
                    <p>Privacidade de dados é um dos principais temas globais da atualidade. Conheça as soluções
                        para Segurança da Informação e LGPD e projete sua organização para a nova era de dados
                        protegidos garantindo a adequação às leis de proteção de dados nacionais e internacionais.
                    </p>
                </div>
                <div class="col-md-12 ">
                    <a type="button" class="btn btn-primary px-5" href="#planos">Ver Planos</a>
                </div>
            </div>
            <div class="d-none d-lg-block  col-lg-6 text-end animate__animated "><img src="{{Vite::asset('resources/images/phrssec/cadeado.png')}}" alt=""></div>
        </div>
    </div>
</header>

<main>
    <section id="carousel-header" class="d-flex align-content-center container">
        <!-- CAROUSEL -->
        <div id="carouselExampleIndicators" class="carousel slide w-100 carousel-dark d-none d-lg-block" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" style="width: 15px;height: 15px;border-radius:50%;"></button> -->
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-around ">
                        <div class="card" style="width: 18rem; border:none;">
                            <i class="bi bi-eye text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Avaliação de Riscos</h5>
                                <p class="card-text">Realizar uma análise abrangente dos riscos relacionados ao
                                    tratamento de dados, identificando possíveis brechas de segurança e áreas que
                                    necessitam de melhorias.</p>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem; border:none;">
                            <i class="bi bi-activity text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Monitoramento Contínuo</h5>
                                <p class="card-text"> Implementar sistemas de monitoramento e detecção de violações
                                    de segurança em tempo real, permitindo a resposta rápida a incidentes.</p>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem; border:none;">
                            <i class="bi bi-award-fill text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Treinamento e Conscientização</h5>
                                <p class="card-text">Capacitar os colaboradores para compreenderem a importância da
                                    privacidade de dados e suas responsabilidades em relação ao tratamento adequado
                                    das informações.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="d-flex justify-content-between ">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-search text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Auditorias Regulares</h5>
                                <p class="card-text">Realizar auditorias internas e externas para garantir a
                                    conformidade contínua e a melhoria contínua dos processos de proteção de dados.
                                </p>
                            </div>
                        </div>
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-device-hdd-fill text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Políticas de Retenção de Dados</h5>
                                <p class="card-text">Definir e seguir políticas claras de retenção de dados,
                                    assegurando que as informações pessoais sejam retidas apenas pelo período
                                    necessário e legalmente permitido.</p>
                            </div>
                        </div>
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-person-check-fill text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Encarregado de Proteção de Dados (DPO)</h5>
                                <p class="card-text">Designar um DPO responsável por supervisionar a conformidade
                                    com as leis de proteção de dados e atuar como ponto de contato para questões
                                    relacionadas à privacidade.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="carousel-item ">
                        <div class="d-flex justify-content-between ">
                            <div class="card shadow" style="width: 18rem; border:none;">
                                <i class="bi bi-eye text-center" style="font-size: 61px;"></i>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Avaliação de Riscos</h5>
                                    <p class="card-text">Realizar uma análise abrangente dos riscos relacionados ao tratamento de dados, identificando possíveis brechas de segurança e áreas que necessitam de melhorias.</p>
                                </div>
                            </div>
                            <div class="card shadow" style="width: 18rem; border:none;">
                                <i class="bi bi-activity text-center" style="font-size: 61px;"></i>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Monitoramento Contínuo</h5>
                                    <p class="card-text"> Implementar sistemas de monitoramento e detecção de violações de segurança em tempo real, permitindo a resposta rápida a incidentes.</p>
                                </div>
                            </div>
                            <div class="card shadow" style="width: 18rem; border:none;">
                                <i class="bi bi-award-fill text-center" style="font-size: 61px;"></i>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Treinamento e Conscientização</h5>
                                    <p class="card-text">Capacitar os colaboradores para compreenderem a importância da privacidade de dados e suas responsabilidades em relação ao tratamento adequado das informações.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->

            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
        </div>
        <!--FIM CAROUSEL -->

        <!-- CAROUSEL -->
        <div id="carousel" class="carousel slide w-100 carousel-dark d-xs-block d-lg-none" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="3" aria-label="Slide 4" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="4" aria-label="Slide 5" style="width: 15px;height: 15px;border-radius:50%;"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="5" aria-label="Slide 6" style="width: 15px;height: 15px;border-radius:50%;"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-eye text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Avaliação de Riscos</h5>
                                <p class="card-text">Realizar uma análise abrangente dos riscos relacionados ao
                                    tratamento de dados, identificando possíveis brechas de segurança e áreas que
                                    necessitam de melhorias.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-activity text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Monitoramento Contínuo</h5>
                                <p class="card-text"> Implementar sistemas de monitoramento e detecção de violações
                                    de segurança em tempo real, permitindo a resposta rápida a incidentes.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-award-fill text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Treinamento e Conscientização</h5>
                                <p class="card-text">Capacitar os colaboradores para compreenderem a importância da
                                    privacidade de dados e suas responsabilidades em relação ao tratamento adequado
                                    das informações.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-search text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Auditorias Regulares</h5>
                                <p class="card-text">Realizar auditorias internas e externas para garantir a
                                    conformidade contínua e a melhoria contínua dos processos de proteção de dados.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-device-hdd-fill text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Políticas de Retenção de Dados</h5>
                                <p class="card-text">Definir e seguir políticas claras de retenção de dados,
                                    assegurando que as informações pessoais sejam retidas apenas pelo período
                                    necessário e legalmente permitido.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <div class="card " style="width: 18rem; border:none;">
                            <i class="bi bi-person-check-fill text-center" style="font-size: 61px;"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Encarregado de Proteção de Dados (DPO)</h5>
                                <p class="card-text">Designar um DPO responsável por supervisionar a conformidade
                                    com as leis de proteção de dados e atuar como ponto de contato para questões
                                    relacionadas à privacidade.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
        </div>
        <!--FIM CAROUSEL -->
    </section>

    <!-- SERVIÇOS -->
    <section id="nossos-servicos" class="pt-5 text-white pb-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 pb-5">
                    <h1>Conheça nossos serviços</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6  ">
                    <div class="col-md-12">
                        <div class="card cards ps-5 px-5 text-dark mb-5">
                            <div class="d-flex align-content-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapse01" aria-expanded="false" aria-controls="collapse01">
                                <i class="bi bi-award-fill " style="font-size: 61px;"></i>
                                <span class="mt-3 text-secondary">01/</span>
                            </div>
                            <div class="card-body text-dark">
                                <h5 class="card-title fw-bold">Adequação à LGPD</h5>
                                <div class="collapse" id="collapse01">
                                    <div class="card card-body">
                                        Desenvolvimento de um programa completo para o atendimento aos requisitos da
                                        LGPD, Lei Geral de
                                        Proteção de Dados para garantir a proteção e privacidade dos dados pessoais.
                                    </div>
                                    <a href="https://wa.me/554139952478?text=Gostaria%20de%20saber%20mais%20sobre%20Adequação%20à%20LGPD" target="_blank">Saiba mais</a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-close collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse01" aria-expanded="false" aria-controls="collapse01">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card cards ps-5 px-5 text-dark mb-5">
                            <div class="d-flex align-content-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapse02" aria-expanded="false" aria-controls="collapse02">
                                <i class="bi bi-patch-plus-fill" style="font-size: 61px;"></i>
                                <span class="mt-3 text-secondary">02/</span>
                            </div>
                            <div class="card-body text-dark">
                                <h5 class="card-title fw-bold">Sistema de Gestão em LGPD Serviços Gerenciados</h5>
                                <div class="collapse" id="collapse02">
                                    <div class="card card-body">
                                        Implementação e operação de um sistema que ajuda as organizações a cumprir
                                        os requisitos da Lei Geral de Proteção de Dados (LGPD)
                                    </div>
                                    <a href="https://wa.me/554139952478?text=Gostaria%20de%20saber%20mais%20sobre%20Sistema%20de%20Gestão%20em%20LGPD%20Serviços%20Gerenciados" target="_blank">Saiba mais</a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-close collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse02" aria-expanded="false" aria-controls="collapse02">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-12" style="max-width: 495px;">
                        <a target="_blank" href="https://wa.me/554139952478?text=Gostaria%20de%20conversar%20com%20um%20especialista" class="btn btn-primary w-100 p-4" style="border-radius: 10px;">Consulte um de
                            nossos Especialistas</a>
                    </div>
                </div>
                <div class="col-md-6 margin-negativa   ">
                    <div class="col-md-12">
                        <div class="card cards ps-5 px-5 text-dark mb-5">
                            <div class="d-flex align-content-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                                <i class="bi bi-shield-lock-fill " style="font-size: 61px;"></i>
                                <span class="mt-3 text-secondary">03/</span>
                            </div>
                            <div class="card-body text-dark">
                                <h5 class="card-title fw-bold">Segurança Cibernética</h5>
                                <div class="collapse" id="collapse03">
                                    <div class="card card-body">
                                        Proteção de sistemas de computador, redes, dados e informações digitais contra ameaças, ataques e acesso não autorizado.
                                    </div>
                                    <a target="_blank" href="https://wa.me/554139952478?text=Gostaria%20de%20saber%20mais%20sobre%20Segurança%20Cibernética" target="_blank" class="card-link">Saiba mais</a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-close collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse03" aria-expanded="false" aria-controls="collapse03">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card cards ps-5 px-5 text-dark mb-5">
                            <div class="d-flex align-content-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapse04" aria-expanded="false" aria-controls="collapse04">
                                <i class="bi bi-person-gear " style="font-size: 61px;"></i>
                                <span class="mt-3 text-secondary">04/</span>
                            </div>
                            <div class="card-body text-dark">
                                <h5 class="card-title fw-bold">DPO as a Service <br> CISO as a Service</h5>
                                <div class="collapse" id="collapse04">
                                    <div class="card card-body">
                                        <p>Terceirização de um Encarregado de Proteção de Dados para garantir conformidade com leis de privacidade, como LGPD e GDPR.</p>
                                        <p>Terceirização de um Chief Information Security Officer para fornecer expertise em segurança cibernética e supervisionar a proteção de dados e sistemas da organização.</p>
                                    </div>
                                    <a target="_blank" href="https://wa.me/554139952478?text=Gostaria%20de%20saber%20mais%20sobre%20o%20serviço%20de%20DPO%20as%20a%20Service%20e%20CISO%20as%20a%20Service">Saiba mais</a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-close collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse04" aria-expanded="false" aria-controls="collapse04">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card cards ps-5 px-5 text-dark mb-5">
                            <div class="d-flex align-content-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapse05" aria-expanded="false" aria-controls="collapse05">
                                <i class="bi bi-clipboard-fill" style="font-size: 61px;"></i>
                                <span class="mt-3 text-secondary">05/</span>
                            </div>
                            <div class="card-body text-dark">
                                <h5 class="card-title fw-bold">Security and Privacy Awareness <br>(Conscientização e
                                    Treinamento)</h5>
                                <div class="collapse" id="collapse05">
                                    <div class="card card-body">
                                        <p>Educar funcionários sobre melhores práticas de segurança cibernética e proteção de dados, reduzindo riscos de violações e vazamentos. </p>
                                        <p>Isso é feito por meio de treinamentos regulares, simulados de phishing e comunicação contínua sobre ameaças e medidas preventivas. A conscientização fortalece a postura de segurança da organização e promove uma cultura de respeito à privacidade.</p>
                                    </div>
                                    <a target="_blank" href="https://wa.me/554139952478?text=Gostaria%20de%20saber%20mais%20sobre%20Security%20and%20Privacy%20Awareness">Saiba mais</a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-close collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse05" aria-expanded="false" aria-controls="collapse05">

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-none col-md-12">
                        <a target="_blank" href="https://wa.me/554139952478?text=Gostaria%20de%20conversar%20com%20um%20especialista" class="btn btn-primary w-100 p-4">Consulte um de nossos Especialistas</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIM SERVIÇOS -->
    <!-- PLANOS -->
    <section id="planos" class="mt-5 container">
        <div class="row mb-5">
            <div class="col-md-12 d-flex justify-content-between align-items-center mt-5">
                <span class="fs-1 lh-1 ">Precisa se adequar a <span class="text-primary">LGPD</span> <br>Conheça
                    nosso planos</span>
                <div class="d-flex">
                    <img src="{{Vite::asset('resources/images/phrssec/seta.png')}}" alt="" class="img-fluid d-none d-lg-block">
                    <a href="#" class="btn btn-primary text-uppercase d-flex justify-content-center align-items-center shadow cta">Nos
                        chame agora</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-between g-5">
            <div class="col-sm-12 col-lg-4 h-100 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center bg-light planos pt-2 pb-2">
                    <h1 class="text-uppercase font-monospace">Essencial</h1>
                    <a href="https://wa.me/554139952478?text=Olá,%0A%0AEstou%20buscando%20a%20excelência%20na%20proteção%20de%20dados%20e%20privacidade%20em%20meu%20negócio.%20O%20Plano%20Essencial%20oferece%20um%20roteiro%20profissional%20e%20abrangente:%0A%0A%20Reunião%20de%20Kick-Off%0A%20Mapeamento%20detalhado%20de%20fluxo%20de%20dados%0A%20Diagnóstico%20e%20ações%20prioritárias%0A%20Programa%20de%20proteção%20de%20dados%20com%20plano%20de%20ação%0A%20Estabelecimento%20de%20políticas%20e%20normas%0A%20Implementação%20de%20medidas%20técnicas%20e%20organizacionais%0A%20Canal%20de%20comunicação%20dedicado%20ao%20titular%20de%20dados%0A%20Treinamento%20abrangente%20em%20Privacidade%20de%20Dados%0A%0AEste%20plano%20fortalecerá%20nossa%20conformidade%20e%20abordagem%20ética.%20Aguardo%20ansiosamente%20para%20discutir%20mais%20detalhes.%0A%0AAtenciosamente,%0A[Seu%20Nome]" target="_blank" class="btn btn-outline-success w-50">Dê o start</a>
                    <div class="w-75 border mt-3 mb-3"></div>
                    <div class="w-75">
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Reunião de Kick-Off</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Mapeamento do fluxo de dado pessoal</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Diagnóstico (Gap Analysis) e definição de ações
                                prioritárias</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Programa de proteção de dados e plano de ação</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Estabelecimento de políticas, normas e processo de
                                privacidade</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Implementação de medidas técnicas e organizativas</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Criação de canal de comunicação com o titular de dados</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Treinamento geral de Privacidade de Dados</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-sm-12 col-lg-4 h-100 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center bg-light planos pt-2 pb-2">
                    <h1 class="text-uppercase font-monospace">Profissional</h1>
                    <a href="https://wa.me/554139952478?text=Olá,%0A%0AEstou%20interessado%20no%20Plano%20Profissional%20de%20Privacidade%20de%20Dados.%20Ele%20oferece%20uma%20solução%20abrangente%20e%20sofisticada,%20com%20os%20seguintes%20recursos:%0A%0A%20Todos%20os%20itens%20do%20Plano%20Essencial%0A%20Indicadores%20e%20Relatórios%0A%20Assessoria%20Jurídica%0A%20Assessoria%20em%20TI%20e%20Segurança%20da%20Informação%0A%20Suporte%20Técnico%20com%20acesso%20ao%20time%20de%20especialistas%20por%20Meet%20ou%20WhatsApp%0A%20Relatório%20de%20Registro%20de%20Atividades%20de%20Processamento%20(ROPA)%0A%20Treinamentos%20e%20materiais%20de%20conscientização%20para%20colaboradores%0A%20Respostas%20às%20requisições%20de%20titulares%20de%20dados%20e%20da%20ANPD%0A%0AEste%20plano%20elevará%20nossa%20abordagem%20à%20privacidade%20e%20conformidade%20a%20um%20nível%20profissional.%20Estou%20empolgado%20para%20discutir%20mais%20detalhes.%0A%0AAtenciosamente,%0A[Seu%20Nome]" target="_blank" class="btn btn-outline-success w-50">Dê o start</a>
                    <div class="w-75 border mt-3 mb-3"></div>
                    <div class="w-75">
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Todos os itens do Essencial</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Indicadores e Relatórios</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Assessoria Jurídica</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Assessoria em TI e Segurança da Informação</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Suporte Técnico com acesso ao time de especialistas por Meet ou
                                WhatsApp</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Relatório de Registro de Atividades de Processamento (ROPA)</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Treinamentos e materiais de conscientização para
                                colaboradores</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Respostas às requisições de titulares de dados e da ANPD</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 h-100 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center bg-light planos pt-2 pb-2">
                    <h1 class="text-uppercase font-monospace">Master</h1>
                    <a href="https://wa.me/554139952478?text=Olá,%0A%0AEstou%20interessado%20no%20Plano%20MASTER%20de%20Privacidade%20de%20Dados.%20Este%20plano%20é%20a%20solução%20mais%20abrangente%20e%20avançada,%20incluindo%20os%20seguintes%20recursos:%0A%0A%20Todos%20os%20itens%20do%20Plano%20Essencial%20e%20Profissional%0A%20Papéis%20e%20responsabilidades%20recomendados%20de%20acordo%20com%20a%20empresa%0A%20Desenho%20de%20segregação%20de%20acessos%20de%20usuários%20em%20sistemas%20com%20foco%20na%20LGPD%0A%20Controles%20de%20monitoramento%20(riscos%20à%20privacidade%20da%20empresa)%0A%20Encarregado%20de%20Proteção%20de%20Dados%20Pessoais%20(DPO)%20terceirizado%0A%20Avaliação%20de%20riscos%20de%20fornecedores%20e%20terceiros%0A%20Inventário%20de%20ativos%20(Hardware%20e%20Software)%0A%20Processo%20de%20Gestão%20de%20Incidentes%0A%20Auditoria%0A%0AEste%20plano%20elevará%20nossa%20abordagem%20à%20privacidade,%20conformidade%20e%20segurança%20de%20dados%20a%20um%20nível%20mais%20alto.%20Estou%20entusiasmado%20para%20explorar%20os%20detalhes%20com%20você.%0A%0AAtenciosamente,%0A[Seu%20Nome]" target="_blank" class="btn btn-outline-success w-50">Dê o start</a>
                    <div class="w-75 border mt-3 mb-3"></div>
                    <div class="w-75">
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Todos os itens do Essencial e Profissional</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Papeis e responsabilidades recomendados de acordo com a
                                empresa</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Desenho de segregação de acessos de usuários em sistemas com foco
                                na LGPD</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Controles de monitoramento ( riscos a privacidade da
                                empresa)</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Encarregado de Proteção de Dados Pessoais (DPO)
                                terceirizado</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Avaliação de riscos de fornecedores e terceiros</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Inventário de ativos (Hardware e Software)</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Processo de Gestão de Incidentes</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Auditoria</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 h-100 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center bg-light planos pt-2 pb-2">
                    <h1 class="text-uppercase font-monospace">Enterprise</h1>
                    <a href="https://wa.me/554139952478?text=Olá,%0A%0AEstou%20interessado%20no%20Plano%20ENTERPRISE%20de%20Privacidade%20de%20Dados.%20Este%20plano%20oferece%20uma%20solução%20completa%20e%20avançada,%20incluindo%20os%20seguintes%20recursos:%0A%0A%20Todos%20os%20itens%20do%20Plano%20Essencial,%20Profissional%20e%20Master%0A%20Gestão%20em%20Compliance%0A%20Monitoramento%20e%20Gestão%20de%20Riscos%20e%20Segurança%20Cibernética%0A%20Plano%20de%20comunicação%20contínuo%20na%20organização%0A%20Plano%20de%20Conscientização%20personalizado%20em%20Segurança%20da%20Informação%20e%20Privacidade%20de%20Dados%0A%20Roadmap%20de%20ações%20de%20Segurança%20da%20Informação%20e%20de%20Privacidade%20de%20Dados%0A%0AEste%20plano%20elevará%20nossa%20abordagem%20à%20privacidade,%20conformidade%20e%20segurança%20de%20dados%20a%20um%20patamar%20corporativo%20avançado.%20Estou%20empolgado%20para%20explorar%20os%20detalhes%20com%20você.%0A%0AAtenciosamente,%0A[Seu%20Nome]" target="_blank" class="btn btn-outline-success w-50">Consulte um especialista</a>
                    <div class="w-75 border mt-3 mb-3"></div>
                    <div class="w-75">
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Todos os itens do Essencial, Profissional e Master</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Gestão em Compliance</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Monitoramento e Gestão de Riscos e Segurança Cibernética</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Plano de comunicação contínuo na organização</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Plano de Conscientização personalizado em Segurança da Informação
                                e Privacidade de Dados</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold">Roadmap de ações de Segurança da Informação e de Privacidade de
                                Dados</span>
                            <img src="{{Vite::asset('resources/images/phrssec/green-ball.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 h-100 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center bg-light planos pt-2 pb-2">
                    <h1 class="text-uppercase font-monospace text-center fs-2">dpo as a service</h1>
                    <a href="https://wa.me/554139952478?text=DPO%20as%20a%20Service%20é%20um%20serviço%20oferecido%20pela%20PHRSSEC,%20que%20permite%20a%20contratação%20de%20um%20DPO%20profissional.%20A%20sua%20empresa%20pode%20designar%20um%20especialista%20em%20segurança%20e%20privacidade%20de%20dados%20para%20assumir%20o%20cargo%20de%20DPO.%20Desta%20forma,%20não%20sobrecarrega%20nenhum%20colaborador%20e%20garante%20que%20a%20função%20será%20ocupada%20por%20um%20especialista%20na%20área,%20que%20vai%20assegurar%20o%20cumprimento%20da%20lei." target="_blank" class="btn btn-outline-success w-50">Dê o start</a>
                    <div class="w-75 border mt-3 mb-3"></div>
                    <div class="w-75">
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold text-center mb-3">DPO as a Service é um serviço oferecido pela
                                PHRSSEC, que permite
                                a contratação de um DPO profissional</span>
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold text-center mb-3">A sua empresa pode designar um especialista em
                                segurança e
                                privacidade de dados para assumir o cargo de DPO</span>
                        </div>
                        <div class="d-flex justify-content-between w-100 align-items-center mb-1 animate__animated">
                            <span class="fw-bold text-center mb-2">Desta forma, não sobrecarrega nenhum colaborador
                                e garante que a
                                função será ocupada por um especialista na área, que vai assegurar o cumprimento da
                                lei.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- FIM PLANOS -->

    <!-- CERTIFICAÇÕES -->
    <section id="certificacoes" class="mt-5 container-fluid pt-5 pb-5">
        <div class="container text-white">
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-6 ">
                    <h1 class="fs-1 fw-bold certificacoes-texto">Profissionais <br> <span class="text-primary">Certificados</span></h1>
                    <p class="fs-1 certificacoes-texto">Além de tratar dos aspectos mais genéricos da Lei, estas
                        certificações, atende o ramo de
                        Segurança
                        da Informação e inclui também a análise de cases práticos sobre a aplicação da LGPD em
                        qualquer
                        segmento.</p>
                </div>
                <div class="d-none d-md-block col-md-6">
                    <div class="d-flex flex-column justify-content-center align-items-end gap-3">
                        <img src="{{Vite::asset('resources/images/phrssec/certificado1.png')}}" class="img-fluid certificacoes-img" alt="">
                        <img src="{{Vite::asset('resources/images/phrssec/certificado2.png')}}" class="img-fluid certificacoes-img" alt="">
                        <img src="{{Vite::asset('resources/images/phrssec/certificado3.png')}}" class="img-fluid certificacoes-img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIM CERTIFICAÇÕES -->
    <section id="compliance" class="container-fluid pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="d-none d-lg-block col-md-6 d-flex align-items-center">
                    <img src="{{Vite::asset('resources/images/phrssec/image4.png')}}" alt="Certificado Compliance">
                </div>
                <div class="col-md-6 d-flex align-items-center ">
                    <p class="fs-1 text-center">
                        Emitimos um Certificado para atestar sua conformidade, evidenciando seu comprometimento com
                        o
                        atendimento à LGPD.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTATO -->
    <section id="contato" class="container-fluid text-light pt-5 pb-5">
        <div class="container">
            <h1 class="text-uppercase text-center">Fale com um especialista</h1>
            <div class="row">
                <form class="g-3" method="post" action="/mail">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input required type="text" class="form-control" id="nome" name="nome" aria-describedby="nome">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="empresa" class="form-label">Empresa</label>
                            <input required type="text" class="form-control" id="empresa" name="empresa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label for="email" class="form-label">E-mail</label>
                                <input required type="email" class="form-control" id="email" aria-describedby="email" name="email" autocomplete="off">
                                <div id="emailHelp" class="form-text text-light">Nunca compartilharemos seu e-mail com mais
                                    ninguém.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input required type="text" class="form-control" id="telefone" name="telefone">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="mensagem" class="form-label">Mensagem</label>
                                    <textarea id="mensagem" class="form-control" placeholder="Deixe sua mensagem aqui" name="mensagem"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-12 form-check">
                        <input required type="checkbox" class="form-check-input" id="politicaPrivacidade">
                        <label class="form-check-label" for="politicaPrivacidade">Ao informar meus dados,
                            concordo
                            com a <a href="#politica" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Política de Privacidade</a></label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary pe-5 ps-5 pt-2 pb-2">Enviar mensagem</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- FIM CONTATO -->

</main>
@endsection