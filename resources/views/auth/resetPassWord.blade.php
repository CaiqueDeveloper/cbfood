@extends('layouts.auth.based-auth')
@section('title', 'Solicitar Demonstração')
@section('title-form-auth', 'Esqueceu sua senha ?')
@section('forms-auth')
<p class="mb-4">Nós entendemos, coisas acontecem. Basta inserir seu endereço de e-mail abaixo e enviaremos um link para redefinir sua senha!</p>
     <form class="user">
        <div class="form-group">
            <input type="email" class="form-control form-control-user"
                id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="E-mail">
        </div>
        <a href="" class="btn btn-primary btn-user btn-block">
            Alterar senha
        </a>
    </form>
@endsection