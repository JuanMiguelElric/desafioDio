<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="PHRSSEC - Segurança da informação">
    <meta name="keywords" content="Segurança da informação, proteção de dados, DPO, serviços de DPO, empresa de segurança digital, Lei Geral de Proteção de Dados, LGPD, Dados Pessoais, Perícia, Perícia Forense">
    <meta name="description" content="Oferecemos soluções de segurança da informação e serviços de Data Protection Officer (DPO) para garantir a proteção dos seus dados. Saiba mais sobre nossos serviços!">
    <meta name="language" content="Português">
    <!-- <link rel="stylesheet" href="./assets/vendor/bootstrap/bootstrap.min.css"> -->
    @vite([
    'resources/sass/app.scss',
    'resources/sass/phrssec/app.scss',
    'resources/js/app.js',
    ])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,400;6..12,700&display=swap" rel="stylesheet">
    <title>Consultoria em LGPD e Segurança da informação - @yield('title')</title>
    
        @yield('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg  fixed-top navbar-dark bg-header">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">
                <img src="{{Vite::asset('resources/images/phrssec/Phrssec-logo.png')}}" class="img-fluid" alt="LOGO - PHRSSEC" width="200">
            </a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-phrssec" href="{{route('index')}}#inicio">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-phrssec" href="{{route('index')}}#nossos-servicos">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-phrssec" href="{{route('index')}}#planos">Planos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-phrssec" href="{{route('index')}}#certificacoes">Certificações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-phrssec" href="{{route('index')}}#contato">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <a href="https://wa.me/554139952478?text=Gostaria%20de%20conversar%20com%20um%20especialista" target="_blank" id="whats-icone" class="position-fixed"><img src="{{Vite::asset('resources/images/phrssec/Whatsapp-Image.png')}}" alt="Whats image"></a>
    <a href="mailto:phrssec@contato.com" target="_blank" id="email-icone" class="position-fixed"><img src="{{Vite::asset('resources/images/phrssec/email.png')}}" alt="email image"></a>

    @yield('content')

    <footer class="container-fluid">
        <!-- FOOTER -->
        <div class="container text-light ">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-lg-4 mt-5">
                    <div class="logo d-flex align-items-center justify-content-center justify-content-md-start">
                        <img src="{{Vite::asset('resources/images/phrssec/m.png')}}" alt="" style="width: 47px; height: 44px;" class="img-fluid me-3">
                        <div class="text-center">
                            <h5>PHRSSEC</h5>
                            <p class="fs-6 ">Segurança da informação</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class=" d-block text-center text-md-start">
                            Converse com um de nossos especialistas: <br>
                        </span>
                        <span class=" d-block text-center text-md-start">
                            Atendemos em todo Brasil!
                        </span>
                        <p class=" d-block text-center text-md-start">
                            Atendimento Presencial e Remoto
                            monitoramento do ambiente e prestação
                            de suporte para os usuários.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 mt-5">
                    <h3 class="ms-3">Contatos</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="tel:" class="text-white nav-link nav-link-phrssec nav-link nav-link-phrssec-phrssec"><img src="{{Vite::asset('resources/images/phrssec/telephone-fill.svg')}}" alt="telefone" class="me-3"> (41) 3995-2478</a>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:comercial@phrssec.com" class="text-white nav-link nav-link-phrssec">
                                <img src="{{Vite::asset('resources/images/phrssec/Subtract.svg')}}" alt="email" class="me-3">
                                comercial@phrssec.com
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://wa.me/554139952478?text=Tenho%20interesse%20" class="text-white nav-link nav-link-phrssec">
                                <img src="{{Vite::asset('resources/images/phrssec/whatsapp.svg')}}" alt="whatsapp" class="me-3 ">
                                Fale com um especialista
                            </a>
                        </li>
                        <li class="nav-item">
                            <p class="text-white nav-link nav-link-phrssec">
                                CNPJ: 43.917.532/0001-09
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 mt-5">
                    <h3 class="ms-3">Institucional</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{route('index')}}#" class="text-white nav-link nav-link-phrssec">
                                Início
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index')}}#nossos-servicos" class="text-white nav-link nav-link-phrssec">
                                Serviços
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index')}}#planos" class="text-white nav-link nav-link-phrssec">
                                Planos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index')}}#certificacoes" class="text-white nav-link nav-link-phrssec">
                                Certificações
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index')}}#compliance" class="text-white nav-link nav-link-phrssec">
                                Atendimento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('index')}}#contato" class="text-white nav-link nav-link-phrssec">
                                Contato
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-sm-6 col-lg-1 border-left mt-5">
                    <ul class="nav flex-row flex-sm-column justify-content-around justify-content-sm-between h-100">
                        <li class="nav-item">
                            <a href="https://www.linkedin.com/company/phrssec/" class="text-white ms-3">
                                <img src="{{Vite::asset('resources/images/phrssec/linkedin.svg')}}" alt="linkedin">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://twitter.com/PHRSSECs" class="text-white ms-3">
                                <img src="{{Vite::asset('resources/images/phrssec/twitter.svg')}}" alt="twitter">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.facebook.com/groups/phrssec/" class="text-white ms-3">
                                <img src="{{Vite::asset('resources/images/phrssec/facebook.svg')}}" alt="facebook">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.instagram.com/phrssec/" class="text-white ms-3">
                                <img src="{{Vite::asset('resources/images/phrssec/instagram.svg')}}" alt="instagram">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <h5>&copy;
                        <?php echo date('Y') ?> - PHRSSEC - Segurança da informação
                    </h5>
                </div>
                <div class="col-md-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="/politica-de-privacidade" class="fw-bold">Política de
                                Privacidade</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- FIM FOOTER -->

        <x-politica-de-privacidade />
    </footer>
    <!-- <script src="./assets/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>