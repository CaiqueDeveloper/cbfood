@extends('layouts.panel.based-panel')
@section('title', 'Categorias')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Categorias</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row">
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
        <div role="group" class="btn-group col col-sm-4 mb-4">
            <button type="button" class="align-self-center mr-0 btn btn-primary show-modal-create-category">
                <i class="fa-fw fa fa-plus"></i> Criar categoria
            </button>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 table-responsive">
        <table class="table table-info table-category"></table>
    </div>
  
</div>
@endsection
<style scoped>
    .dataTables_filter,
    .dataTables_length
    {
        display: none !important;
    }
</style>