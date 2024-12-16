<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
        <link rel="icon" type="image/png" href="/img/favicon.png">
        <meta name="description" content="BuffetTech é o sistema ideal para a gestão de buffets de festas infantis. Organize reservas, cardápios personalizados, pagamentos e estoque de forma eficiente.">
        <meta name="keywords" content="buffettech, buffet infantil, sistema de gestão de buffets, software de gestão, reservas de festas, controle de estoque, planejamento de festas, organização de buffets">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ config('app.administrative_url') }}">
        
        <meta property="og:title" content="BuffetTech - A melhor forma de gerenciar seu buffet de festas infantis.">
        <meta property="og:description" content="BuffetTech é o sistema ideal para a gestão de buffets de festas infantis. Organize reservas, cardápios personalizados, pagamentos e estoque de forma eficiente.">
        <meta property="og:image" content="{{ asset('img/dark-mode/identidade-visual/buffettech_logo_vertical.png') }}">
        <meta property="og:url" content="{{ config('app.administrative_url') }}">
        <meta property="og:type" content="website">
        
        <meta name="twitter:title" content="BuffetTech - A melhor forma de gerenciar seu buffet de festas infantis.">
        <meta name="twitter:description" content="BuffetTech é o sistema ideal para a gestão de buffets de festas infantis. Organize reservas, cardápios personalizados, pagamentos e estoque de forma eficiente.">
        <meta name="twitter:image" content="{{ asset('img/dark-mode/identidade-visual/buffettech_logo_vertical.png') }}">
        <meta name="twitter:card" content="summary_large_image">

        <title>BuffeTTech - A melhor gestão do seu buffet!</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=open-sans:400,500,600,700,800" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
          html {
              scroll-behavior: smooth !important;
          }
        </style>

    </head>
    <body class="h-full" style="background-color: #EEEEEE">
        
        <div class="bg-white">
            <nav>
                <ul class="flex text-center justify-center text-2xl">
                    <li class="px-2"><a href=""><i class="fa-brands fa-linkedin"></i></a></li>
                    <li class="px-2"><a href=""><i class="fa-brands fa-github"></i></a></li>
                    <li class="px-2"><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li class="px-2"><a href=""><i class="fa-brands fa-whatsapp"></i></a></li>
                </ul>
            </nav>
        </div>
        <section class="relative h-[90vh] bg-black">
            <!-- Camada de imagem com opacidade -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('img/background-landingpage.png') }}'); opacity: 0.2;"></div>
            
            <!-- Conteúdo Principal -->
            <div class="relative z-10 h-full">
                <!-- Header Principal -->
                <header class="bg-transparent">
                    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                        <!-- Logotipo -->
                        <div>
                            <a href="{{ route('landing_page') }}">
                                <img src="{{ asset('img/identidade-visual/light-mode/buffettech_logo_vertical.png') }}" 
                                     alt="Logo"
                                     class="w-[300px] md:w-[430px] h-auto max-w-full">
                            </a>
                        </div>
                
                        <!-- Botão Hamburger -->
                        <div class="md:hidden">
                            <button id="menu-toggle" class="text-white focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                
                        <!-- Links de Navegação e Botões -->
                        <nav id="menu" class="hidden md:flex flex-col md:flex-row md:space-x-6 absolute md:relative top-20 left-0 w-full md:top-0 md:w-auto bg-gray-900 md:bg-transparent z-50 mt-2 items-center">
                            <a href="#sobre" class="block px-3 py-2 text-white hover:text-yellow-500">Sobre</a>
                            <a href="#planos" class="block px-3 py-2 text-white hover:text-yellow-500">Planos</a>
                            <a href="#blog" class="block px-3 py-2 text-white hover:text-yellow-500">Blog</a>
                            <a href="{{ route('contact') }}" class="block px-3 py-2 text-white hover:text-yellow-500">Fale conosco</a>
                        
                            @if (Route::has('login'))
                                @auth
                                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 px-4 my-auto">
                                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-white border rounded hover:bg-white hover:text-gray-800 text-center">Dashboard</a>
                                    </div>
                                @else
                                    <!-- Botões de Ação -->
                                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 px-4 my-auto">
                                        <a href="{{ route('login') }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-center">Login</a>
                                        <a href="{{ route('register') }}" class="px-4 py-2 text-white border rounded hover:bg-white hover:text-gray-800 text-center">Registrar</a>
                                    </div>
                                @endauth
                            @endif

                        </nav>
                    </div>
                </header>
        
                <!-- Seção Hero -->
                <section class="flex items-center justify-center h-[calc(90vh-180px)]">
                    <div class="container mx-auto px-6 flex flex-col lg:flex-row items-center justify-center z-10">
                        <!-- Conteúdo Hero -->
                        <div class="w-full lg:w-1/2 text-white text-center lg:text-left">
                            <h1 class="text-4xl lg:text-6xl font-bold mb-4">Lorem ipsum dolor sit amet.</h1>
                            <p class="text-lg mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#planos" class="bg-yellow-500 text-white px-6 py-3 rounded hover:bg-yellow-600">Saiba mais</a>
                        </div>
                        <!-- Retângulo Placeholder -->
                        <div class="hidden lg:block w-full lg:w-1/2">
                            <div class="bg-white h-64 w-full rounded-lg shadow-lg"></div>
                        </div>
                    </div>
                </section>
                
            </div>
        </section>
        <section id="sobre">
            <div class="overflow-hidden bg-white py-12 sm:pt-24 sm:pb-12">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                  <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div class="lg:pr-8 lg:pt-4">
                      <div class="lg:max-w-lg">
                        <h2 class="text-base/7 font-semibold text-yellow-600">Sobre o BuffeTTech</h2>
                        <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Transformando a gestão de buffets infantis</p>
                        <p class="mt-6 text-lg/8 text-gray-600">BuffeTTech é uma solução inovadora para buffets infantis a gestão de maneira eficiente e integrada.</p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none">
                          <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="w-6 absolute left-1 top-1 size-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                  <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm3.75-2.75a.75.75 0 0 0 1.5 0V9.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0l-3.25 3.5a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z" clip-rule="evenodd" />
                                </svg>
                                Agendamento Online
                            </dt>
                            <dd class="inline">Facilite a reserva de datas e horários para festas infantis, de forma rápida e sem complicações.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                  <svg class="w-6 absolute left-1 top-1 size-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
                                  </svg>
                                  Gestão Financeira
                                </dt>
                                <dd class="inline">Controle fácil de orçamentos e pagamentos para cada evento, garantindo transparência e organização.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                  <svg class="w-6 absolute left-1 top-1 size-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path d="M4.632 3.533A2 2 0 0 1 6.577 2h6.846a2 2 0 0 1 1.945 1.533l1.976 8.234A3.489 3.489 0 0 0 16 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234Z" />
                                    <path fill-rule="evenodd" d="M4 13a2 2 0 1 0 0 4h12a2 2 0 1 0 0-4H4Zm11.24 2a.75.75 0 0 1 .75-.75H16a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75h-.01a.75.75 0 0 1-.75-.75V15Zm-2.25-.75a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75h-.01Z" clip-rule="evenodd" />
                                  </svg>
                                  Controle de Estoque
                                </dt>
                                <dd class="inline">Gerencie de forma simples o estoque de produtos e serviços necessários para cada festa.</dd>
                              </div>
                        </dl>
                      </div>
                    </div>
                    <img src="{{ asset('img/dashboard_landingpage.png') }}" alt="Product screenshot" class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0" width="2432" height="1442">
                  </div>
                </div>
              </div>
              <div class="overflow-hidden bg-white py-12 sm:pt-12 sm:pb-12">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                        <!-- Imagem à esquerda -->
                        <img 
                        src="{{ asset('img/criar_reserva_landingpage.png') }}" 
                        alt="Product screenshot" 
                        class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] -ml-16 lg:ml-[-18rem]" 
                        width="2432" 
                        height="1442">                        
                        <!-- Texto à direita -->
                        <div class="lg:pl-8 lg:pt-4">
                            <div class="lg:max-w-lg">
                                <h2 class="text-base/7 font-semibold text-yellow-600">Benefícios para o Buffet</h2>
                                <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Eficiência e Praticidade no seu Buffet Infantil</p>
                                <p class="mt-6 text-lg/8 text-gray-600">BuffeTTech foi projetado para ajudar a otimizar a gestão de buffets infantis, garantindo mais organização e controle.</p>
                                <dl class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none">
                                    <div class="relative pl-9">
                                      <dt class="inline font-semibold text-gray-900">
                                        <svg class="w-6 absolute left-1 top-1 size-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                          <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm3.75-2.75a.75.75 0 0 0 1.5 0V9.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0l-3.25 3.5a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z" clip-rule="evenodd" />
                                        </svg>
                                        Agendamento Simplificado
                                      </dt>
                                      <dd class="inline">Reserve facilmente as datas, sem precisar de processos manuais complexos.</dd>
                                    </div>
                                    <div class="relative pl-9">
                                      <dt class="inline font-semibold text-gray-900">
                                        <svg class="w-6 absolute left-1 top-1 size-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                          <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
                                        </svg>
                                        Finanças Organizadas
                                      </dt>
                                      <dd class="inline">Acompanhe de perto os fluxos financeiros de cada evento e mantenha o controle de receitas e despesas.</dd>
                                    </div>
                                    <div class="relative pl-9">
                                      <dt class="inline font-semibold text-gray-900">
                                        <svg class="w-6 absolute left-1 top-1 size-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                          <path d="M4.632 3.533A2 2 0 0 1 6.577 2h6.846a2 2 0 0 1 1.945 1.533l1.976 8.234A3.489 3.489 0 0 0 16 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234Z" />
                                          <path fill-rule="evenodd" d="M4 13a2 2 0 1 0 0 4h12a2 2 0 1 0 0-4H4Zm11.24 2a.75.75 0 0 1 .75-.75H16a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75h-.01a.75.75 0 0 1-.75-.75V15Zm-2.25-.75a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75h-.01Z" clip-rule="evenodd" />
                                        </svg>
                                        Eficiência no Estoque
                                      </dt>
                                      <dd class="inline">Evite desperdícios controlando a utilização de materiais e alimentos de forma eficaz.</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
              
        </section>

        <section id="planos">
            <div class="relative isolate bg-white px-6 py-12 sm:py-12 lg:px-8">
                <div class="absolute inset-x-0 -top-3 -z-10 transform-gpu overflow-hidden px-36 blur-3xl" aria-hidden="true">
                  <div class="mx-auto aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#e0ba31] to-[#9089fc] opacity-30" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
                <div class="mx-auto max-w-4xl text-center">
                  <h2 class="text-base/7 font-semibold text-yellow-600">Preços</h2>
                  <p class="mt-2 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-6xl">Escolha o melhor plano para seu buffet</p>
                </div>
                <p class="mx-auto mt-6 max-w-2xl text-pretty text-center text-lg font-medium text-gray-600 sm:text-xl/8">Escolha um plano acessível que inclua os melhores recursos para envolver seu público, fidelizar o cliente e impulsionar as vendas.</p>
                <div class="mx-auto mt-16 grid max-w-lg grid-cols-1 items-center gap-y-6 sm:mt-20 sm:gap-y-0 lg:max-w-4xl lg:grid-cols-2">
                  <div class="rounded-3xl rounded-t-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 sm:mx-8 sm:rounded-b-none sm:p-10 lg:mx-0 lg:rounded-bl-3xl lg:rounded-tr-none">
                    <h3 id="tier-hobby" class="text-base/7 font-semibold text-yellow-600">Clássico</h3>
                    <p class="mt-4 flex items-baseline gap-x-2">
                      <span class="text-5xl font-semibold tracking-tight text-gray-900">R$ 49,90</span>
                      <span class="text-base text-gray-500">/mês</span>
                    </p>
                    <p class="mt-6 text-base/7 text-gray-600">Plano introdutório para conhecer as funcionalidades do sistema.</p>
                    <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Reserva de festas
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Gestão de horários
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Gestão de até 10 funcionários
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Formulário de Atendimento
                      </li>
                    </ul>
                    <a href="{{ route('register') }}" aria-describedby="tier-hobby" class="mt-8 block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-yellow-600 ring-1 ring-inset ring-yellow-200 hover:ring-yellow-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600 sm:mt-10">Melhore seu buffet agora</a>
                  </div>
                  <div class="relative rounded-3xl bg-gray-900 p-8 shadow-2xl ring-1 ring-gray-900/10 sm:p-10">
                    <h3 id="tier-enterprise" class="text-base/7 font-semibold text-yellow-400">Luxo</h3>
                    <p class="mt-4 flex items-baseline gap-x-2">
                      <span class="text-5xl font-semibold tracking-tight text-white">R$ 99,00</span>
                      <span class="text-base text-gray-400">/mês</span>
                    </p>
                    <p class="mt-6 text-base/7 text-gray-300">Plano avançado para melhorar a eficiência de seu buffet.</p>
                    <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-300 sm:mt-10">
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Reserva de festas
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Gestão de horários
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Gestão de funcionários
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Formulário de Atendimento
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Convite Virtual
                      </li>
                      <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        Software Financeiro
                      </li>
                    </ul>
                    <a href="{{ route('register') }}" aria-describedby="tier-enterprise" class="mt-8 block rounded-md bg-yellow-500 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-500 sm:mt-10">Melhore seu buffet agora</a>
                  </div>
                </div>
              </div>
        </section>

        <footer class="bg-gray-800 text-white py-8">
          <div
            class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center px-4"
          >
            <!-- Seção Esquerda -->
            <div class="space-y-2 py-2 items-center">
              <!-- Logo -->
                <div>
                  <a href="{{ route('landing_page') }}">
                      <img src="{{ asset('img/identidade-visual/light-mode/buffettech_logo_vertical.png') }}" 
                           alt="Logo"
                           class="w-[300px] md:w-[430px] h-auto max-w-full">
                  </a>
                </div>
                <div class="px-8 space-y-3">

                 <!-- Horário -->
                  <p class="flex items-center space-x-2">
                    <span><i class="fa-solid fa-clock"></i></span>
                    <span>Segunda à Sexta, exceto feriados, das 8h até as 19h</span>
                  </p>
                  <!-- Endereço -->
                  <p class="flex items-center space-x-2">
                    <span><i class="fa-solid fa-location-dot"></i></span>
                    <span>
                      Rua Professor Doutor Euryclides de Jesus Zerbini, 1516 | Pq. Rural
                      Fazenda Santa Cândida | Campinas - SP | CEP: 13087-571
                    </span>
                  </p>
                  <!-- Telefone -->
                  <p class="flex items-center space-x-2">
                    <span><i class="fa-brands fa-whatsapp"></i></span>
                    <span>+55 19 12345-6789</span>
                  </p>
                  <!-- E-mail -->
                  <p class="flex items-center space-x-2">
                    <span><i class="fa-solid fa-envelope"></i></span>
                    <span>contato@buffettech.com.br</span>
                  </p>
                </div>
                </div>
    
            <!-- Seção Direita -->
            <div class="mt-8 md:mt-0">
              <h2 class="text-lg font-bold mb-4">Sobre o BuffeTTech</h2>
              <ul class="space-y-2">
                <li>
                  <a href="#" class="hover:text-yellow-400 transition">Sobre</a>
                </li>
                <li>
                  <a href="#" class="hover:text-yellow-400 transition">Planos</a>
                </li>
                <li>
                  <a href="#" class="hover:text-yellow-400 transition">Blog</a>
                </li>
                <li>
                  <a href="#" class="hover:text-yellow-400 transition"
                    >Fale conosco</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </footer>
        
        <script>
            const menuToggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('menu');
        
            menuToggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
    </body>
</html>