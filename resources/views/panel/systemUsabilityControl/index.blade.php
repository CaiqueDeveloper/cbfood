@extends('layouts.panel.based-panel')
@section('title', 'Controle de Usuabilidade do sistema')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Controle de Usuabilidade do sistema</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Analise Resumida</div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col  shadown" style="background: linear-gradient(90deg, rgba(1,31,75,1) 0%, rgba(1,31,75,1) 49%, rgba(114,81,178,1) 100%);border-radius: 10px;">
                <!-- small box -->
                <div class="small-box bg-aqua">
                <div class="inner" style="border-bottom: 1px solid #fff;margin-bottom: 10px;">
                    <h3 style="color:#fff" class="totalUserActive">0</h3>
                    <p style="color:#fff"><strong><b style="font-size: 1.7em;margin-right: 3px;" class="goalUserActive">0%</b><b>%</b> Ativos</strong></p>
                    <p style="color:#fff"><strong>Usuário Ativos</strong></p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer show-modal-users-active" id="" style="color:#fff;">Usuários<i class="la la-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col  mx-3 shadown" style="background: linear-gradient(90deg, rgba(1,31,75,1) 0%, rgba(1,31,75,1) 49%, rgba(114,81,178,1) 100%);border-radius: 10px;">
                <!-- small box -->
                <div class="small-box bg-aqua">
                <div class="inner" style="border-bottom: 1px solid #fff;margin-bottom: 10px;">
                    <h3 style="color:#fff" class="totalHotelsActive">0</h3>
                    <p style="color:#fff"><strong><b style="font-size: 1.7em;margin-right: 3px;" class="goalHotelsActive">0 %</b><b>%</b> Ativos</strong></p>
                    <p style="color:#fff"><strong>Empresas Ativa</strong></p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer show-modal-hotels-active" id="" style="color:#fff;">Empresas<i class="la la-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col  shadown" style="background: linear-gradient(90deg, rgba(1,31,75,1) 0%, rgba(1,31,75,1) 49%, rgba(114,81,178,1) 100%);border-radius: 10px;">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner" style="border-bottom: 1px solid #fff;margin-bottom: 10px;">
                        <h3 style="color:#fff" class="totalHotelsInactive">0</h3>
                        <p style="color:#fff"><strong><b style="font-size: 1.7em;margin-right: 3px;" class="goalHotelsInactive">0 %</b><b>%</b> Inativos</strong></p>
                        <p style="color:#fff"><strong>Empresas Inativo</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer show-modal-hotels-inactive" id="comparasion-statistc-user-logged" style="color:#fff;">Empresas<i class="la la-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Indicadores</div>
    <div class="card-body">
        <div class="row  mt-2 mb-3 align-items-center">
            <div class="input-group col col-sm-3 mb-2 mt-2 period_checkin flex flex-column ">
                <h6 class="label-selector">Período do Login</h6>
                <div class="d-flex">
                    <input type="text" class="form-control m-input input-io" id="systemUsabilityControlDatePicker">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Empresa</label>
                <select id="inputState" class="form-control">
                    @foreach ($companiesUser as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
              <div class="form-group col-md-4">
                <label for="inputState">Módulos</label>
                <select id="inputState" class="form-control">
                    @foreach ($modules as $module)
                        <option value="{{$module->id}}">{{$module->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <button class="btn btn-success btn-icon search-system-usability-period"><i class="fa fa-search d-none"></i> Pesquisar</button>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">Analise Detalhada</div>
    <div class="card-body">
    </div>
</div>

@endsection
<script src="{{url('panel/js/systemUsabilityControl.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            systemUsabilityControl.construct();
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