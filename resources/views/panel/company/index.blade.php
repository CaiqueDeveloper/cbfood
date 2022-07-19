@extends('layouts.panel.based-panel')
@section('title', 'Perfil do Empresa')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Dados da Empresa</h1>
        <div class="small">
            <span class="fw-500 text-primary">{{date('l')}}</span>
            · {{date('F')}} {{date('j')}}, {{date('Y')}} · {{date('H:i')}}  {{date('A')}}
        </div>
    </div>
</div>
{{-- nav --}}
<div class="row">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="user-folks-tab" data-toggle="pill" href="#user-folks" role="tab" aria-controls="user-folks" aria-selected="true">Informações Pessoal</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="user-address-tab" data-toggle="pill" href="#user-address" role="tab" aria-controls="user-address" aria-selected="false">Informações de Endereço</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="user-secury-tab" data-toggle="pill" href="#user-secury" role="tab" aria-controls="user-secury" aria-selected="false">Configurações da Empresa</a>
        </li>
      </ul>
</div>
<div class="tab-content" id="pills-tabContent">
   {{-- Informações do usuario --}}
    <div class="row d-flex tab-pane fade active show" id="user-folks">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Logo da Empresa</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="rounded-circle mb-2" src="@if(@count($response['user']['company']['pictureProfile'][0]->path) != null ) /profile/{{$response['user']['company']['pictureProfile'][0]->path}} @endif" width="120px" height="120px">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <form class="company-uploaded-file" action="#" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" id="">
                        <input type="hidden" id="custId" name="type_model" value="company">
                        <div class="row mt-4">
                            <input type="submit" value="Enviar" class="btn btn-primary btn-user btn-block">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-8 ">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Endereço da Empresa</div>
                <div class="card-body">
                    <form class="company-folks">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Nome</label>
                            <input class="form-control" id="inputUsername" type="text" name="name" value="{{$response['user']['company']->name}}">
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">CNPJ</label>
                            <input class="form-control cnpj" id="inputEmailAddress" type="text" name="cnpj"  value="{{$response['user']['company']->cnpj}}">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">E-mail</label>
                                <input class="form-control" id="inputPhone" type="email" name="email" value="{{$response['user']['company']->email}}">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Whatsapp</label>
                                <input class="form-control phone" id="inputBirthday" type="text" name="phone_number"  value="{{$response['user']['company']->phone_number}}">
                            </div>
                            <input type="hidden" id="custId" name="company_id" value="{{$response['user']['company']->id}}">
                        </div>
                        <!-- Save changes button-->
                        <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- informações do endereço --}}
    <div class="tab-pane fade" id="user-address" style="margin-top: -350px">
        <div class="col">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Dados de Endereço</div>
                <div class="card-body">
                    <form class="company-address" method="post">
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputBirthday">CEP</label>
                            <input class="form-control cep" id="inputBirthday" type="text"  name="zipe_code" value="@if(@count($response['user']['company']['address']) > 0){{$response['user']['company']['address'][0]['zipe_code']}}@endif">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">Estado</label>
                                <input class="form-control" id="inputPhone" type="tel" name="states" value="@if(@count($response['user']['company']['address']) > 0){{$response['user']['company']['address'][0]['states']}}@endif">
                            </div>
                            <!-- Form Group (birthday)-->
                            
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Cidade</label>
                                <input class="form-control" id="inputBirthday" type="text"  name="city" value="@if(@count($response['user']['company']['address']) > 0){{$response['user']['company']['address'][0]['city']}}@endif">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-5">
                                <label class="small mb-1" for="inputPhone">Bairro</label>
                                <input class="form-control" id="inputPhone" type="tel" name="distric" value="@if(@count($response['user']['company']['address']) > 0){{$response['user']['company']['address'][0]['distric']}}@endif">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-5">
                                <label class="small mb-1" for="inputBirthday">Rua</label>
                                <input class="form-control" id="inputBirthday" type="text" name="road"  value="@if(@count($response['user']['company']['address']) > 0){{$response['user']['company']['address'][0]['road']}}@endif">
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" for="inputBirthday">Nª</label>
                                <input class="form-control" id="inputBirthday" type="text" name="number"  value="@if(@count($response['user']['company']['address']) > 0){{$response['user']['company']['address'][0]['number']}}@endif">
                            </div>
                        </div>
                        <input type="hidden" id="custId" name="company_id" value="{{$response['user']['company']->id}}">
                        <!-- Save changes button-->
                        <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- segurança --}}
    <div class="row tab-pane fade active show" id="user-secury" style="margin-top: -350px">
        <div class="col mb-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Banner</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="mb-2" src="@if(@count($response['user']['company']['banner']) > 0 ) /profile/{{$response['user']['company']['banner'][0]->path}} @endif" width="100%" height="320px">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <form class="settgin-uploaded-banner" action="#" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" id="">
                        <input type="hidden" id="custId" name="type_model" value="company_banner">
                        <div class="row mt-4">
                            <input type="submit" value="Enviar" class="btn btn-primary btn-user btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Configurações</div>
                <div class="card-body">
                    <form class="company-setting">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Slung</label>
                            <label class="small mb-1" for="inputUsername">www.cbfood.com/app/company/nome-da-empresa</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">http://127.0.0.1:8000/app/company/</div>
                                </div>
                                <input type="text" readonly class="form-control" value="{{$response['user']['company']['settings'][0]->slug_url}}">
                            </div>
                            
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">Cor Primaria</label>
                                <input class="form-control" type="color" name="primaryColor" value="{{$response['user']['company']['settings'][0]->primaryColor}}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">Cor Secundaria</label>
                                <input class="form-control" type="color" name="secondColor" value="{{$response['user']['company']['settings'][0]->secondColor}}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">Custo do Delivery</label>
                                <input class="form-control price" type="text" name="deliveryPrice" value="{{$response['user']['company']['settings'][0]->deliveryPrice}}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">Valor mínimo do delivery </label>
                                <input class="form-control price" type="text" name="limit_send_delivery" value="{{$response['user']['company']['settings'][0]->limit_send_delivery}}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">O Delivery está disponível ?</label>
                                <select class="custom-select  mb-3" name="hasDelivery">
                                    <option value="1" @if($response['user']['company']['settings'][0]->hasDelivery == 1) selected @endif>Sim</option>
                                    <option value="0" @if($response['user']['company']['settings'][0]->hasDelivery == 0) selected @endif>Não</option>>
                                  </select>
                            </div>
                            <input type="hidden" id="custId" name="company_id" value="{{$response['user']['company']->id}}">
                        </div>
                        <!-- Save changes button-->
                        <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="{{url('panel/js/company.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            Company.construct();
        })
    </script>
@endsection