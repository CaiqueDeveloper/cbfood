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
<div class="row mt-4">
    <div class="col-12 table-responsive">
        <table class="table-orders  table-bordered table table-info table-striped"></table>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{url('panel/js/orders.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            Orders.construct();
        })
    </script>
@endsection