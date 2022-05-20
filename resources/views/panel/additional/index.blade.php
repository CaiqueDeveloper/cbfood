@extends('layouts.panel.based-panel')
@section('title', 'Adicionais')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Adicionais</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-sm-4 col mb-3">
        <div class="btn-group w-100 mb-2 input-group">
            <input placeholder="Buscar" name="search" type="text" class="bg-white form-control" value="">
            <div class="display-block input-group-append">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8 d-flex justify-content-end">
        <div role="group" class="btn-group mr-3">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-create-group-additional">
                <i class="fa-fw fa fa-plus"></i> Criar Grupo
            </button>
        </div>
        <div role="group" class="btn-group">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-create-item-additional">
                <i class="fa-fw fa fa-plus"></i> Criar Item
            </button>
        </div>
    </div>
</div>
<div class="content-render-view"></div>
@endsection
<script src="{{url('panel/js/additionals.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            Additionals.construct();
        })
    </script>
@endsection