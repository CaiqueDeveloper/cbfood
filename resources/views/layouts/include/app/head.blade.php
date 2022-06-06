<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cbfood - @yield('title')</title>

    {{-- tailwindcss --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom fonts for this template-->
    <link href="{{url('theme-sdb-admin-2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    {{-- <link href="{{url('theme-sdb-admin-2/css/sb-admin-2.css')}}" rel="stylesheet"> --}}
    <link href="{{url('css/panel.css')}}" rel="stylesheet">
    <link href="{{url('theme-sdb-admin-2/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{url('theme-sdb-admin-2/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ url('panel/img/logo/icon-page.svg') }}" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link  rel="stylesheet" href="{{url('site/js/wolcarousel/owl.carousel.min.css')}}">
    <link  rel="stylesheet" href="{{url('site/js/wolcarousel/owl.theme.default.min.css')}}">
    <link  rel="stylesheet" href="{{url('site/css/checkout.css')}}">
    <style>
        body::-webkit-scrollbar {
            width: 15px;
        }
        
        body::-webkit-scrollbar-track {
            background: #ea580c;
        }
        
        body::-webkit-scrollbar-thumb {
            background-color: #ea580c;
            border-radius: 20px;
            border: 3px solid #fdba74;
        }
    </style>
   
</head>