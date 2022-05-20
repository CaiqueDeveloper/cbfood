@extends('layouts.panel.based-panel')
@section('title', 'Perfil do Usúario')
@section('content')
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h1 class="mb-0">Dados do Usuário</h1>
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
          <a class="nav-link" id="user-secury-tab" data-toggle="pill" href="#user-secury" role="tab" aria-controls="user-secury" aria-selected="false">Segurança</a>
        </li>
      </ul>
</div>
<div class="tab-content" id="pills-tabContent">
   {{-- Informações do usuario --}}
    <div class="row d-flex tab-pane fade active show" id="user-folks">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Foto do Perfil</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" width="150px" height="150px" src="@if(@count($response['user']['pictureProfile']) > 0 ) /profile/{{$response['user']['pictureProfile'][0]['path']}} @endif" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <form class="user-uploaded-file" action="#" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" id="">
                        <input type="hidden" id="custId" name="type_model" value="user">
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
                <div class="card-header">Dados Pessoal</div>
                <div class="card-body">
                    <form class="user-folks">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Nome</label>
                            <input class="form-control" id="inputUsername" type="text" name="name" placeholder="Enter your username" value="{{$response['user']['name']}}">
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="{{$response['user']['email']}}">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Número de Telefone</label>
                                <input class="form-control" id="inputPhone" type="tel" name="number_phone"placeholder="Enter your phone number" value="{{$response['user']['number_phone']}}">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Número de Telefone Alternativo</label>
                                <input class="form-control" id="inputBirthday" type="text" name="number_phone_alternative" placeholder="Enter your birthday" value="{{$response['user']['number_phone_alternative']}}">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @php
        // if(count($response['user']['address']) > 0){
        //   //  dd('Tem dados');
        // }else{
        //     /dd('não tem dados');
        // }
    @endphp
    {{-- informações do endereço --}}
    <div class="tab-pane fade" id="user-address" style="margin-top: -350px">
        <div class="col">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Dados de Endereço</div>
                <div class="card-body">
                    <form class="user-address" method="post">
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhone">Estado</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" name="states" value="@if(@count($response['user']['address']) > 0) {{$response['user']['address'][0]['states']}} @endif">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputBirthday">CEP</label>
                            <input class="form-control" id="inputBirthday" type="text" placeholder="Enter your birthday" name="zipe_code" value="@if(@count($response['user']['address']) > 0) {{$response['user']['address'][0]['zipe_code']}} @endif">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Cidade</label>
                                <input class="form-control" id="inputBirthday" type="text" placeholder="Enter your birthday" name="city" value="@if(@count($response['user']['address']) > 0) {{$response['user']['address'][0]['city']}} @endif">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-5">
                                <label class="small mb-1" for="inputPhone">Bairro</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" name="distric" value="@if(@count($response['user']['address']) > 0) {{$response['user']['address'][0]['distric']}} @endif">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-5">
                                <label class="small mb-1" for="inputBirthday">Rua</label>
                                <input class="form-control" id="inputBirthday" type="text" name="road" placeholder="Enter your birthday" value="@if(@count($response['user']['address']) > 0) {{$response['user']['address'][0]['road']}} @endif">
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" for="inputBirthday">Nª</label>
                                <input class="form-control" id="inputBirthday" type="text" name="number" placeholder="Enter your birthday" value="@if(@count($response['user']['address']) > 0) {{$response['user']['address'][0]['number']}} @endif">
                            </div>
                        </div>
                        <input type="hidden" id="custId" name="user_id" value="{{$response['user']['id']}}">
                        <!-- Save changes button-->
                        <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- segurança --}}
    <div class="tab-pane fade" id="user-secury" style="margin-top: -350px">
        <div class="col">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Trocar Senha</div>
                <div class="card-body">
                    <form class="user-change-password" method="POST">
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col">
                                <label class="small mb-1" for="inputPhone">Senha</label>
                                <input class="form-control" id="inputPhone" type="password" placeholder="Enter your phone number" name="password" value="{{$response['user']['password']}}">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col">
                                <label class="small mb-1" for="inputPhone">Confirmação da Senha</label>
                                <input class="form-control" id="inputPhone" type="password" placeholder="Enter your phone number" name="password_confirmation" value="{{$response['user']['password']}}">
                            </div>
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
