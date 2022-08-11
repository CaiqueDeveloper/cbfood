{{-- <form action="/admin/import1" method="post" enctype="multipart/form-data">
    @csrf
 
    <!-- Equivalent to... -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="file" name="file" id="">
    <input type="submit" value="Submit">
  </form> --}}
@extends('layouts.panel.based-panel')
@section('title', 'Importação de Dados')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Importação de Dados</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="row mt-4">
    
  <div class="col-xl-12 col-lg-12">
    <div class="m-dropzone dropzone dz-clickable" id="import">
      <div class="m-dropzone__msg dz-message needsclick">
        <h3 class="m-dropzone__msg-title"></h3>
        <span class="m-dropzone__msg-desc">Arraste ou clique aqui para realizar o upload</span>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script src="{{url('panel/js/report.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            Report.construct();
        })
    </script>
@endsection