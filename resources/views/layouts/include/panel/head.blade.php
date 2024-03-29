<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cbfood - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('theme-sdb-admin-2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="{{url('theme-sdb-admin-2/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{url('theme-sdb-admin-2/vendor/datatables/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ url('panel/img/logo/icon-page.svg') }}" />
    <link rel="stylesheet" href="{{ url('/css/panel.css') }}" type="text/css"/>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />  
    {{-- <link rel="stylesheet" href="{{url('koolChartJs/KoolChart/Assets/Css/KoolChart.css')}}"/> --}}
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script>
        window.Laravel = {!! json_encode([
            'csrf-token' =>  csrf_token(),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
            'user' =>  auth()->check() ? auth()->user()->id : null,
        ])!!}
    </script>
    
</head>