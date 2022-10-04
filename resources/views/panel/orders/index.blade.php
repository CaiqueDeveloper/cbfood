@extends('layouts.panel.based-panel')
@section('title', 'Pedidos')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Pedidos</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Indicadores</div>
    <div class="card-body">
        <div class="row  mt-2 mb-3 align-items-center justify-content-center">
            <div class="input-group col col-sm-3 mb-2 mt-2 period_checkin flex flex-column ">
                <h6 class="label-selector">Período de Venda</h6>
                <div class="d-flex">
                    <input type="text" class="form-control m-input input-io" id="date-ranger-picker-orders">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Estatus da Venda</label>
                <select id="status_sales" class="form-control">
                </select>
            </div>
              <div class="form-group col-md-4">
                <label for="inputState">Clientes</label>
                <select id="select_client" class="form-control">
                </select>
            </div>
            <div class="mt-2 col d-none">
                <button class="btn btn-success btn-icon col search-system-usability-period"><i class="fa fa-search d-none"></i> Pesquisar</button>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Analise Grafica</div>
    <div class="card-body">
        <div class="row  mt-2 mb-3 align-items-center justify-content-center">
            <canvas id = "chartSales" style = "height: 400px;"></canvas>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Tabela de Pedidos</div>
    <div class="card-body">
        <div class="row  mt-2 mb-3 align-items-center justify-content-center">
            <div class="col my-4 mb-3">
				<label class="sr-only" for="inlineFormInputGroupUsername">Cliente</label>
				<div class="input-group shadow">
					<div class="input-group-prepend">
					<div class="input-group-text"><i class="m-menu__link-icon fa  fa-users  "></i></div>
					</div>
					<input type="text" class="form-control input-filter-user" id="inlineFormInputGroupUsername" placeholder="Cliente">
				</div>
			</div>
            <div class="col-12 table-responsive">
                <table class="table-orders  table-bordered table table-info table-striped"></table>
            </div>
        </div>
    </div>
</div>
@endsection
<style scoped>
    .dataTables_filter{
        display: none !important;
    }
</style>

@section('scripts')
<script src="{{url('panel/js/orders.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            Orders.construct();
        })
    </script>
@endsection