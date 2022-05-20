@extends('layouts.panel.based-panel')
@section('title', 'Empresas')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Anúncios</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-show-modal-create-new-company"><i class="fas fa-plus fa-sm text-white-50"></i> Criar</a>
    </div>
    <div class="row">
       <div class="col-12">
            <div class="container col-12"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            Company.init_listeners()
            User.init_listeners()
            Ultils.init_listeners()
        })
    </script>
@endsection