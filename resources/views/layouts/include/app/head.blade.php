<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="Cbfood Delivery">
    <meta property="og:title" content="Cbfood Delivery Plataform" />
    <meta property="og:description" content="Plataforma de Delivery, densenvolvida pensando em você !" />
    <meta property="og:image" itemprop="image" content="https://i.postimg.cc/wv0DWcx8/Group-1.png">
    <meta property="og:image" content="https://i.postimg.cc/wv0DWcx8/Group-1.png">

    <!-- No need to change anything here -->
    <meta property="og:type" content="website" />
    <meta property="og:image:type" content="image/jpeg">

    <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <!-- Website to visit when clicked in fb or WhatsApp-->
    <meta property="og:url" content="{{url()->current()}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cbfood - @yield('title')</title>

    {{-- tailwindcss --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="{{asset('js/tailwindcss.js')}}"></script> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Custom fonts for this template-->
    <link href="{{url('theme-sdb-admin-2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('theme-sdb-admin-2/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{url('theme-sdb-admin-2/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ url('panel/img/logo/icon-page.svg') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>