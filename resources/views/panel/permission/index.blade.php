@extends('layouts.panel.based-panel')
@section('title', 'Permissões')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Permissões de usuários</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row">
   
    <div class="col d-flex justify-content-end flex-column flex-sm-row">
        <div role="group" class="btn-group mr-3">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-create-new-profile mb-3">
                <i class="fa-fw fa fa-plus"></i> Criar Perfil
            </button>
        </div>
        <div role="group" class="btn-group">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-new-permission">
                <i class="fa-fw fa fa-plus"></i> Criar Permissão
            </button>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <table class="table table-striped table-products"></table>
    </div>
  
</div>
@endsection
<script src="{{url('panel/js/profles.js')}}"></script>
<script src="{{url('panel/js/permissions.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            Profiles.construct();
            Permissions.construct();
        })
    </script>
@endsection