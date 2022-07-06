@extends('layouts.panel.based-panel')
@section('title', 'Minhas Entrega')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Entregas</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 table-responsive">
        <table class="table  table-info table-products"></table>
    </div>
  
</div>
@endsection
{{-- <script src="{{url('panel/js/products.js')}}"></script> --}}
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            // Products.construct();
        })
    </script>
@endsection