@extends('layouts.panel.based-panel')
@section('title', 'Central de Promoções')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Central de Promoções</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col mb-4">
        <div class="btn-group w-100 mb-3 input-group">
            <input placeholder="Buscar" name="search" type="text" class="bg-white form-control" value="">
            <div class="display-block input-group-append">
                <button type="button" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8 d-flex justify-content-end">
        <div role="group" class="btn-group col col-sm-4 mb-3">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-create-promotion">
                <i class="fa-fw fa fa-plus"></i>Criar Promoção
            </button>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 table-responsive">
        <table class="table  table-info table-bordered table-promotions"></table>
    </div>
  
</div>
@endsection
<style scoped>
    .table-bordered{
        border:  none !important;
    }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate{
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_filter input{
        background-color: '#fff' !important;
    }
    #subtable tbody tr td{
        background-color: #fff !important;
        color: #151a5f;
        font-weight: bold;
    }
</style>
<script src="{{url('panel/js/promotions.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            Promotions.construct();
        })
    </script>
@endsection