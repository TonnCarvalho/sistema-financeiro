<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script>
        (function() {
            const tema = localStorage.getItem('tema') || 'light';
            document.documentElement.setAttribute('data-bs-theme', tema);
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="__token">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body class="layout-boxed" data-bs-theme="" x-data="tema" x-init="carregarTema">
    <div class="page">
        @include('layout.parts.header')
        <div class="page-wrapper">

            @include('layout.parts.page-header')

            <div class="page-body">
                <div class="container-xl">

                    @if (session('success'))
                        <x-alert.alert-success message="{{ session('success') }}" />
                    @endif

                    <div class="row row-deck row-cards">
                        @yield('content')
                    </div>

                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
