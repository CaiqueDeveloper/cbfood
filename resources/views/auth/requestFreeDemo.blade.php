@extends('layouts.auth.based-auth')
@section('title', 'Solicitar Demonstração')
@section('title-form-auth', 'Dados pessoais.')
@section('forms-auth')
    <form class="user" id="requestFreeDemo" >
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                    placeholder="Nome" name="name">
            </div>
            <div class="col-sm-6 d-none">
                <input type="text" class="form-control form-control-user" id="exampleLastName"
                    placeholder="Sobre nome" name="last_name">
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                placeholder="E-mail" name="email">
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user"
                    id="exampleInputPassword" placeholder="Senha" name="password">
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control form-control-user"
                    id="exampleRepeatPassword" placeholder="Confirme sua senha" name="password_confirmation">
            </div>
        </div>
        <hr>
        <h5>Dados da Empresa</h5>
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                    placeholder="Nome" name="company_name">
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                placeholder="CNPJ" name="cnpj">
        </div>
        <input type="submit" value="Proximo" class="btn btn-primary btn-user btn-block">
        <hr>
    </form>
@endsection
<script src="{{url('panel/js/auth.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            Auth.construct();
        })
    </script>
@endsection