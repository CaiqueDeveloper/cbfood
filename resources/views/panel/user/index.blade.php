@extends('layouts.panel.based-panel')
@section('title', 'Usuários')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Usuários</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row">
   
    <div class="col d-flex justify-content-end flex-column flex-sm-row">
        <div role="group" class="btn-group mr-3">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-create-new-user">
                <i class="fa-fw fa fa-plus"></i> Cadastrar novo usuário
            </button>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 table-responsive">
        <table class="table table-info table-striped table-users"></table>
    </div>
</div>
@endsection
<script src="{{url('panel/js/user.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            User.construct();
        })
    </script>
@endsection
<style scoped>
    .table-info, .table-info > th, .table-info > td{
        background: #4e73df !important;
    }
    table{
        color:  #fff !important;
    }
</style>