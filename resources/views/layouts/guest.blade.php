<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
        <link rel="icon" type="image/png" href="/img/favicon.png">
        <meta name="description" content="BuffetTech é o sistema ideal para a gestão de buffets de festas infantis. Organize reservas, cardápios personalizados, pagamentos e estoque de forma eficiente.">
        <meta name="keywords" content="buffettech, buffet infantil, sistema de gestão de buffets, software de gestão, reservas de festas, controle de estoque, planejamento de festas, organização de buffets">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ config('app.administrative_url') }}">
        
        <meta property="og:title" content="BuffetTech - A melhor forma de gerenciar seu buffet de festas infantis.">
        <meta property="og:description" content="BuffetTech é o sistema ideal para a gestão de buffets de festas infantis. Organize reservas, cardápios personalizados, pagamentos e estoque de forma eficiente.">
        <meta property="og:image" content="{{ asset('img//dark-mode/identidade-visual/buffettech_logo_vertical.png') }}">
        <meta property="og:url" content="{{ config('app.administrative_url') }}">
        <meta property="og:type" content="website">
        
        <meta name="twitter:title" content="BuffetTech - A melhor forma de gerenciar seu buffet de festas infantis.">
        <meta name="twitter:description" content="BuffetTech é o sistema ideal para a gestão de buffets de festas infantis. Organize reservas, cardápios personalizados, pagamentos e estoque de forma eficiente.">
        <meta name="twitter:image" content="{{ asset('img//dark-mode/identidade-visual/buffettech_logo_vertical.png') }}">
        <meta name="twitter:card" content="summary_large_image">

        <title>{{ config('app.name', 'BuffeTTech') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="{{ $class ?? '' }}">

        @yield('content')
    </body>
</html>
