@if(Auth::user())
<h4 class="mb-3 font-bold text-gray-900 text-xl">Olá {{Auth::user()->name}}</h4>
<hr class="mb-4">
<div class="col order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted font-bold text-gray-900">Seu Carrinho</span>
        <span class="badge badge-secondary badge-pill">{{@count($cartItens)}}</span>
    </h4>
    <ul class="list-group mb-3">
        @foreach ($cartItens as $item) 
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                <h6 class="my-0">{{$item->name}} - Qt ({{$item->quantity}})</h6>
                <small class="text-muted">{{$item->description}}</small>
                </div>
                <span class="text-muted">R$ {{number_format($item->price,2,",",".")}}</span>
            </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between">
            <span>Total </span>
            <strong>R$ {{number_format(Cart::getTotal(),2,",",".") }}</strong>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col my-3 ">
        <form action="" class="send-address-user">
            <hr class="mb-4">
            {{-- Method Payment --}}
            <h4 class="mb-3 font-bold text-gray-900 text-2xl">Forma de Pagamento</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment_method" type="radio" class="custom-control-input checkbox-credcard"  value="credcard">
                    <label class="custom-control-label" for="credit">Cartão</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment_method" type="radio" class="custom-control-input checkbox-money" value="money">
                    <label class="custom-control-label" for="debit">Dinheiro</label>
                </div>
                <div class="custom-control custom-radio hidden">
                    <input id="paypal" name="payment_method" type="radio" class="custom-control-input" value="pix">
                    <label class="custom-control-label" for="paypal">Pix</label>
                </div>
            </div>
            <div class="col-sm-6 col content-thing mb-4" style="display: none;margin-left:-10px">
                <label for="lastName">Troco?</label>
                <input type="text" class="form-control" name="thing" placeholder="" id="thing">
            </div>
            <hr class="mb-4">
            <article class="flex items-center"><p class="text-xl tex-gray-600">Selecione um dos Seus endereços Abaixo ou</p> <a href="#" class="bg-green-300 text-green-600 font-bold p-2 rounded-xl ml-3 no-underline show-modal-insert-new-addrees-user">Adicionar novo endereço</a></article>
        @foreach(Auth::user()->address as $addres)
        <div class="custom-control custom-radio shadow py-3 my-3 rounded-2xl cursor-pointer">
            <input id="{{$addres->id}}" name="address" type="checkbox" class="custom-control-input ml-3 cursor-pointer z-40" value="{{$addres->id}}">
            <label class="custom-control-label ml-3 cursor-pointer z-40" for="{{$addres->id}}">Rua {{$addres->road}}, Nª {{$addres->number}}, Bairro {{$addres->distric}}, Cidade {{$addres->city}}/{{$addres->states}}...</label>
        </div>
        @endforeach
        <button class="bg-green-300 text-green-600 font-bold p-2 rounded-xl text-lg my-3" type="submit">Confirma Compra</button>
    </form>
    </div>
</div>

@else
<header class="flex items-center justify-center sm:text-4xl font-bold text-gray-900">    
    <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt=""><p>CbFood.</p>
</header>
<div class="descrition-page text-center font-bold text-gray-900 my-5">
    <p>Área de Pagamento e finalizção de pedido. Preencha todos os dados atentamente. </p>
</div>

<div class="row">
    {{-- Item in Cart --}}
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted font-bold text-gray-900">Seu Carrinho</span>
            <span class="badge badge-secondary badge-pill">{{@count($cartItens)}}</span>
        </h4>
        <ul class="list-group mb-3">
            @foreach ($cartItens as $item) 
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0">{{$item->name}} - Qt ({{$item->quantity}})</h6>
                    <small class="text-muted">{{$item->description}}</small>
                    </div>
                    <span class="text-muted">{{$item->price}}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
                <span>Total </span>
                <strong>R$ {{ number_format(Cart::getTotal()) }}</strong>
            </li>
        </ul>
    </div>
    {{-- Info Register User --}}
    <div class="col-md-8 order-md-1">
        <form class="needs-validation form-checkout-new-user" >
            <div class="row font-bold text-gray-900">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Nome</label>
                    <input type="text" class="form-control" name="name" id="firstName" placeholder="" value="" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">WhatApp Number</label>
                    <input type="text" class="form-control phone_number" id="lastName" name="number_phone" placeholder="" value="" required>
                </div>
            </div>
            <div class="mb-3 font-bold text-gray-900">
                <label for="username">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="username" name="password" required>
                </div>
            </div>
            <div class="mb-3 font-bold text-gray-900">
                <label for="username">E-mail (Opicional)</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="email" class="form-control" id="username" name="email" >
                </div>
            </div>

            <div class="row font-bold text-gray-900">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Estado</label>
                    <input type="text" class="form-control" name="states" placeholder="" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">CEP</label>
                    <input type="text" class="form-control cep" name="zipe_code" placeholder="" required>
                </div>
            </div>
            <div class="row font-bold text-gray-900">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Cidade</label>
                    <input type="text" class="form-control" name="city" placeholder="" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Rua</label>
                    <input type="text" class="form-control" name="road" placeholder="" required>
                </div>
            </div>
            <div class="row font-bold text-gray-900">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Bairro</label>
                    <input type="text" class="form-control" name="distric" placeholder="" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Nª</label>
                    <input type="text" class="form-control" name="number" placeholder="" required>
                </div>
            </div>
            <hr class="mb-4">
            {{-- Method Payment --}}
            <h4 class="mb-3 font-bold text-gray-900 text-2xl">Forma de Pagamento</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment_method" type="radio" class="custom-control-input checkbox-credcard"  value="credcard">
                    <label class="custom-control-label" for="credit">Cartão</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment_method" type="radio" class="custom-control-input checkbox-money" value="money">
                    <label class="custom-control-label" for="debit">Dinheiro</label>
                </div>
                <div class="custom-control custom-radio hidden">
                    <input id="paypal" name="payment_method" type="radio" class="custom-control-input" value="pix">
                    <label class="custom-control-label" for="paypal">Pix</label>
                </div>
            </div>
            <div class="col-sm-6 col content-thing mb-4" style="display: none;margin-left:-10px">
                <label for="lastName">Troco?</label>
                <input type="text" class="form-control" name="thing" placeholder="" required>
            </div>
            <hr class="mb-4">
            <button class="bg-green-300 text-green-600 font-bold p-2 rounded-xl text-xl" type="submit">Confirma Compra</button>
            </div>
        </form>
    </div>
    </div>
</div>
@endif